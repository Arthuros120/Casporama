<!--- user/home/modale/modifFirstName/content -->

<div class="modal_modif_content">
    <div class="modal_title">
        <h1>Changement de votre prénom</h1>
    </div>
    <div class="modal_form_content">

        <div class="modal_actual_name">
            <p>Votre prénom actuel:</p>
            <p class="actual_name"><?= $user->getCoordonnees()->getPrenom() ?></p>
        </div>

        <form class="modal_form" id="modifForm" accept-charset="utf-8">
            <input class="modal_input" type="text" id="newFirstName" placeholder="Nouveau prénom" required />
            <div class="modal_form_btn">
                <input class="modal_input" type="submit" value="Valider"/>
                <a class="close-button modal_input" href="javascript:history.back()"><p>Annuler</p></a>
            </div>
        </form>
    </div>
</div>





<!-- user/home/modale/modifFirstName/content -->
