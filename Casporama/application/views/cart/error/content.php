<!--  cart/error -->

<div class="delete_caspor_content">
    <div class="delete_caspor_title">
        <a href="<?= base_url() ?>Cart">
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
                <h1>Erreur de stock</h1>
                <div class="delete_caspor_card_desc">
                    <h3>Les produits présent dans le panier n°<?= $idcart ?> ne sont plus disponibles</h3>
                    <?php foreach ($err as $product) { ?>
                        <p>- <?= $product ?></p>
                    <?php } ?>
                    <p>Veuillez vérifier les quantités voulues de ces différents produits. Nous nous excusons pour le désagrément.</p>
                </div>
            </div>
            <div class="delete_caspor_button">
                <a href="<?= base_url() ?>Cart"><h3>Retourner au Panier</h3></a> 
            </div>
        </div>
    </div>
</div>

<!--  Cart/error -->