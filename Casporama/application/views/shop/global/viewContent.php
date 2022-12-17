<!-- shop/global/viewContent -->


<script>
    window.addEventListener('scroll' , () => {
    const filter = document.querySelector('.product_filter')

    if (window.scrollY > 100) {
        filter.classList.add('product_filter_scrolled')
        filter.classList.remove('product_filter_unscrolled')
    }

    if (window.scrollY < 100) {
        filter.classList.add('product_filter_unscrolled')
        filter.classList.remove('product_filter_scrolled')
    }
} )
</script>

<div class="global_product">
    <div class="left_product">
        <div class="product_filter">
        </div>
    </div>
    <div class="right_product">
        <div class="all_card">
            <?php foreach ($listProduct as $product) {?>
            <div class="product_card">
                <a class="product_link" href="<?= base_url('shop/product/'.$product->getId()) ?>">
                    <div class="img">
                        <img src="<?=$product->getCover()?>" alt="">
                    </div>
                    <div class="desc">
                        <h2><?= $product->getName() ?></h2>
                        <p><?= $product->getBrand() ?></p>
                        <p><?= $product->getPrice() ?>€</p>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
   
</div>

<!-- shop/global/viewContent -->


