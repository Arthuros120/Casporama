<!-- caspor/myCaspor/content -->
<div class="mycaspor_content">
    <div class="mycaspor_title">
        <a href="<?= base_url() ?>User/home">
            <img src="<?= base_url() ?>static/image/icon/arrow.svg" alt="arrow">
        </a> 
        <img src="<?= base_url() ?>static/image/casporama.png" alt="logo">
    </div>
    <div class="mycaspor_body">
        <h1>Vous êtes un Ca<span>s</span><span>p</span><span>o</span><span>r</span></h1>
        <h3>Vous bénéficiez des avantages de notre offre Caspor</h3>
    </div>
    <div class="mycaspor_info">
        <h2><span>Membre depuis le :</span> <?=$dateLastUpdate[2]?>/<?=$dateLastUpdate[1]?>/<?=$dateLastUpdate[0]?> </h2>
        <h2><span>Abonnés depuis</span> <?php echo $dateSince ?>
        <h2><span>Prochain paiement</span> : <?= $nextPayment ?></h2>
    </div>

    <div class="mycaspor_leave">
        <a href="<?= base_url() ?>Caspor/deleteCaspor"><h3>Résilier abonnement</h3></a>
    </div>
</div>

<!-- caspor/myCaspor/content -->