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
                    <a class="product_card" href="<?= base_url('shop/product/'.$product->getId()) ?>">
                        <div class="oneProduct">
                            <div class="img">
                                <img
                                alt="Image du produit"
                                src=<?= $product->getCover() ?>
                                >
                            </div>
                        </div>
                        <div class="desc">
                            <h1><?= $product->getName() ?></h1>
                            <p><?= $product->getBrand() ?></p>
                            <p><?= $product->getPrice() ?>€</p>
                        </div>
                    </a>
                </li>
                <?php endforeach;?>
            </ul>
        </li>
    </ul>
</div>

<!-- shop/global/viewContent -->
