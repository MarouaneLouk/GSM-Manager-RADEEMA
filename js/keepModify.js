// Function to open popup and set the row ID
function openPopup(popupId, rowId) {
    document.getElementById('row-id').value = rowId;
    document.getElementById(popupId).style.display = 'block';
}

// Function to close popup
function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
}

// Handle form submission via AJAX
document.getElementById('modifyForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    var formData = new FormData(this);

    fetch('../php/deleteModifyEntite.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response from the server
        console.log(data);
        // Close the popup on successful submission
        closePopup('modifyPopup');
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Function to open popup and set the row ID
function openPopup(popupId, rowId) {
    document.getElementById('row-id').value = rowId;
    document.getElementById(popupId).style.display = 'block';

    // Store popup state in query parameters
    var url = new URL(window.location.href);
    url.searchParams.set('popup', popupId);
    url.searchParams.set('rowId', rowId);
    window.history.pushState({}, '', url);
}

// Function to close popup and remove query parameters
function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
    var url = new URL(window.location.href);
    url.searchParams.delete('popup');
    url.searchParams.delete('rowId');
    window.history.pushState({}, '', url);
}

// Function to restore popup state on page load
window.addEventListener('load', function() {
    var params = new URLSearchParams(window.location.search);
    var popupId = params.get('popup');
    var rowId = params.get('rowId');

    if (popupId) {
        document.getElementById('row-id').value = rowId;
        document.getElementById(popupId).style.display = 'block';
    }
});
