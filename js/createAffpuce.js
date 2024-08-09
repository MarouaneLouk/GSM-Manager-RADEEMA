document.addEventListener('DOMContentLoaded', function() {
    const matriculeSelect = document.getElementById('personnel');
    const nameSelect = document.getElementById('fullName');
    const dateAffectation = document.getElementById('dateAffectation');
    const dateDesaffectation = document.getElementById('dateDesaffectation');

    function updateSelects(selectedValue) {
        nameSelect.value = selectedValue;
        matriculeSelect.value = selectedValue;
    }

    if (matriculeSelect && nameSelect) {
        matriculeSelect.addEventListener('change', function() {
            updateSelects(this.value);
        });

        nameSelect.addEventListener('change', function() {
            updateSelects(this.value);
        });
    }

    // Date validation logic
    if (dateAffectation && dateDesaffectation) {
        dateAffectation.addEventListener('change', function() {
            dateDesaffectation.min = this.value;
        });

        dateDesaffectation.addEventListener('change', function() {
            if (this.value < dateAffectation.value) {
                alert('Date Désaffectation must be greater than or equal to Date Affectation');
                this.value = dateAffectation.value;
            }
        });
    }
});