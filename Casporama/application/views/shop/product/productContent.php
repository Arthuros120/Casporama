<!-- shop/product/productContent -->

<div class="productContent">
    <ul class="grid_product">
        <li class="card1">
            <ul class="grid_img">
                <li class="second_img">
                    <?php for ($i = 1; $i < count($product->getImages()) - 1; $i++) : ?>
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
                        <?php if (!empty($avalaibleColors)) { ?>
                        <div class="color">
                            <h2>Couleur</h2>
                            <div class="allbox">
                                <?php foreach ($avalaibleColors as $color) : ?>
                                    <a href="<?= base_url() ."shop/product/" . $product->getId() . "?color=" . $color?>" class="box" a><?=$color?></a>
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php } echo form_open('Cart/add');
                        if (isset($avalaibleSize)) { ?>
                        <div class="size">
                            <h2>Taille</h2>
                            <div class="allbox">
                                <input type="hidden" name="color" value=<?= $this->input->get()['color']; ?>/>
                                <input type="hidden" name="idproduct" value=<?= $product->getId() ?>/>
                                <?php foreach ($taille as $value) : ?>
                                    <input type="radio" name="size" value=<?= $value ?> class="box" <?php if (!in_array($value,$avalaibleSize)) {  echo "disabled";} ?>><?= $value ?></input>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="description">
                        <h2>Description</h2>
                        <p><?= $product -> getDescription() ?></p>
                    </div>
                    <div class="price">
                        <h2><?= $product -> getPrice() ?>€</h2>
                    </div>
                    <div class="form">
                        <input type="submit" value="AJOUTER AU PANIER"/>
                    </div>
                    </form>
                </div> 
            </div>
        </li>
    </ul>
</div>


<!-- shop/product/productContent -->
