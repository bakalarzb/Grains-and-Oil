document.addEventListener("DOMContentLoaded", function () {
    // ---- Business Registration: Get Coordinates ----
    const businessForm = document.getElementById("businessForm");
    if (businessForm) {
        businessForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const postcode = document.getElementById("business_postcode").value.trim();
            if (!postcode) {
                alert("Please enter a postcode.");
                return;
            }

            fetchCoordinates(postcode, function (latitude, longitude) {
                if (latitude && longitude) {
                    document.getElementById("latitude").value = latitude;
                    document.getElementById("longitude").value = longitude;
                    businessForm.submit();
                } else {
                    alert("Could not fetch coordinates. Please check the postcode.");
                }
            });
        });
    }

    /*
    // ---- Add Product Form Submission ----
    const productForm = document.getElementById("productForm");
    if (productForm) {
        productForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(productForm);

            fetch("upload_photo.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Server response:", data);
                if (data.success) {
                    alert("Product added successfully!");
                    closeModal("productModal");
                    productForm.reset();
                } else {
                    alert("Error: " + data.error);
                }
            })
            .catch(error => {
                console.error("Upload failed", error);
                alert("Something went wrong while uploading.");
            });
        });
    }
    */

     // ✅ ---- Add Product Form Submission with Redirect ----
     const productForm = document.getElementById("productForm");
     if (productForm) {
         productForm.addEventListener("submit", function (e) {
             e.preventDefault();
 
             const formData = new FormData(productForm);
 
             fetch("upload_photo.php", {
                 method: "POST",
                 body: formData
             })
             .then(response => response.json())
             .then(data => {
                 console.log("Server response:", data);
                 if (data.success) {
                     // Redirect after success
                     window.location.href = "marketplace.php";
                 } else {
                     alert("Error: " + data.error);
                 }
             })
             .catch(error => {
                 console.error("Upload failed", error);
                 alert("Something went wrong while uploading.");
             });
         });
     }

    // ---- QR Code Form ----
    const jsonForm = document.getElementById("jsonForm");
    if (jsonForm) {
        jsonForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const data = {
                weight: parseFloat(document.getElementById('wasteWeight').value) || 0,
                vendorId: document.getElementById('vendorId').value.trim(),
                collectionDate: document.getElementById('collectionDate').value,
                category: document.getElementById('category').value,
                destination: document.getElementById('destination').value
            };

            const jsonString = JSON.stringify(data);
            const qrCode = document.getElementById('qrCodeOutput');
            const qrCodeContainer = document.getElementById('qrCodeContainer');

            if (qrCode) {
                qrCode.setAttribute('contents', jsonString);
                if (qrCodeContainer) {
                    qrCodeContainer.classList.remove('hidden');
                }
            }
        });
    }

    // ---- QR Code Download & Print ----
    const downloadBtn = document.getElementById('downloadQrBtn');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function () {
            const qrCode = document.getElementById('qrCodeOutput');
            if (!qrCode) return;

            html2canvas(qrCode, { scale: 1.5, backgroundColor: '#ffffff' })
                .then(canvas => {
                    const link = document.createElement('a');
                    link.href = canvas.toDataURL('image/png');
                    link.download = 'qr-code.png';
                    link.click();
                });
        });
    }

    const printBtn = document.getElementById('printQrBtn');
    if (printBtn) {
        printBtn.addEventListener('click', function () {
            const qrCode = document.getElementById('qrCodeOutput');
            if (!qrCode) return;

            html2canvas(qrCode, { scale: 1, backgroundColor: '#ffffff' })
                .then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const printTab = window.open('', '_blank', 'width=600,height=600');
                    printTab.document.write(`
                        <html>
                        <head><title>Print QR Code</title></head>
                        <body onload="window.print(); window.close()">
                            <img src="${imgData}" alt="QR Code" />
                        </body>
                        </html>
                    `);
                    printTab.document.close();
                });
        });
    }

    // ---- Modal Close on Outside Click ----
    window.onclick = function (event) {
        ['productModal', 'QRModal'].forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (event.target === modal) {
                closeModal(modalId);
            }
        });
    };
});

function fetchCoordinates(postcode, callback) {
    const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(postcode)}, UK`;
    fetch(url)
        .then(res => res.json())
        .then(data => {
            if (data.length > 0) {
                callback(data[0].lat, data[0].lon);
            } else {
                callback(null, null);
            }
        })
        .catch(() => callback(null, null));
}

function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = 'block';
        const qrContainer = document.getElementById('qrCodeContainer');
        if (qrContainer) qrContainer.classList.add('hidden');
    }
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = 'none';
        const qrContainer = document.getElementById('qrCodeContainer');
        if (qrContainer) qrContainer.classList.add('hidden');
    }
}

document.addEventListener("DOMContentLoaded", function () {
    // Example of password strength check
    const passwordInput = document.getElementById("password");

    passwordInput.addEventListener("input", function () {
        const password = passwordInput.value;
        const strengthIndicator = document.getElementById("password-strength");

        // Simple password strength check: Add more complex logic here
        if (password.length < 6) {
            strengthIndicator.textContent = "Weak";
            strengthIndicator.style.color = "red";
        } else if (password.length < 12) {
            strengthIndicator.textContent = "Medium";
            strengthIndicator.style.color = "orange";
        } else {
            strengthIndicator.textContent = "Strong";
            strengthIndicator.style.color = "green";
        }
    });
});

// document.addEventListener('DOMContentLoaded', function() {
//     const productForm = document.getElementById('productForm');
//     if (productForm) {
//         productForm.addEventListener('submit', function(e) {
//             e.preventDefault();

//             // Get form values
//             const productData = {
//                 product_name: document.getElementById('productName').value,
//                 product_category_name: document.getElementById('productCategory').value,
//                 price: parseFloat(document.getElementById('price').value),
//                 weight: parseFloat(document.getElementById('weight').value),
//                 description: document.getElementById('description').value || null
//             };

//             // Log productData to the console
//             console.log('Product Data to be sent:', productData);

//             // Send data to vendor-dashboard.php via AJAX
//             fetch(window.location.href, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                 },
//                 body: JSON.stringify(productData)
//             })
//                 .then(response => response.json())  // Read the response as JSON once
//                 .then(data => {
//                     // Log session data from the response
//                     console.log('Session Data:', data.session_data);

//                     if (data.success) {
//                         console.log('Product added successfully with ID:', data.product_id);
//                         closeModal('productModal');
//                         productForm.reset();
//                         alert('Listing created successfully!'); // Add success alert
//                     } else {
//                         console.error('Error:', data.error);
//                         alert('Failed to add product: ' + data.error + '\nSession Data: ' + data.session_data);
//                     }
//                 })
//                 .catch(error => {
//                     console.error('Fetch error:', error);
//                     alert('An error occurred while adding the product.');
//                 });
//         });
//     }