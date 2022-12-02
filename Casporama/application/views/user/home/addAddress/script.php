<!-- user/home/modifAddress/script -->

<script
src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
crossorigin=""></script>

<script type="text/javascript" src="<?= base_url('static/js/global/map.js') ?>"></script>

<script type="text/javascript">
    var zipDep = -1;

    String.prototype.sansAccent = function() {
        var accent = [
            /[\300-\306]/g, /[\340-\346]/g, // A, a
            /[\310-\313]/g, /[\350-\353]/g, // E, e
            /[\314-\317]/g, /[\354-\357]/g, // I, i
            /[\322-\330]/g, /[\362-\370]/g, // O, o
            /[\331-\334]/g, /[\371-\374]/g, // U, u
            /[\321]/g, /[\361]/g, // N, n
            /[\307]/g, /[\347]/g, // C, c
        ];
        var noaccent = ['A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u', 'N', 'n', 'C', 'c'];

        var str = this;
        for (var i = 0; i < accent.length; i++) {
            str = str.replace(accent[i], noaccent[i]);
        }

        return str;
    }

    function setCountryList() {

        $.ajax({

            url: "<?= base_url() ?>api/v1/Location/AllCountry",

            type: "GET",

            success: function(data) {

                let countryList = JSON.parse(data);

                for (var i = 0; i < countryList.length; i++) {

                    $("select[name='country']").append(
                        "<option value='" + countryList[i] + "'>" + countryList[i] + "</option>"
                    );
                }
            }
        });
    }

    function setDepList(country) {

        $.ajax({

            url: "<?= base_url() ?>api/v1/Location/AllDep/" + country,

            type: "GET",

            success: function(data) {

                const selectBody = document.getElementById("department");

                selectBody.innerHTML = "";

                let depList = JSON.parse(data, true);

                for (let numberDep in depList) {

                    let dep = depList[numberDep];

                    if (numberDep < 10) {

                        numberDep = "0" + numberDep;

                    }

                    let value = numberDep + ";" + dep.sansAccent().replace('-', "+");
                    value = value.replace('\'', "+").replace(/ /g, "+");

                    $("select[name='department']").append(
                            "<option value='" + value + "'>" + numberDep + " - " + dep + "</option>"
                    );
                }
            },

            error: function(data) {

                const selectBody = document.getElementById("department");

                selectBody.innerHTML = "";

                $("select[name='department']").append(
                    "<option value='1000;Pays étrangé' selected>Pays étrangé</option>"
                );
            }
        });
    }

    function getZipDep(postCode) {

        if (postCode.length != 5) {

            zipDep = -1;
            return;

        }

        $.ajax({

            url: "<?= base_url() ?>api/v1/Location/ZipDep/" + postCode,

            type: "GET",

            async: false,

            success: function(data) {

                zipDep = JSON.parse(data, true);

            },

            error: function(data) {

                console.log(data);

                zipDep = -1;

            }
        });
    }

    function getCityDep(zipDepFct) {

        if (zipDepFct.toString().length != 2 || zipDepFct == -1) {

            return;

        }

        $.ajax({

            url: "<?= base_url() ?>api/v1/Location/cityDep/" + zipDepFct,

            type: "GET",

            success: function(data) {

                cityList = JSON.parse(data);

                const selectBody = document.getElementById("cityList");

                selectBody.innerHTML = "";

                for (var i = 0; i < cityList.length; i++) {

                    $("datalist[name='cityList']").append(
                        "<option value='" + cityList[i] + "'>" + cityList[i] + "</option>"
                    );
                }
            },

            error: function(data) {

                const selectBody = document.getElementById("department");

                selectBody.innerHTML = "";

            }
        });
    }

    function getPostalCode(zipDepFct, cityNameFct) {

        if (zipDepFct.toString().length != 2 || zipDepFct == -1 || cityNameFct == "") {

            return;

        }

        $.ajax({

            url: "<?= base_url() ?>api/v1/Location/postalCodeDepCity/" + zipDepFct + "/" + cityNameFct,

            type: "GET",

            success: function(data) {

                posteCodeList = JSON.parse(data);

                const selectBody = document.getElementById("postalList");

                selectBody.innerHTML = "";

                for (var i = 0; i < posteCodeList.length; i++) {

                    $("datalist[name='postalList']").append(
                        "<option value='" + posteCodeList[i] + "'>" + posteCodeList[i] + "</option>"
                    );
                }

            },

            error: function(data) {

                const selectBody = document.getElementById("postalList");

                selectBody.innerHTML = "";

            }
        });

    }

    function setCityName(postalCode) {

        if (postalCode.length != 5) {

            return

        }

        $.ajax({

            url: "<?= base_url() ?>api/v1/Location/cityNameByPostalCode/" + postalCode,

            type: "GET",

            success: function(data) {

                nameCity = JSON.parse(data);

                const selectBody = document.getElementById("cityList");

                selectBody.innerHTML = "";

                for (var i = 0; i < nameCity.length; i++) {

                    $("datalist[name='cityList']").append(
                        "<option value='" + nameCity[i] + "'>" + name[i] + "</option>"
                    );
                }
            },
        });
    }

    function getLatLong(number, street, postalCode) {

        let divMap = document.getElementById('div-map')

        if (postalCode.length != 5 || number == "" || street == "") {

            divMap.innerHTML = "Pas de localisation disponible";

        }

        apiLink = "<?= base_url() ?>api/v1/Location/latLongByAddressPostalCode/";

        street = street.sansAccent();
        streetStr = street.sansAccent().replace('\'', "+").replace(/ /g, "+");

        console.log(streetStr);

        api = apiLink + number.toString() + "/" + streetStr + "/" + postalCode.toString();

        $.ajax({

            url: api,

            type: "GET",

            success: function(data) {

                divMap.innerHTML = "<div class='map' id='map'></div>";

                jsonData = JSON.parse(data);

                initMapWithOneMarker(jsonData['latitude'], jsonData['longitude'], 'map');

            },

            error: function(data) {

                divMap.innerHTML = "<div class='map_error'><img src='<?= base_url() ?>"
                divMap.innerHTML += "static/image/icon/data_error.svg'><h3>Localisation non trouvée</h3></div>";

            }
        });
    }

    $(document).ready(function() {

        setCountryList();

    });

    $('#country').on('input', function(e) {

        setDepList($(this).val());

    });

    $('#postalCode').on('input', function(e) {

        number = document.getElementById('number').value;
        street = document.getElementById('street').value;

        getZipDep($(this).val());
        getCityDep(zipDep);
        getPostalCode(zipDep, document.getElementById("city").value)
        setCityName($(this).val());
        getLatLong(number, street, $(this).val());

    });

    $('#city').on('input', function(e) {

        getPostalCode(document.getElementById('department').value.split(";")[0], $(this).val());

    });

    $('#department').on('input', function(e) {

        getCityDep($(this).val().split(";")[0]);
        getPostalCode($(this).val().split(";")[0], document.getElementById("city").value);

    });

    $('#number').on('input', function(e) {

        street = document.getElementById('street').value;
        postalCode = document.getElementById('postalCode').value;

        getLatLong($(this).val(), street, postalCode);

    });

    $('#street').on('input', function(e) {

        number = document.getElementById('number').value;
        postalCode = document.getElementById('postalCode').value;

        getLatLong(number, $(this).val(), postalCode);

    });
</script>


<!-- user/home/modifAddress/script -->
