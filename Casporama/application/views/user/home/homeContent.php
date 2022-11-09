<!-- user/home/homeContent -->

<a href="<?= base_url() ?>">

    <img src="<?= base_url() . "static/image/icon/casporama.svg" ?>" alt="Casporama" />

</a></br>

<a href="<?php echo base_url('user/home/info'); ?>">Consulter mes informations</a></br>
<a href="<?php echo base_url('user/home/modifEmail'); ?>">Modifier votre addresse mail</a></br>
<a href="<?php echo base_url('user/home/modifPass'); ?>">Modifier votre mot de passe</a></br>
<a href="<?php echo base_url('user/card'); ?>">Mon panier</a></br>
<a href="<?php echo base_url('user/command'); ?>">Mes commandes</a></br>

<?php

    if ($status == "Client") {

        echo "<a href='" . base_url('user/newCaspor') . "'>Devenir un Caspor</a></br>";

    }

    if ($status == "Administrateur") {

        echo "<a href='" . base_url('admin/home') . "'>Accéder au panneaux administrateur</a></br>";

    }

?>


<a href="<?php echo base_url('user/logout'); ?>">Se déconnecter</a>

<!-- user/home/homeContent -->
