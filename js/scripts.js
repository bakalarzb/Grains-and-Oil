document.addEventListener("DOMContentLoaded", function () {
    console.log("Document loaded, attaching event listener to form.");

    let form = document.getElementById("businessForm");
    if (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent form submission until coordinates are fetched

            let postcode = document.getElementById("business_postcode").value.trim();
            if (!postcode) {
                alert("Please enter a postcode.");
                return;
            }

            console.log("Fetching coordinates for postcode:", postcode);
            fetchCoordinates(postcode, function (latitude, longitude) {
                if (latitude && longitude) {
                    document.getElementById("latitude").value = latitude;
                    document.getElementById("longitude").value = longitude;
                    console.log("Coordinates set. Submitting form.");
                    form.submit(); // Now submit the form
                } else {
                    alert("Could not fetch coordinates. Please check the postcode.");
                }
            });
        });
    } else {
        console.error("Form not found.");
    }
});

function fetchCoordinates(postcode, callback) {
    let url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(postcode)}, UK`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                let location = data[0];
                console.log("Coordinates found:", location.lat, location.lon);
                callback(location.lat, location.lon);
            } else {
                console.error("No results found for the postcode:", postcode);
                callback(null, null);
            }
        })
        .catch(error => {
            console.error("Error fetching coordinates:", error);
            callback(null, null);
        });
}

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'block';
        // Ensure QR code container is hidden on open
        const qrCodeContainer = document.getElementById('qrCodeContainer');
        if (qrCodeContainer) {
            qrCodeContainer.classList.add('hidden');
        }
        const qrCode = document.getElementById('qrCodeOutput');
        if (qrCode) {
            qrCode.setAttribute('contents', '');
        }
    } else {
        console.error(`Modal ${modalId} not found`);
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
        // Hide and clear QR code container on close
        const qrCodeContainer = document.getElementById('qrCodeContainer');
        if (qrCodeContainer) {
            qrCodeContainer.classList.add('hidden');
        }
        const qrCode = document.getElementById('qrCodeOutput');
        if (qrCode) {
            qrCode.setAttribute('contents', '');
        }
    } else {
        console.error(`Modal ${modalId} not found`);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const productForm = document.getElementById('productForm');
    if (productForm) {
        productForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form values
            const productData = {
                product_name: document.getElementById('productName').value,
                product_category_name: document.getElementById('productCategory').value,
                price: parseFloat(document.getElementById('price').value),
                weight: parseFloat(document.getElementById('weight').value),
                description: document.getElementById('description').value || null
            };

            // Log productData to the console
            console.log('Product Data to be sent:', productData);

            // Send data to vendor-dashboard.php via AJAX
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(productData)
            })
                .then(response => response.json())  // Read the response as JSON once
                .then(data => {
                    // Log session data from the response
                    console.log('Session Data:', data.session_data);

                    if (data.success) {
                        console.log('Product added successfully with ID:', data.product_id);
                        closeModal('productModal');
                        productForm.reset();
                        alert('Listing created successfully!'); // Add success alert
                    } else {
                        console.error('Error:', data.error);
                        alert('Failed to add product: ' + data.error + '\nSession Data: ' + data.session_data);
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('An error occurred while adding the product.');
                });
        });
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('productModal');
        if (event.target === modal) {
            closeModal('productModal');
        }
    };
});

document.addEventListener('DOMContentLoaded', function() {

    // Function to download QR code as PNG with icon
    function downloadQrCode() {
        const qrCode = document.getElementById('qrCodeOutput');
        if (!qrCode) {
            console.error('QR code element not found');
            alert('Unable to download QR code.');
            return;
        }

        // Using html2canvas to capture the full element
        html2canvas(qrCode, {
            scale: 1.5, // Increase resolution for better quality
            backgroundColor: '#ffffff' // Match inline background-color
        }).then(canvas => {
            const pngUrl = canvas.toDataURL('image/png');
            const link = document.createElement('a');
            link.href = pngUrl;
            link.download = 'qr-code.png';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            console.log('QR code with icon downloaded as PNG');
        }).catch(error => {
            console.error('Error capturing QR code with html2canvas:', error);
            alert('Error downloading QR code.');
        });
    }

    // Function to print QR code with icon in a new tab
    function printQrCode() {
        const qrCode = document.getElementById('qrCodeOutput');
        if (!qrCode) {
            console.error('QR code element not found');
            alert('Unable to print QR code.');
            return;
        }

        html2canvas(qrCode, {
            scale: 1,
            backgroundColor: '#ffffff'
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            // Open in a new tab
            const printTab = window.open('', '_blank', 'width=600,height=600');
            if (!printTab) {
                console.error('Failed to open new tab; pop-up may be blocked');
                alert('Please allow pop-ups to print the QR code.');
                return;
            }
            printTab.document.write(`
                <html>
                    <head>
                        <title>Print QR Code</title>
                        <style>
                            body { margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #ffffff; }
                            img { max-width: 100%; max-height: 100%; }
                        </style>
                    </head>
                    <body onload="window.print(); window.close()">
                        <img src="${imgData}" alt="QR Code" />
                    </body>
                </html>
            `);
            printTab.document.close();
            console.log('QR code opened in new tab and sent to printer');
        }).catch(error => {
            console.error('Error capturing QR code for print:', error);
            alert('Error printing QR code.');
        });
    }

    // Attach download button event listener
    const downloadBtn = document.getElementById('downloadQrBtn');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function() {
            console.log('Download QR code button clicked');
            downloadQrCode();
        });
    } else {
        console.error('Download button not found');
    }

    // Attach print button event listener
    const printBtn = document.getElementById('printQrBtn');
    if (printBtn) {
        printBtn.addEventListener('click', function() {
            console.log('Print QR code button clicked');
            printQrCode();
        });
    } else {
        console.error('Print button not found');
    }

    // Handle QR Form Submission
    const jsonForm = document.getElementById('jsonForm');
    if (jsonForm) {
        console.log('jsonForm found, attaching submit listener');
        jsonForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submission prevented, processing JSON');

            const weight = parseFloat(document.getElementById('wasteWeight').value) || 0;
            const vendorId = document.getElementById('vendorId').value.trim();
            const collectionDate = document.getElementById('collectionDate').value;
            const category = document.getElementById('category').value;
            const destination = document.getElementById('destination').value;

            console.log('Form values:', { weight, vendorId, collectionDate, category, destination });

            const data = {
                weight: weight,
                vendorId: vendorId,
                collectionDate: collectionDate,
                category: category,
                destination: destination
            };
            console.log('JSON data object:', data);

            const jsonString = JSON.stringify(data);
            console.log('Generated JSON string:', jsonString);

            const qrCodeContainer = document.getElementById('qrCodeContainer');
            const qrCode = document.getElementById('qrCodeOutput');
            if (qrCode) {
                qrCode.setAttribute('contents', jsonString);
                console.log('QR code contents set to:', jsonString);
                if (qrCodeContainer) {
                    qrCodeContainer.classList.remove('hidden');
                    console.log('QR code container shown');
                }
                qrCode.addEventListener('codeRendered', () => {
                    console.log('QR code rendered successfully');
                    const icon = qrCode.querySelector('[slot="icon"]');
                    if (icon && icon.complete && icon.naturalWidth !== 0) {
                        console.log('Icon loaded successfully');
                    } else {
                        console.error('Icon failed to load or is broken');
                    }
                }, { once: true });
            } else {
                console.error('qrCodeOutput element not found');
            }
        });
    } else {
        console.error('jsonForm not found in the DOM');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('QRModal');
        if (event.target === modal) {
            closeModal('QRModal');
        }
    };
});