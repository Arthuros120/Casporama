<!-- contact/comfirmContent -->

<style>
    * {
        --color0 :#D9D9D9;
    }
</style>

<div class="confirm_contact">

    <div class="confirm_title">
        <h1> Bonjour <?= $firstname ?> </h1>
    </div>

    <div class="confirm_content">
        <p>Vous avez demandé à nous contacter par mail à l'adresse suivante : <span><?= $email ?></span> </p>
        <p>Vous avez demandé à nous contacter pour l'object suivant : <span><?= $object ?></span> </p>
        <p>Votre demande a bien été envoyé, nous vous répondrons dans les plus bref délais.</p>
    </div>

    <div class="confirm_return">
        <a href="<?= base_url() ?>" >Retourner à l'accueil</a>
    </div>

</div>





<!-- contact/comfirmContent -->
