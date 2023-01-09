<!--  order/confirm/content -->

<div class="delete_caspor_content">
    <div class="delete_caspor_title">
        <a href="<?= base_url() ?>Admin/viewOrder?idorder=<?= $idorder ?>">
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
                <h1>Etes-vous sûr de vouloir annuler la commande ?</h1>
                <div class="delete_caspor_card_desc">
                    <p>
                        Annuler la commande n°<?= $idorder ?> sera irréversible
                    </p>
                </div>
            </div>
            <div class="delete_caspor_button">
                <a href="<?= base_url() ?>Admin/viewOrder?idorder=<?= $idorder ?>"><h3>Je garde la Commande</h3></a> 
                <a href="<?= base_url() ?>Admin/cancelOrder?idorder=<?= $idorder ?>"><h3>J'annule la Commande</h3></a>
            </div>
        </div>
    </div>
</div>

<!--  order/confirm/content -->
