<!-- user/home/modale/supprUser/script -->

<script type="text/javascript">

    const modalBody = document.getElementById('modal-body');
    const form = document.getElementById("supprUser");

    form.addEventListener("submit", function(event) {

        event.preventDefault();

        var sameLogin = document.getElementById("sameLogin").value;

        modalBody.innerHTML = "<p> Votre compte vas être suprimé</p>";

        modalBody.innerHTML += "<p> Voulez-vous vraiment effectuer cette modification ? </p>";

        modalBody.innerHTML += "<form " +
        "action='<?= base_url('User/home/supprUser/'); ?>'" +
        "method='post'" +
        "accept-charset='utf-8'>" +
        "<input type='hidden' name='sameLogin' value='" + sameLogin + "' />" +
        "<button type='submit'>Valider</button>" +
        "<a class='close-button' href='<?= base_url('User/home/info'); ?>'>" +
        "<p>Annuler</p>" +
        "</a>" +
        "</form>";

    });

</script>

<?php echo form_open('User/home/supprUserx/'); echo form_close() ?>

<!-- user/home/modale/supprUser/script -->
