<!-- user/home/modale/supprUser/content -->


<div class="modal_modif_content">
    <div class="modal_title">
        <h1>Suppresion de votre compte</h1>
    </div>
    <div class="modal_form_content">

        <div class="modal_actual_name">
            <p>Votre login:</p>
            <p class="actual_name"><?= $user->getLogin() ?></p>
        </div>

        <form class="modal_form" id="supprUser" accept-charset="utf-8">
            <input class="modal_input" type="text" id="sameLogin" placeholder="Valider avec votre login" required />
            <div class="modal_form_btn">
                <input class="modal_input" type="submit" value="Valider"/>
                <a class="close-button modal_input" href="<?= base_url('User/home/info'); ?>"><p>Annuler</p></a>
            </div>
        </form>
    </div>
</div>

<!-- user/home/modale/supprUser/content -->
