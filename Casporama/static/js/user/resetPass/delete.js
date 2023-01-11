'use strict';

let switchButton = document.getElementById('switch');
let submitButton = document.getElementById('submitButton');

switchButton.addEventListener('change', function() {

    if (this.checked) {

        submitButton.value = "Réinitialiser le mot de passe";

    } else {

        submitButton.value = "Ne pas réinitialiser la référence";

    }
});