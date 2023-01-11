'use strict';

let switchButton = document.getElementById('switch');
let submitButton = document.getElementById('submitButton');

switchButton.addEventListener('change', function() {

    if (this.checked) {

        submitButton.value = "Reset le mots de passe'";

    } else {

        submitButton.value = "Ne pas reset le mots de passe";

    }
});