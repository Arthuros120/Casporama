'use strict';

let allProductInput = document.getElementsByClassName("selectProduct");

let selectAllInput = document.getElementById("selectAll");

let selectAll = false;

selectAllInput.addEventListener("click", function () {

    for (let input of allProductInput) {

        input.checked = selectAllInput.checked;

    }

    selectAll = selectAllInput.checked;

});

for (let input of allProductInput) {

    input.addEventListener("click", function () {

        if (input.checked) {

            selectAll = true;

        } else {

            selectAll = false;

        }

        for (let input of allProductInput) {

            if (!input.checked) {

                selectAll = false;

            }

        }

        selectAllInput.checked = selectAll;

    });

};

let allProductNotAliveInput = document.getElementsByClassName("selectProductNotAlive");

let selectAllNotAliveInput = document.getElementById("selectAllNotAlive");

let selectAllNotAlive = false;

selectAllNotAliveInput.addEventListener("click", function () {

    for (let input of allProductNotAliveInput) {

        input.checked = selectAllNotAliveInput.checked;

    }

    selectAllNotAlive = selectAllNotAliveInput.checked;

}

);

for (let input of allProductNotAliveInput) {

    input.addEventListener("click", function () {

        if (input.checked) {

            selectAllNotAlive = true;

        } else {

            selectAllNotAlive = false;

        }

        for (let input of allProductNotAliveInput) {

            if (!input.checked) {

                selectAllNotAlive = false;

            }

        }

        selectAllNotAliveInput.checked = selectAllNotAlive;

    });

}