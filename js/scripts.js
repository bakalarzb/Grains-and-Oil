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