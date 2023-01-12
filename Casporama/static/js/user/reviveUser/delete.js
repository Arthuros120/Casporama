'use strict';

let switchButton = document.getElementById('switch');
let submitButton = document.getElementById('submitButton');

switchButton.addEventListener('change', function() {

    if (this.checked) {

        submitButton.value = "Réssucité l'utilisateur";

    } else {

        submitButton.value = "Ne pas réssucité l'utilisateur";

    }
});