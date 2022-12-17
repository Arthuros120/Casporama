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
            <a class="user_btn" onmouseenter="hover(this)" href="<?php echo base_url('Cart'); ?>">
                <h3>Mon panier</h3>
                <img class="user_img" src="<?= base_url() . "static/image/icon/bag_outline.svg" ?>" alt="bag_outline" />
            </a>
            <a class="user_btn" onmouseenter="hover(this)" href="<?php echo base_url('User/command'); ?>">
                <h3>Mes commandes</h3>
                <img class="user_img" src="<?= base_url() . "static/image/icon/delivery.svg" ?>" alt="delivery" />
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
                <img class="arrow" src="<?= base_url() . "static/image/icon/arrow.svg" ?>" alt="arrow" />
            </a>
        </div>
    </div>

</div>
