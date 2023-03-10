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
} )
</script>

<div class="global_product">
    <div class="left_product">
        <div id="filter" class="product_filter">
            <div class="filter_title">
                <h2>Filtre</h2>
            </div>

            <hr>

            <div class="brand_title">
                    <h3>Marque</h3>
            </div>
            <div class="brand_input">
                <input class="brandFilter filter"  type="checkbox" name="AllBrand" id="AllBrand">Tous</input>
                <?php foreach ($brands as $brand): ?>
                    <input class="brandFilter filter" type="checkbox" name="<?= $brand ?>"><?= $brand ?></input>
                <?php endforeach ?>
            </div>

            <div class="price_title">
                <h3>Prix</h3>
            </div>

            <div class="price_input">

                <p>Entre</p>

                <input
                class="priceFilter filter"
                type="number"
                step="0.01"
                name="minPrice"
                id="minPrice"
                placeholder="Prix min"></input>

                <p>et</p>

                <input
                class="priceFilter filter"
                type="number"
                step="0.01"
                name="maxPrice"
                id="maxPrice"
                placeholder="Prix max"></input>

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

            <div class="active_filter_title">
                <h3>Filtre Actifs :</h3>
            </div>

            <div class="active_filter">
                <p><?= $title ?> </p>
            </div>

            <div class="delete_filter">
                    <input type="button", id="supprFilter" value="Supprimer tous les filtres" >
            </div>


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
                        <p><?= $product->getPrice() ?>???</p>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
   
</div>

<!-- shop/global/viewContent -->


