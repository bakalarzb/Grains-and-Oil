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
    } else {
        console.error(`Modal with ID '${modalId}' not found`);
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
    } else {
        console.error(`Modal with ID '${modalId}' not found`);
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
