<!-- shop/global/viewContent -->


<script>
    window.addEventListener('scroll' , () => {
    const filter = document.getElementById('filter')

    if (window.scrollY > 100) {
        filter.classList.add('product_filter_scrolled')
        filter.classList.remove('product_filter_unscrolled')
    }

    if (window.scrollY < 100) {
        filter.classList.add('product_filter_unscrolled')
        filter.classList.remove('product_filter_scrolled')
    }

    if (window.scrollY >= 5500) {
        filter.classList.remove('product_filter_scrolled')
        filter.classList.add('product_end')
    }

    if (window.scrollY < 5000 && window.scrollY > 4000) {
        filter.classList.remove('product_end')
        filter.classList.add('product_filter_scrolled')
    }
} )
</script>

<div class="global_product">
    <div class="left_product">
        <div id="filter" class="product_filter">
            <h2>Filtre</h2>

            <div class="delete_filter">
                    <input type="button", id="supprFilter" value="Supprimer tous les filtres" >
            </div>

            <div class="brand_title">
                    <h3>Marque</h3>
                </div>
                <div class="brand_input">
                    <input class="brandFilter filter"  type="checkbox" name="AllBrand" id="AllBrand">Tous</input>
                    <?php foreach ($brands as $brand): ?>
                        <input class="brandFilter filter" type="checkbox" name="<?= $brand ?>"><?= $brand ?></input>
                    <?php endforeach ?>
                </div>

            <div class="price_input">

                <p>Entre  <input
                class="priceFilter filter"
                type="number"
                name="minPrice"
                id="minPrice"
                placeholder="Prix min"></input>€</p>

                <p>et<input
                class="priceFilter filter"
                type="number"
                name="maxPrice"
                id="maxPrice"
                placeholder="Prix max"></input>€</p>

            </div>

            <div class="price_delete">
                <input class="filter" type="button" id="supprPriceFilter" name="supprPriceFilter" value="Supprimer le filtre">
            </div>

            <div class="filter_search">
                    <div class="search_title">
                        <h3>Recherche</h3>
                    </div>
                    
                    <div class="search_input">
                        <input class="searchFilter filter" id="searchFilter" type="text" name="search" placeholder="Recherche"></input>
                    </div>

                    <div class="search_delete">
                    <input class="filter" type="button" id="supprSearchFilter" name="supprSearchFilter" value="Supprimer le filtre">
                    </div>

            </div>
        </div>
    </div>
    <div class="right_product">
        <h2> Filtre Actifs : <?= $title ?> </h2>
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


