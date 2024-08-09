function confirmDeletion() {
    var form = document.getElementById('modifyForm');
    var checkboxes = form.querySelectorAll('input[type="checkbox"]:checked');
    if (checkboxes.length > 0) {
        var confirmed = confirm("Are you sure you want to delete the selected rows?");
        if (confirmed) {
            form.submit();
        }
    }
}