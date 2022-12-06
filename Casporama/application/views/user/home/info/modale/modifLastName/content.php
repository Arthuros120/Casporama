<!--- user/home/modale/modifLastName/content -->

<div class="modal_modif_content">
    <div class="modal_title">
        <h1>Changement du nom de famille</h1>
    </div>
    <div class="modal_form_content">

        <div class="modal_actual_name">
            <p>Votre nom actuel:</p>
            <p class="actual_name"> <?= $user->getCoordonnees()->getNom() ?></p>
        </div>

        <form class="modal_form" id="modifForm" accept-charset="utf-8">
            <input class="modal_input" type="text" id="newLastName" placeholder="Nouveau nom de famille" required />
            <div class="modal_form_btn">
                <input class="modal_input" type="submit" value="Valider"/>
                <a class="close-button modal_input" href="javascript:history.back()"><p>Annuler</p></a>
            </div>
        </form>
    </div>
</div>

<!-- user/home/modale/modifLastName/content -->
