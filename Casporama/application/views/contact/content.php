<!-- contact/content -->

<style>
    * {
        --color0 :#D9D9D9;
    }
</style>

<div class="contact">

    <div class="contact_title">
        <h1>Nous Contacter</h1>
        <p>Vous pouvez nous contacter par mail à l'adresse suivante : <a href="mailto:livecasporama@gmail.com">livecasporama@gmail.com</a></p>
    </div>

    <div class="contact_form">
        <p>Vous pouvez aussi nous contacter en remplisant le formulaire suivant:</p>

        <?= form_open('contact/index') ?>
        <div class="form_content">

            <div class="box">
                <p>Votre nom : </p>
                <input type="text" name="name">
            </div>

            <div class="box">
                <p>Votre Prénom :</p>
                <input type="text" name="firstname">
            </div>

            <div class="box">
                <p>Votre email : </p>
                <input type="email" name="email">
            </div>
            <div class="box">
                <p>Objet : </p>
                <input type="text" name="object">
            </div>

        </div>

        <div class="form_msg">

            <p>Votre message : </p>
            <textarea name="message" cols="30" rows="10"></textarea>
            
        </div>

        <div class="form_submit">
            <input type="submit" value="Envoyer">
        </div>
        <?= form_close() ?>
    </div>

    <div class="contact_error">

    <?php if (isset($error) && $error[0] != "") : ?>
        <div class="error">
            <img src="<?= base_url() ?>static/image/icon/error_white.svg" alt="error_white">
            <div class="error_text">
                <?php foreach ($error as $e) { ?>
                <p><?= $e ?></p>
                <?php } ?>
            </div>  
        </div>
    <?php endif; ?>

    </div>

</div>

<!-- contact/content -->
