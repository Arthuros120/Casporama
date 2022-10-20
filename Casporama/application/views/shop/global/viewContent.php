<!-- shop/global/viewContent -->


<link rel="stylesheet" href="<?php echo base_url()?>static/css/product_global.css">

<div class="global_product">
    <ul class="grid">
        <li class="card">FILTRE</li>
        <li class="card">
            <ul class="product">
                <?php foreach ($listProduct as $product):?>
                <li class="product_card">
                    <div class="oneProduct">
                        <div class="img">
                            <img src=<?= $product->get_image() ?>>      
                        </div>
                        <div class="desc">
                            <h1><?= $product->get_Name() ?></h1>
                            <p><?= $product->get_brand() ?></p>
                            <p><?= $product->get_price() ?>€</p>
                        </div>
                    </div>
                </li>
                <li class="product_card">
                    <div class="oneProduct">
                        <div class="img">
                            <img src=<?= $product->get_image() ?>>      
                        </div>
                        <div class="desc">
                            <h1><?= $product->get_Name() ?></h1>
                            <p><?= $product->get_brand() ?></p>
                            <p><?= $product->get_price() ?>€</p>
                        </div>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
        </li>
    </ul>
</div>

<!-- <?php foreach ($listProduct as $product):?>

    <h1><?= $product->get_Name() ?></h1>
    <p><?= $product->get_brand() ?></p>
    <p><?= $product->get_price() ?>€</p>
    <img src=<?= $product->get_image() ?>>
    <?php endforeach;?>  -->

<!-- shop/global/viewContent -->