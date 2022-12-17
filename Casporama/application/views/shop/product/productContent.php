<!-- shop/product/productContent -->

<?php echo form_open('Card/add'); ?>

<div class="productContent">
    <ul class="grid_product">
        <li class="card1">
            <ul class="grid_img">
                <li class="second_img">
                    <?php for ($i = 1; $i < count($product->getImages()); $i++) : ?>
                    <div>
                        <a onclick="changeImage('<?=$product->getImages()[$i];?>')"><img src="<?= base_url($product -> getImages()[$i]) ?>" alt="Image du produit" ></a>
                    </div>
                    <?php endfor?>
                </li>
                <li class="main_img">
                    <div>
                        <img id="photo" alt="Image du produit" src=<?= $product->getCover() ?> >
                    </div>
                </li>
            </ul>
        </li>
        <li class="card2">
            <div class="info">
                <div class="haut">
                    <div class="brand">
                        <h2><?= $product -> getBrand() ?></h2>
                    </div>
                    <div class="title">
                        <h1><?= $product -> getName() ?></h1>
                    </div>
                </div>
                <div class="bas">
                    <?php if ($product->getStock()[0]->getColor() != null) : ?>
                        <div class="color">
                            <h2>Couleur</h2>
                            <div class="allbox">
                                <?php for ($i = 0; $i < count($product->getStock()); $i++) : ?>
                                <div class="box"><?= $product->getStock()[$i]->getColor() ?></div>
                                <?php endfor?>
                            </div>
                        </div>
                    <?php endif;?>
                    <div class="size">
                        <h2>Taille</h2>
                        <div class="allbox">
                            <div class="box">XS</div>
                            <div class="box">S</div>
                            <div class="box">M</div>
                            <div class="box">L</div>
                            <div class="box">XL</div>
                            <div class="box">XXL</div>
                        </div>
                    </div>
                    <div class="description">
                        <h2>Description</h2>
                        <p><?= $product -> getDescription() ?></p>
                    </div>
                    <div class="price">
                        <h2><?= $product -> getPrice() ?>€</h2>
                    </div>
                    <div class="form">
                        <button><h3>AJOUTER AU PANIER</h3></button>
                    </div>
                </div> 
            </div>
        </li>
    </ul>
</div>


<!-- shop/product/productContent -->
