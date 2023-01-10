'use strict';

let nextButton = document.getElementsByClassName("nextButton");
let previousButton = document.getElementsByClassName("previousButton");

for (let button of nextButton) {

    button.addEventListener("click", function () {

        let url = new URL(window.location.href);

        let param = new URLSearchParams(url.search);

        let range = param.get('range');

        let actualPosition = range.split(";")[0];
        let step = range.split(";")[1];

        let newPosition = parseInt(actualPosition) + parseInt(step);

        param.set('range', newPosition + ";" + step);

        url.search = param.toString();

        window.location.href = url;

    });

}

for (let button of previousButton) {

    button.addEventListener("click", function () {

        let url = new URL(window.location.href);

        let param = new URLSearchParams(url.search);

        let range = param.get('range');

        let actualPosition = range.split(";")[0];
        let step = range.split(";")[1];

        let newPosition = parseInt(actualPosition) - parseInt(step);

        param.set('range', newPosition + ";" + step);

        url.search = param.toString();

        window.location.href = url;

    });

}