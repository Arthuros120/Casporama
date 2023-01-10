'strict mode';

let inputStep = document.getElementById('step');

let submitButton = document.getElementById('submit');

submitButton.addEventListener('click', function() {

    let step = inputStep.value;

    let url = new URL(window.location.href);

    let param = new URLSearchParams(url.search);

    param.set('range', "0;" + step);

    url.search = param.toString();

    window.location.href = url;

});