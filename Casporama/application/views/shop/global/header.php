<!-- shop/global/header -->

<header>
    <nav class="nav">
        <div class="left">
            <a href="<?= base_url() ?>"><h1>ca<span>spor</span>ama</h1></a>
        </div>
        <div class="right">
            <ul class="list_nav">
                <li class="text black_text" ><a href="<?= base_url("/Shop/view/" . $sport . "/Vetement") ?>">Vêtements</a></li>
                <li class="text"><a href="<?= base_url("/Shop/view/" . $sport . "/Chaussure") ?>">Chaussures</a></li>
                <li class="text"><a href="<?= base_url("/Shop/view/" . $sport . "/Equipement") ?>">Equipement</a></li>

                <div class="list_line">
                    <hr>
                </div>

                <li class="icon"><a class="list_icon" href="<?= base_url("/User/panier")?>"><img src="<?php echo base_url() ?>static/image/shop.png"/></a></li>
                <li class="icon"><a class="list_icon" href="<?= base_url("/User/login")?>"><img src="<?php echo base_url() ?>static/image/account.png"/></a></li>
            </ul>
        </div>
    </nav>
</header>

<!-- shop/global/header -->