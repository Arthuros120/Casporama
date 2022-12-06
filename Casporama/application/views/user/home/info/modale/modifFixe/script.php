<!-- user/home/modale/modifFirstName/script -->

<script type="text/javascript">

    const modalBody = document.getElementById('modal-body');
    const form = document.getElementById("modifForm");

    form.addEventListener("submit", function(event) {

        event.preventDefault();

        var newFixe = document.getElementById("newFixe").value;

        modalBody.innerHTML ="<div class='modal_modif_content'>"
                             +"<div class='modal_title'>"
                             +"<h1> Voulez-vous vraiment effectuer cette modification ? </h1>"
                             +"</div>"
                             +"<div class='modal_form_content'>"
                             +"<div class='modal_actual_name'>"
                             +"<p>Votre numéro de téléphone fixe vas être modifié en :</p>"
                             +"<p class='actual_name'>"+newFixe+"</p>"
                             +"</div>"
                             +"<form class='modal_form' action='<?= base_url('User/home/modifFixe');?>' method='post' accept-charset='utf-8'>"
                             +"<input class='modal_input' type='hidden' name='newFixe' value='" + newFixe + "' />"
                             +"<div class='modal_form_btn'>"
                             +"<input class='modal_input' type='submit' value='Valider' >"
                             +"<a class='modal_input' class='close-button' href='<?= base_url('User/home/info'); ?>'><p>Annuler</p></a>"
                             +"</div>"
                             +"</form>"
                             +"</div>"
                             +"</div>"

    });

</script>

<?php echo form_open('User/home/modifFixe'); echo form_close() ?>

<!-- user/home/modale/modifFirstName/script -->
