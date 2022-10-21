<!-- shop/global/viewContent -->

<div class="global_product">
    <ul class="grid">
        <li class="card">
            <div class="filter">
                <div class="filter_content">
                    
                </div>
            </div>
        </li>
        <li class="card">
            <ul class="product">
                <?php foreach ($listProduct as $product):?>
                <li class="product_card">
                    <div class="oneProduct">
                        <div class="img">
                            <img src=<?= $product->get_image() ?>>      
                        </div>
                    </div>
                    <div class="desc">
                        <h1><?= $product->get_Name() ?></h1>
                        <p><?= $product->get_brand() ?></p>
                        <p><?= $product->get_price() ?>€</p>
                    </div>
                </li>
                <li class="product_card">
                    <div class="oneProduct">
                        <div class="img">
                            <img src=<?= $product->get_image() ?>>      
                        </div>
                    </div>
                    <div class="desc">
                        <h1><?= $product->get_Name() ?></h1>
                        <p><?= $product->get_brand() ?></p>
                        <p><?= $product->get_price() ?>€</p>
                    </div>
                </li>
                <li class="product_card">
                    <div class="oneProduct">
                        <div class="img">
                            <img src=<?= $product->get_image() ?>>      
                        </div>
                    </div>
                    <div class="desc">
                        <h1><?= $product->get_Name() ?></h1>
                        <p><?= $product->get_brand() ?></p>
                        <p><?= $product->get_price() ?>€</p>
                    </div>
                </li>
                <li class="product_card">
                    <div class="oneProduct">
                        <div class="img">
                            <img src=<?= $product->get_image() ?>>      
                        </div>
                    </div>
                    <div class="desc">
                        <h1><?= $product->get_Name() ?></h1>
                        <p><?= $product->get_brand() ?></p>
                        <p><?= $product->get_price() ?>€</p>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
        </li>
    </ul>
</div>