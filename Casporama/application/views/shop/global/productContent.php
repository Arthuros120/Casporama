<!-- shop/global/productContent -->

<div class="productContent">
    <ul class="grid_product">
        <li class="card">
            <ul class="grid_img">
                <li class="second_img">
                    <?php for ($i = 1; $i < 2; $i++) : ?>
                    <div>
                        <img src="<?= base_url($product -> get_images()[$i]) ?>">
                    </div>
                    <?php endfor?>
                </li>
                <li class="main_img">
                    <div>
                        <img src=<?= $product->get_cover() ?>>
                    </div>
                </li>
            </ul>
        </li>
        <li class="card">
            <div class="brand">
                <h2><?= $product -> get_brand() ?></h2>
            </div>
            <div class="title">
                <h1><?= $product -> get_name() ?></h1>
            </div>

        </li>
    </ul>
</div>



<!-- <?= $product -> get_brand() ?>
<?= $product -> get_name() ?>
<?= $product -> get_description() ?>
<?= $product -> get_price() ?>
<img src=<?= $product->get_cover() ?>>
<img src="<?= base_url($product -> get_images()[1]) ?>">
<?= $product -> get_images()[1] ?> -->

<!-- shop/global/productContent -->