<!-- shop/global/header -->

<header>
    <nav class="nav">
        <div class="left">
            <a href="<?= base_url() ?>"><h1>ca<span>spor</span>ama</h1></a>
        </div>
        <div class="right">
            <ul class="list_nav">
                <li class="nav_button">
                    <div class="text" >
                        <a class="button_link" href="<?= base_url("/Shop/view/" . $sport . "/Vetement") ?>">Vêtements</a>
                    </div>
                    <div class="text">
                        <a class="button_link" href="<?= base_url("/Shop/view/" . $sport . "/Chaussure") ?>" >Chaussures</a>
                    </div>
                    <div class="text">
                        <a class="button_link" href="<?= base_url("/Shop/view/" . $sport . "/Equipement") ?>" >Equipement</a>
                    </div>
                </li>
                <li class="list_line">
                    <hr>
                </li>
                <li class="icon">
                    <div class="list_icon">
                        <a href="<?= base_url("/Card")?>"> <img class="img1" src="<?php echo base_url() ?>static/image/icon/bag.svg" alt="Icone de panier"/></a>
                        <a href="<?= base_url("/User/login")?>"><img class="img2" src="<?= $userIcon ?>" alt="Icone de compte"/></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- shop/global/header -->
