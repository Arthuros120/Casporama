<!-- user/home/modale/supprUser/script -->

<script type="text/javascript">

    const modalBody = document.getElementById('modal-body');
    const form = document.getElementById("supprUser");

    form.addEventListener("submit", function(event) {

        event.preventDefault();

        var sameLogin = document.getElementById("sameLogin").value;

        modalBody.innerHTML ="<div class='modal_modif_content'>"
                             +"<div class='modal_title'>"
                             +"<h1> Voulez-vous vraiment effectuer cette modification ? </h1>"
                             +"</div>"
                             +"<div class='modal_form_content'>"
                             +"<div class='modal_actual_name'>"
                             +"<p>Votre compte <span>"+sameLogin+"</span> va être supprmé</p>"
                             +"</div>"
                             +"<form class='modal_form' action='<?= base_url('User/home/supprUser');?>' method='post' accept-charset='utf-8'>"
                             +"<input class='modal_input' type='hidden' name='sameLogin' value='" + sameLogin + "' />"
                             +"<div class='modal_form_btn'>"
                             +"<input class='modal_input' type='submit' value='Valider' >"
                             +"<a class='modal_input' class='close-button' href='<?= base_url('User/home/info'); ?>'><p>Annuler</p></a>"
                             +"</div>"
                             +"</form>"
                             +"</div>"
                             +"</div>"

    });

</script>

<?php echo form_open('User/home/supprUserx/'); echo form_close() ?>

<!-- user/home/modale/supprUser/script -->
