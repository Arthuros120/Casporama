'use strict';

let allInput = document.getElementsByClassName("filter");

let sportCheckbox = document.getElementsByClassName("sportFilter");
let catCheckbox = document.getElementsByClassName("catFilter");
let brandCheckbox = document.getElementsByClassName("brandFilter");
let minPriceInput = document.getElementById("minPrice");
let maxPriceInput = document.getElementById("maxPrice");
let supprPriceFilter = document.getElementById("supprPriceFilter");
let searchInput = document.getElementById("searchFilter");
let supprSearchFilter = document.getElementById("supprSearchFilter");
let supprFilter = document.getElementById("supprFilter");

let sportFilter = [];
let catFilter = [];
let brandFilter = [];
let priceFilter = {
    min: -1,
    max: -1
}
let searchFilter = "";

initInputs();

function initInputs() {

    let param = new URL(window.location.href).searchParams;

    let sport = param.get('sport');
    let cat = param.get('category');
    let brand = param.get('brand');
    let price = param.get('price');
    let search = param.get('search');

    initInputSport(sport);
    initInputCat(cat);
    initInputBrand(brand);
    initInputPrice(price);
    initInputSearch(search);

    supprFilter.addEventListener('click', function () {

        sportFilter = [];
        catFilter = [];
        brandFilter = [];
        priceFilter.min = -1;
        priceFilter.max = -1;
        searchFilter = "";

        changeUrl();

    })

    for (let input of allInput) {

        input.addEventListener('change', function () {

            changeUrl();

        })

    }

}

function changeUrl() {

    let url = new URL(window.location.href);

            let param = new URLSearchParams(url.search);

            if (sportFilter.length >= sportCheckbox.length - 1) {

                sportFilter = [];

            }

            if (catFilter.length >= catCheckbox.length - 1) {

                catFilter = [];

            }

            if (brandFilter.length >= brandCheckbox.length - 1) {

                brandFilter = [];

            }

            if (sportFilter.length > 0) {

                param.set('sport', sportFilter);

            } else {

                param.delete('sport');

            }

            if (catFilter.length > 0) {

                param.set('category', catFilter);

            } else {

                param.delete('category');

            }

            if (brandFilter.length > 0) {

                param.set('brand', brandFilter);

            } else {

                param.delete('brand');

            }

            if (priceFilter.min !== -1 && priceFilter.max !== -1) {

                param.set('price', priceFilter.min + '-' + priceFilter.max);

            } else if (priceFilter.min === -1 && priceFilter.max !== -1) {

                param.set('price', '0-' + priceFilter.max);

            } else if (priceFilter.min !== -1 && priceFilter.max === -1) {

                param.set('price', priceFilter.min + '-1000000');

            } else {

                param.delete('price');

            }

            if (searchFilter !== "") {

                param.set('search', searchFilter);

            } else {

                param.delete('search');

            }

            url.search = param.toString();

            window.location.href = url
}

function initInputSearch(search) {

    if (search !== null) {

        searchInput.value = search;

        searchFilter = search;

    }

    searchInput.addEventListener('change', function () {

        searchFilter = searchInput.value;

    })

    supprSearchFilter.addEventListener('click', function () {

        searchFilter = "";

        searchInput.value = "";

        changeUrl();

    })
}

function initInputPrice(price) {

    if (price !== null) {

        price = price.split('-');

        priceFilter.min = parseInt(price[0]);
        priceFilter.max = parseInt(price[1]);

        minPriceInput.value = priceFilter.min;
        maxPriceInput.value = priceFilter.max;

    }

    minPriceInput.addEventListener('change', function () {

        if (parseInt(minPriceInput.value) < 0) {

            minPriceInput.value = 0;
            priceFilter.min = 0;

        } else if (parseInt(minPriceInput.value) > priceFilter.max) {

            let temp = parseInt(minPriceInput.value);

            minPriceInput.value = priceFilter.max;
            priceFilter.min = priceFilter.max;

            priceFilter.max = temp;
            maxPriceInput.value = temp;

        } else {

            priceFilter.min = parseInt(minPriceInput.value);

        }

    })

    maxPriceInput.addEventListener('change', function () {

        if (parseInt(maxPriceInput.value) < 0) {

            maxPriceInput.value = 1000000;
            priceFilter.max = 1000000;

        } else if (parseInt(maxPriceInput.value) < priceFilter.min) {

            let temp = parseInt(maxPriceInput.value);

            maxPriceInput.value = priceFilter.min;
            priceFilter.max = priceFilter.min;

            priceFilter.min = temp;
            minPriceInput.value = temp;

        } else {

            priceFilter.max = parseInt(maxPriceInput.value);

        }

    })

    supprPriceFilter.addEventListener('click', function () {

        priceFilter.min = -1;
        priceFilter.max = -1;

        minPriceInput.value = '';
        maxPriceInput.value = '';

        changeUrl();

    })

}

