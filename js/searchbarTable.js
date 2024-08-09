document.getElementById("searchTable").onkeyup = function(){
    var query = this.value.toUpperCase();
    var table = document.getElementsByTagName('table')[0];
    var tbody = table.getElementsByTagName('tbody')[0];
    var table_rows = tbody.getElementsByTagName('tr');

    for(var i = 0; i < table_rows.length; i++){
        var cells = table_rows[i].getElementsByTagName('td');
        var rowContainsQuery = false;

        for(var j = 0; j < cells.length; j++){
            var cell = cells[j];
            if(cell){
                var cellText = cell.textContent || cell.innerText;
                if(cellText.toUpperCase().indexOf(query) > -1){
                    rowContainsQuery = true;
                    break; // Stop checking other cells if one matches
                }
            }
        }

        if(rowContainsQuery){
            table_rows[i].style.display = "";
        } else {
            table_rows[i].style.display = "none";
        }
    }
}
