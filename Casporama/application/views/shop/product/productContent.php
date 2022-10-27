<!-- shop/product/productContent -->

<div class="productContent">
    <ul class="grid_product">
        <li class="card">
            <ul class="grid_img">
                <li class="second_img">
                    <?php for ($i = 1; $i < 2; $i++) : ?>
                    <div>
                        <img
                        src="<?= base_url($product -> getImages()[$i]) ?>"
                        alt="Image du produit"
                        >
                    </div>
                    <?php endfor?>
                </li>
                <li class="main_img">
                    <div>
                        <img
                        alt="Image du produit"
                        src=<?= $product->getCover() ?>
                        >
                    </div>
                </li>
            </ul>
        </li>
        <li class="card">
            <div class="brand">
                <h2><?= $product -> getBrand() ?></h2>
            </div>
            <div class="title">
                <h1><?= $product -> getName() ?></h1>
            </div>

        </li>
    </ul>
</div>



<!-- <?= $product -> getBrand() ?>
<?= $product -> getName() ?>
<?= $product -> getDescription() ?>
<?= $product -> getPrice() ?>
<img src=<?= $product->getCover() ?>>
<img src="<?= base_url($product -> getImages()[1]) ?>">
<?= $product -> getImages()[1] ?> -->

<!-- shop/product/productContent -->
