<!--- user/home/modale/modifPass/content -->

<div class="modal_modif_content">
    <div class="modal_title">
        <h1>Changement de votre nouveau mots de passe</h1>
    </div>
    <div class="modal_form_content">

        <form class="modal_form" id="modifForm" accept-charset="utf-8">
            <input class="modal_input" type="text" id="newFirstName" placeholder="Nouveau prénom" required />
            <div class="modal_form_btn">
                <input class="modal_input" type="submit" value="Valider"/>
                <a class="close-button modal_input" href="<?= base_url('User/home/info'); ?>"><p>Annuler</p></a>
            </div>
        </form>
    </div>
</div>


<h1></h1>

<h2>Veuillez entrer le nouveau mots de passe</h2>

<form id="modifForm" accept-charset="utf-8">

    <input type="password" id="pass" placeholder="Votre mots de passe actuel" required />
    <input type="password" id="newPass" placeholder="Nouveau mots de passe" required />
    <input type="password" id="confNewPass" placeholder="Comfirmation du nouveau mots de passe" required />

    <button type="submit">Valider</button>

    <a class="close-button" href="javascript:history.back()">
        <p>Annuler</p>
    </a>

</form>

<!-- user/home/modale/modifPass/content -->
