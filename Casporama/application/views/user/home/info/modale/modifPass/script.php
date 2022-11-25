<!-- user/home/modale/modifPass/script -->

<script type="text/javascript">

    const modalBody = document.getElementById('modal-body');
    const form = document.getElementById("modifForm");

    form.addEventListener("submit", function(event) {

        event.preventDefault();

        var pass = document.getElementById("pass").value;
        var newPass = document.getElementById("newPass").value;
        var confNewPass = document.getElementById('confNewPass').value;

        modalBody.innerHTML = "<p> Votre mots de passe vas être modifié</p>";

        modalBody.innerHTML += "<p> Voulez-vous vraiment effectuer cette modification ? </p>";

        modalBody.innerHTML += "<form " +
        "action='<?= base_url('User/home/modifPass'); ?>'" +
        "method='post'" +
        "accept-charset='utf-8'>" +
        "<input type='hidden' name='pass' value='" + pass + "' />" +
        "<input type='hidden' name='newPass' value='" + newPass + "' />" +
        "<input type='hidden' name='confNewPass' value='" + confNewPass + "' />" +
        "<button type='submit'>Valider</button>" +
        "<a class='close-button' href='<?= base_url('User/home/info'); ?>'>" +
        "<p>Annuler</p>" +
        "</a>" +
        "</form>";

    });

</script>

<?php echo form_open('User/home/modifPass'); echo form_close() ?>

<!-- user/home/modale/modifPass/script -->
