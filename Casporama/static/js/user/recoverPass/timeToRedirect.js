let decompte = 10;
let prefixe = '';
let timer = setInterval(
    
    function() {
        decompte--;
        if (decompte > 1) {
            prefixe = ' secondes';
        } else {
            prefixe = ' seconde';
        }
        document.getElementById('time').textContent = decompte + prefixe;
        if (decompte === 0) {
            clearInterval(timer);
            window.location.href = "/"; // URL de redirection

        }
    },1000);