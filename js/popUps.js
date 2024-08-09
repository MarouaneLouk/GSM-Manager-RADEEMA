function openPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex';
}

function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
}
document.addEventListener('DOMContentLoaded', function() {
    function modifyClosePopup() {
        window.history.back();
    }
    
    var closeButton = document.getElementById('closeButton');
    if (closeButton) {
        closeButton.addEventListener('click', modifyClosePopup);
    } else {
        console.error('Element with ID "closeButton" not found.');
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const filterBtn = document.querySelector('.filter-btn');
    const closeBtn = document.querySelector('.close-btn');
    const filterPopup = document.getElementById('filterPopup');
    const filterForm = document.getElementById('filter-form');

    filterBtn.addEventListener('click', function() {
        filterPopup.style.display = 'flex';
    });

    closeBtn.addEventListener('click', function() {
        filterPopup.style.display = 'none';
    });

    filterForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const orderBy = document.getElementById('order-by').value;
        const orderDirection = document.getElementById('order-direction').value;
        
        // Add your filter logic here
        console.log(`Order by: ${orderBy}, Direction: ${orderDirection}`);
        
        filterPopup.style.display = 'none';
    });

    // Close the popup when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === filterPopup) {
            filterPopup.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const viewMoreButtons = document.querySelectorAll('.view-more-btn');
    const closeButtons = document.querySelectorAll('.close-btn');
    const popups = document.querySelectorAll('.popup-overlay');

    viewMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
            const popupId = this.getAttribute('data-popup');
            const popup = document.getElementById(popupId);
            popup.style.display = 'flex';
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.popup-overlay').style.display = 'none';
        });
    });

    window.addEventListener('click', function(event) {
        popups.forEach(popup => {
            if (event.target === popup) {
                popup.style.display = 'none';
            }
        });
    });
});