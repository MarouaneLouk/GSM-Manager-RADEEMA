document.addEventListener('DOMContentLoaded', function() {
    const matriculeSelect = document.querySelectorAll('.modpersonnel');
    const nameSelect = document.querySelectorAll('.modfullName');
    const dateAffectation = document.getElementById('moddateAffectation');
    const dateDesaffectation = document.getElementById('moddateDesaffectation');

    // Synchronize the select elements
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
