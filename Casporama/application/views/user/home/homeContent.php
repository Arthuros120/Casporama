<!-- user/home/homeContent -->

<div class="user_home_content">
    <div class="user_nav">
        <a href="<?= base_url() ?>">
            <img src="<?= base_url() . "static/image/icon/casporama.svg" ?>" alt="Casporama" />
        </a>
    </div>
    <div class="user_account">
        <div class="user_title">
            <h1>Bonjour <span><?= $user->getCoordonnees()->getPrenom() ?></span> - Votre Compte</h1>
            <hr>
        </div>
        <div class="user_info">
            <a class="user_btn" onmouseenter ="hover(this)" href="<?php echo base_url('User/home/info'); ?>">
                <h3>Consulter mes informations</h3>
                <img class="user_img" src="<?= base_url() . "static/image/icon/info.svg" ?>" alt="info" />
            </a>
            <a class="user_btn" onmouseenter="hover(this)" href="<?php echo base_url('User/card'); ?>">
                <h3>Mon panier</h3>
                <img class="user_img" src="<?= base_url() . "static/image/icon/bag_outline.svg" ?>" alt="bag_outline" />
            </a>
            <a class="user_btn" onmouseenter="hover(this)" href="<?php echo base_url('User/command'); ?>">
                <h3>Mes commandes</h3>
                <img class="user_img" src="<?= base_url() . "static/image/icon/delivery.svg" ?>" alt="arrow" />
            </a>
            <?php if ($user -> getStatus() == "Client") { ?>
                <a class="user_btn" onmouseenter="hover(this)" href="<?= base_url('User/newCaspor') ?>">
                    <h3>Devenir un Caspor</h3>
                    <img class="user_img" src="<?= base_url() . "static/image/icon/castor/castor_outline.png" ?>" alt="castor" />
            <?php } ?>
            <?php if ($user -> getStatus() == "Administrateur") { ?>
                <a class="user_btn" onmouseenter="hover(this)" href="<?= base_url('admin/home') ?>">
                    <h3>Panneau Administrateur</h3>
                    <img class="user_img" src="<?= base_url() . "static/image/icon/admin.svg" ?>" alt="admin" />
            <?php } ?> 
            <a class="user_btn" onmouseenter="hover(this)" href="<?php echo base_url('User/logout'); ?>">
                <h3>Se déconnecter</h3>
                <img class="arrow" src="<?= base_url() . "static/image/icon/arrow.png" ?>" alt="arrow" />
            </a>
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