function initInputBrand(brand) {

    if (brand !== null) {

        brand = brand.split(',');

        for (let brandName of brand) {

            for (let checkBox of brandCheckbox) {

                if (checkBox.name === brandName) {

                    checkBox.checked = true;

                    brandFilter.push(checkBox.name);

                }
            }
        }

    } else {

        document.getElementById('AllBrand').checked = true;

    }

    for (let checkBox of brandCheckbox) {

        if (checkBox.name === 'AllBrand') {

            checkBox.addEventListener('click', function () {

                if (checkBox.checked) {

                    for (let checkBox of brandCheckbox) {

                        checkBox.checked = false;

                        brandFilter = [];

                    }

                    checkBox.checked = true;

                } else {

                    brandFilter = brandFilter.filter((brand) => brand !== checkBox.name);

                }
            })

        } else {

            checkBox.addEventListener('click', function () {

                if (checkBox.checked) {

                    brandFilter.push(checkBox.name);

                } else {

                    brandFilter = brandFilter.filter((brand) => brand !== checkBox.name);

                }
            })
        }
    }

}

function initInputCat(cat) {

    if (cat !== null) {

        cat = cat.split(',');

        for (let catName of cat) {
            
            for (let checkBox of catCheckbox) {;

                if (checkBox.name === catName) {

                    checkBox.checked = true;

                    catFilter.push(checkBox.name);

                }

            }

        }

    } else {

        document.getElementById('AllCat').checked = true;

    }

    for (let checkBox of catCheckbox) {

        if (checkBox.name === 'AllCat') {

            checkBox.addEventListener('click', function () {

                if (checkBox.checked) {

                    for (let checkBox of catCheckbox) {

                        checkBox.checked = false;

                        catFilter = [];

                    }

                    checkBox.checked = true;

                } else {

                    catFilter = catFilter.filter((cat) => cat !== checkBox.name);

                }
            })

        } else {

            checkBox.addEventListener('click', function () {

                if (checkBox.checked) {

                    catFilter.push(checkBox.name);

                    document.getElementById('AllCat').checked = false;

                } else {

                    catFilter = catFilter.filter((cat) => cat !== checkBox.name);

                }
            })

        }
    }
}

function initInputSport(sport) {

    if (sport !== null) {

        sport = sport.split(',');

        for (let sportName of sport) {
            
            for (let checkBox of sportCheckbox) {

                if (checkBox.name === sportName) {

                    checkBox.checked = true;

                    sportFilter.push(checkBox.name);

                }
            }
        }

    } else {

        document.getElementById('AllSport').checked = true;

    }

    for (let checkBox of sportCheckbox) {


        if (checkBox.name === 'AllSport') {

            checkBox.addEventListener('click', function () {

                if (checkBox.checked) {

                    for (let checkBox of sportCheckbox) {

                        checkBox.checked = false;

                        sportFilter = [];

                    }

                    checkBox.checked = true;

                } else {

                    sportFilter = sportFilter.filter((sport) => sport !== checkBox.name);

                }
            })

        } else {

            checkBox.addEventListener('click', function () {

                if (checkBox.checked) {

                    sportFilter.push(checkBox.name);

                } else {

                    sportFilter = sportFilter.filter((sport) => sport !== checkBox.name);

                }
            })
        }
    }
}