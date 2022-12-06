<!--- user/home/modale/modifEmail/content -->


<div class="modal_modif_content">
    <div class="modal_title">
        <h1>Changement de votre email</h1>
    </div>
    <div class="modal_form_content">

        <div class="modal_actual_name">
            <p>Votre email actuel:</p>
            <p class="actual_name"><?= $user->getCoordonnees()->getEmail() ?></p>
        </div>

        <form class="modal_form" id="modifForm" accept-charset="utf-8">
            <input class="modal_input" type="email" id="newEmail" placeholder="Nouvelle email" required />
            <div class="modal_form_btn">
                <input class="modal_input" type="submit" value="Valider"/>
                <a class="close-button modal_input" href="<?= base_url('User/home/info'); ?>"><p>Annuler</p></a>
            </div>
        </form>
    </div>
</div>

<!-- user/home/modale/modifEmail/content -->
