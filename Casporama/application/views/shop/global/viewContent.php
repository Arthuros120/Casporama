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
                <li class="card">
                    <a class="product_card" href="<?= base_url('shop/product/'.$product->get_id()) ?>">
                        <div class="oneProduct">
                            <div class="img">
                                <img src=<?= $product->get_cover() ?>>      
                            </div>
                        </div>
                        <div class="desc">
                            <h1><?= $product->get_Name() ?></h1>
                            <p><?= $product->get_brand() ?></p>
                            <p><?= $product->get_price() ?>€</p>
                        </div>
                    </a>
                </li>
                <?php endforeach;?>
            </ul>
        </li>
    </ul>
</div>

<!-- shop/global/viewContent -->