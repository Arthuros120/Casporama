<!-- user/home/homeContent -->


<div class="user_home_content">
    <div class="user_nav">
        <a href="<?= base_url() ?>">
            <img src="<?= base_url() . "static/image/icon/casporama.svg" ?>" alt="Casporama" />
        </a>
    </div>
    <div class="user_account">
        <div class="user_title">
            <h1>Bonjour <span class="name"></span><?= $user->getCoordonnees()->getPrenom() ?> - Votre Compte</h1>
            <hr>
        </div>
    </div>

</div>

<!--

<a href="<?php echo base_url('User/home/info'); ?>">Consulter mes informations</a></br>
<a href="<?php echo base_url('User/card'); ?>">Mon panier</a></br>
<a href="<?php echo base_url('User/command'); ?>">Mes commandes</a></br>

<?php

    if ($user -> getStatus() == "Client") {

        echo "<a href='" . base_url('User/newCaspor') . "'>Devenir un Caspor</a></br>";

    }

    if ($user->getStatus() == "Administrateur") {

        echo "<a href='" . base_url('admin/home') . "'>Accéder au panneaux administrateur</a></br>";

    }

?>


<a href="<?php echo base_url('User/logout'); ?>">Se déconnecter</a> -->

<!-- user/home/homeContent -->
