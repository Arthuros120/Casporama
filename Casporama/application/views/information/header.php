<div class="home">
<nav class="home_nav">
    <div class="home_nav_left">
        <a href="<?= base_url()?>"><img src="<?= base_url()?>static/image/casporama.png"></a>
    </div>
    <?php if (isset($user)) { ?>
        <div class="home_nav_right">
            <a href="<?= base_url() ?>User/logout"><h2>Se déconnecter</h2></a>
            <a href="<?= base_url() ?>User/home"><h2>Mon compte</h2></a>
        </div>
    <?php } else { ?>
        <div class="home_nav_right">
            <a href="<?= base_url() ?>User/register"><h2>S'inscrire</h2></a>
            <a href="<?= base_url() ?>User/login"><h2>Se connecter</h2></a>
        </div>
    <?php } ?>
</nav>
</div>
