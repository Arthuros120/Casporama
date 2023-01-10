'strict mode';

let inputSport = document.getElementById('sport');
let inputType = document.getElementById('type');
let inputStep = document.getElementById('step');

let submitButton = document.getElementById('submit');

submitButton.addEventListener('click', function() {

    let sport = inputSport.value;
    let type = inputType.value;
    let step = inputStep.value;

    let url = new URL(window.location.href);

    let param = new URLSearchParams(url.search);

    param.set('sport', sport);

    param.set('type', type);

    param.set('range', "0;" + step);

    url.search = param.toString();

    window.location.href = url;

});