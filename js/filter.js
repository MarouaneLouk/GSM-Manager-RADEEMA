let sortOrder = [];

function sortTable(columnIndex, direction) {
    const table = document.getElementsByTagName('table')[0];
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = Array.from(tbody.getElementsByTagName('tr'));

    sortOrder[columnIndex] = direction;

    for (let i = 0; i < table.rows[0].cells.length; i++) {
        const arrow = document.getElementById('arrow' + i);
        if (arrow) {
            arrow.className = (i === columnIndex) ? direction : 'inactive-arrow';
        }
    }

    rows.sort((a, b) => {
        const aValue = a.children[columnIndex].textContent.trim();
        const bValue = b.children[columnIndex].textContent.trim();
        return direction === 'asc'
            ? (isNaN(aValue) ? aValue.localeCompare(bValue, undefined, {numeric: true, sensitivity: 'base'}) : parseFloat(aValue) - parseFloat(bValue))
            : (isNaN(aValue) ? bValue.localeCompare(aValue, undefined, {numeric: true, sensitivity: 'base'}) : parseFloat(bValue) - parseFloat(aValue));
    });

    tbody.innerHTML = '';
    rows.forEach(row => tbody.appendChild(row));
}

document.getElementById('filter-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const orderBy = document.getElementById('order-by').selectedIndex;
    const orderDirection = document.getElementById('order-direction').value;

    sortTable(orderBy, orderDirection);
});
