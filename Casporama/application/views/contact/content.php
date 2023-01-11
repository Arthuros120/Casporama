<!-- contact/content -->

<h1>Nous contactez</h1>

<p>Vous pouvez nous contacter par mail à l'adresse suivante :
    <a href="mailto:livecasporama@gmail.com">livecasporama@gmail.com</a>
</p>

<p>Vous pouvez aussi nous contacter en remplisant le formulaire suivant:</p>

<?php if (isset($error)) : ?>
    <p><?= $error ?></p>

<?php endif; ?>

<?= form_open('contact/index') ?>

<p>Votre nom : <input type="text" name="name"></p>
<p>Votre Prénom : <input type="text" name="firstname"></p>
<p>Votre email : <input type="email" name="email"></p>
<p>L'object de votre prise de contact: <input type="text" name="object"></p>
<p>Votre message : <textarea name="message" cols="30" rows="10"></textarea></p>
<p><input type="submit" value="Envoyer"></p>

<?= form_close() ?>

<!-- contact/content -->
