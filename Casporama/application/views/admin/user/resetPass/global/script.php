<!-- admin/user/resetPass/global/script -->

<p>Vous allez êtres redirigé dans <span id="redirect">5 secondes</span> vers la gestion de l'utilisateur:
<?= $user->getCoordonnees()->getNom() ?> <?= $user->getCoordonnees()->getPrenom() ?></p>

<script type="text/javascript">

    let idUser = <?= $user->getId() ?>;

</script>

<script type="text/javascript" src="<?= base_url('static/js/user/admin/resetPass/redirect.js') ?>"></script>

<!-- admin/user/resetPass/global/script -->
