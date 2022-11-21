<!-- user/home/modale/modifFirstName/script -->

<script type="text/javascript">

    const modalBody = document.getElementById('modal-body');
    const form = document.getElementById("modifForm");

    form.addEventListener("submit", function(event) {

        event.preventDefault();

        var newFirstName = document.getElementById("newFirstName").value;

        modalBody.innerHTML = "<p> Votre prénom vas être modifié en " + newFirstName + "</p>";

        modalBody.innerHTML += "<p> Voulez-vous vraiment effectuer cette modification ? </p>";

        modalBody.innerHTML += "<form " +
        "action='<?= base_url('User/home/modifFirstName'); ?>'" +
        "method='post'" +
        "accept-charset='utf-8'>" +
        "<input type='hidden' name='newFirstName' value='" + newFirstName + "' />" +
        "<button type='submit'>Valider</button>" +
        "<a class='close-button' href='<?= base_url('User/home/info'); ?>'>" +
        "<p>Annuler</p>" +
        "</a>" +
        "</form>";

    });

</script>

<?php echo form_open('User/home/modifFirstName'); echo form_close() ?>

<!-- user/home/modale/modifFirstName/script -->
