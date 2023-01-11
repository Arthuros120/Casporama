let decompte = 5;
let prefixe = '';

let timer = setInterval(

    function( ){

        decompte--;

        if ( decompte > 1 ) {

            prefixe = ' secondes';

        } else {

            prefixe = ' seconde';

        }

        document.getElementById('redirect').textContent = decompte + prefixe;

        if (decompte === 0) {

            clearInterval(timer);
            window.location.href = "/admin/user/"; // URL de redirection

        }
    },

    1000

);
