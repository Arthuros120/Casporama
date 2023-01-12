'use strict';

let allSelectAllInput = document.getElementsByClassName("selectAll");

let matchCatalogInput = Array();

for (let input of allSelectAllInput) {

    let classCheckbox = input.id.split("-");

    classCheckbox = "selectCatalog-" + classCheckbox[1] + "-" + classCheckbox[2];

    matchCatalogInput[input.id] = document.getElementsByClassName(classCheckbox);

}

for (let input of allSelectAllInput) {

    input.addEventListener("click", function () {

        for (let input of matchCatalogInput[this.id]) {

            input.checked = this.checked;

        }

    });

}