function toggleSelectAll(source) {
    checkboxes = document.querySelectorAll('#example-table tbody input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
    }
}

function submitDeleteForm() {
    var form = document.getElementById('deleteForm');
    var checkboxes = document.querySelectorAll('#example-table tbody input[type="checkbox"]:checked');
    if (checkboxes.length > 0) {
        form.submit();
    } else {
        alert("Please select at least one entity to delete.");
    }
}
