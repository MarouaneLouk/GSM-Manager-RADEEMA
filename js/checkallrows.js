document.getElementById('selectAllCheckbox').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('#example-table tbody input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

const rowCheckboxes = document.querySelectorAll('#example-table tbody input[type="checkbox"]');
rowCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        if (!this.checked) {
            selectAllCheckbox.checked = false;
        } else {
            const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
            selectAllCheckbox.checked = allChecked;
        }
    });
});