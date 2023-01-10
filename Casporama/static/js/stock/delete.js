'use strict';

let switchButton = document.getElementById('switch');
let submitButton = document.getElementById('submitButton');

switchButton.addEventListener('change', function() {

    if (this.checked) {

        submitButton.value = "Supprimer la référence";

    } else {

        submitButton.value = "Ne pas supprimer la référence";

    }
});