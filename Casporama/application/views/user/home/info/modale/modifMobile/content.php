<!--- user/home/modale/modifMobile/content -->

<div class="modal_modif_content">
    <div class="modal_title">
        <h1>Changement de votre numéro de téléphone</h1>
    </div>
    <div class="modal_form_content">

        <div class="modal_actual_name">
            <p>Votre numéro de téléphone actuel:</p>
            <p class="actual_name"><?= $user->getCoordonnees()->getTelephone() ?></p>
        </div>

        <form class="modal_form" id="modifForm" accept-charset="utf-8">
            <input class="modal_input" type="tel" id="newMobile" placeholder="Nouveau numéro de téléphone" required />
            <div class="modal_form_btn">
                <input class="modal_input" type="submit" value="Valider"/>
                <a class="close-button modal_input" href="<?= base_url('User/home/info'); ?>"><p>Annuler</p></a>
            </div>
        </form>
    </div>
</div>


<!-- user/home/modale/modifMobile/content -->
