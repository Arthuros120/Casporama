<!-- user/home/modale/modifFirstName/script -->

<script type="text/javascript">

    const modalBody = document.getElementById('modal-body');
    const form = document.getElementById("modifForm");

    form.addEventListener("submit", function(event) {

        event.preventDefault();

        var newFixe = document.getElementById("newFixe").value;

        modalBody.innerHTML = "<p> Votre numéro de téléphone fixe vas être modifié en " + newFixe + "</p>";

        modalBody.innerHTML += "<p> Voulez-vous vraiment effectuer cette modification ? </p>";

        modalBody.innerHTML += "<form " +
        "action='<?= base_url('User/home/modifFixe'); ?>'" +
        "method='post'" +
        "accept-charset='utf-8'>" +
        "<input type='hidden' name='newFixe' value='" + newFixe + "' />" +
        "<button type='submit'>Valider</button>" +
        "<a class='close-button' href='<?= base_url('User/home/info'); ?>'>" +
        "<p>Annuler</p>" +
        "</a>" +
        "</form>";

    });

</script>

<?php echo form_open('User/home/modifFixe'); echo form_close() ?>

<!-- user/home/modale/modifFirstName/script -->
