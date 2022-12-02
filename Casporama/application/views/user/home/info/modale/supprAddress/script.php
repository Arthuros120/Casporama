<!-- user/home/modale/supprAddress/script -->

<script type="text/javascript">

    const modalBody = document.getElementById('modal-body');
    const form = document.getElementById("supprAddress");

    form.addEventListener("submit", function(event) {

        event.preventDefault();

        var sameName = document.getElementById("sameName").value;

        modalBody.innerHTML = "<p> Votre addresse vas être modifié</p>";

        modalBody.innerHTML += "<p> Voulez-vous vraiment effectuer cette modification ? </p>";

        modalBody.innerHTML += "<form " +
        "action='<?= base_url('User/home/supprAddress/'); ?><?= $hint ?>'" +
        "method='post'" +
        "accept-charset='utf-8'>" +
        "<input type='hidden' name='sameName' value='" + sameName + "' />" +
        "<button type='submit'>Valider</button>" +
        "<a class='close-button' href='<?= base_url('User/home/info'); ?>'>" +
        "<p>Annuler</p>" +
        "</a>" +
        "</form>";

    });

</script>

<?php echo form_open('User/home/supprAddress/' . $hint); echo form_close() ?>

<!-- user/home/modale/supprAddress/script -->
