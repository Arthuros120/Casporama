<!-- user/home/modale/modifFirstName/script -->

<script type="text/javascript">

    const modalBody = document.getElementById('modal-body');
    const form = document.getElementById("modifForm");

    form.addEventListener("submit", function(event) {

        event.preventDefault();

        var newEmail = document.getElementById("newEmail").value;

        modalBody.innerHTML = "<p> Votre email vas être modifié en " + newEmail + "</p>";

        modalBody.innerHTML += "<p> Voulez-vous vraiment effectuer cette modification ? </p>";

        modalBody.innerHTML += "<form " +
        "action='<?= base_url('User/home/modifEmail'); ?>'" +
        "method='post'" +
        "accept-charset='utf-8'>" +
        "<input type='hidden' name='newEmail' value='" + newEmail + "' />" +
        "<button type='submit'>Valider</button>" +
        "<a class='close-button' href='<?= base_url('User/home/info'); ?>'>" +
        "<p>Annuler</p>" +
        "</a>" +
        "</form>";

    });

</script>

<?php echo form_open('User/home/modifEmail'); echo form_close() ?>

<!-- user/home/modale/modifFirstName/script -->
