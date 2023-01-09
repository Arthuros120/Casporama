<!--  order/confirm/content -->

<div class="delete_caspor_content">
    <div class="delete_caspor_title">
        <a href="<?= base_url() ?>Order">
            <img src="<?= base_url() ?>static/image/icon/arrow.svg" alt="arrow">
        </a> 
        <img src="<?= base_url() ?>static/image/casporama.png" alt="logo">
    </div>
    <div class="delete_caspor_grid">
        <div class="delete_caspor_card">
            <img src="<?= base_url() ?>static/image/icon/sad_emoji.svg" >
        </div>
        <div class="delete_caspor_card">
            <div class="delete_caspor_card_text">
                <h1>Etes-vous sûr de vouloir annuler votre commande ?</h1>
                <div class="delete_caspor_card_desc">
                    <p>Après avoir annuler votre commande nous serons <span style='color:darkred'>triste</span>. 
                        Nous vous conseillons de bien réfléchir avant de faire le choix fatidique.
                    </p>
                </div>
            </div>
            <div class="delete_caspor_button">
                <a href="<?= base_url() ?>Order"><h3>Je garde ma Commande</h3></a> 
                <a href="<?= base_url() ?>Order/cancelOrder?idorder=<?= $idorder ?>"><h3>J'annule ma Commande</h3></a>
            </div>
        </div>
    </div>
</div>

<!--  order/confirm/content -->
