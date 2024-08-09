let sortOrderHeader = [];

function sortTableHeader(columnIndex) {
    const table = document.getElementsByTagName('table')[0];
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = Array.from(tbody.getElementsByTagName('tr'));

    sortOrderHeader[columnIndex] = (sortOrderHeader[columnIndex] === 'asc') ? 'desc' : 'asc';

    for (let i = 0; i < table.rows[0].cells.length; i++) {
        const arrow = document.getElementById('arrow' + i);
        if (arrow) {
            arrow.className = (i === columnIndex) ? sortOrderHeader[columnIndex] : 'inactive-arrow';
        }
    }

    rows.sort((a, b) => {
        const aValue = a.children[columnIndex].textContent.trim();
        const bValue = b.children[columnIndex].textContent.trim();
        return sortOrderHeader[columnIndex] === 'asc'
            ? (isNaN(aValue) ? aValue.localeCompare(bValue, undefined, {numeric: true, sensitivity: 'base'}) : parseFloat(aValue) - parseFloat(bValue))
            : (isNaN(aValue) ? bValue.localeCompare(aValue, undefined, {numeric: true, sensitivity: 'base'}) : parseFloat(bValue) - parseFloat(aValue));
    });

    tbody.innerHTML = '';
    rows.forEach(row => tbody.appendChild(row));
}
