var link = document.getElementById('home');
document.addEventListener('click', function (e) {
    if (e.target.id === link.id) {
        e.preventDefault();
    }
});
