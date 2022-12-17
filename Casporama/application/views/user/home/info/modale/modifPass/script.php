<!-- user/home/modale/modifPass/script -->

<script type="text/javascript">

    const modalBody = document.getElementById('modal-body');
    const form = document.getElementById("modifForm");

    form.addEventListener("submit", function(event) {

        event.preventDefault();

        var pass = document.getElementById("pass").value;
        var newPass = document.getElementById("newPass").value;
        var confNewPass = document.getElementById('confNewPass').value;

        
        modalBody.innerHTML ="<div class='modal_modif_content'>"
                             +"<div class='modal_title'>"
                             +"<h1> Voulez-vous vraiment effectuer cette modification ? </h1>"
                             +"</div>"
                             +"<div class='modal_form_content'>"
                             +"<div class='modal_actual_name'>"
                             +"<p>Votre mot de passe vas être modifié en :</p>"
                             +"<p class='actual_name'>"+newPass+"</p>"
                             +"</div>"
                             +"<form class='modal_form' action='<?= base_url('User/home/modifPass');?>' method='post' accept-charset='utf-8'>"
                             +"<input type='hidden' name='pass' value='" + pass + "' />"
                             +"<input type='hidden' name='newPass' value='" + newPass + "' />"
                             +"<input type='hidden' name='confNewPass' value='" + confNewPass + "' />"
                             +"<div class='modal_form_btn'>"
                             +"<input class='modal_input' type='submit' value='Valider' >"
                             +"<a class='modal_input' class='close-button' href='<?= base_url('User/home/info'); ?>'><p>Annuler</p></a>"
                             +"</div>"
                             +"</form>"
                             +"</div>"
                             +"</div>"

    });

</script>

<?php echo form_open('User/home/modifPass'); echo form_close() ?>

<!-- user/home/modale/modifPass/script -->
