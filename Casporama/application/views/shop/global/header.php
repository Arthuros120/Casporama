<!-- shop/global/header -->

<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

<header>
    <nav class="nav">
        <a href="<?= base_url() ?>"><h1 class="logo">ca<span>spor</span>ama</h1></a>
        <input type="checkbox" id="toggler" />
        <label for="toggler"><i class="ri-menu-line"></i></label>
        <div class="menu">
            <ul class="nav_button">
                <li class="text">
                    <a class="button_link" href="<?= base_url("/Shop/view/" . $sport . "/Vetement") ?>">Vêtements</a>
                </li>
                <li class="text">
                    <a class="button_link" href="<?= base_url("/Shop/view/" . $sport . "/Chaussure") ?>" >Chaussures</a>
                </li>
                <li class="text">
                    <a class="button_link" href="<?= base_url("/Shop/view/" . $sport . "/Equipement") ?>" >Equipement</a>
                </li>
                <li>
                    <a href="<?= base_url("/Cart")?>"> <img class="img1" src="<?php echo base_url() ?>static/image/icon/bag.svg" alt="Icone de panier"/></a>
                </li>
                <li>
                    <a href="<?= base_url("/User/login")?>"><img class="img2" src="<?= $userIcon ?>" alt="Icone de compte"/></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- shop/global/header -->
