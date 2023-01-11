<!-- shop/product/productContent -->

<div class="productContent">
    <ul class="grid_product">
        <li class="card1">
            <ul class="grid_img">
                <li class="second_img">
                    <?php for ($i = 0; $i < count($product->getImages()); $i++) : ?>
                    <div>
                        <a onclick="changeImage('<?=base_url($product->getImages()[$i]);?>')"><img src="<?= base_url($product -> getImages()[$i]) ?>" alt="Image du produit" ></a>
                    </div>
                    <?php endfor?>
                </li>
                <li class="main_img">
                    <div>
                        <img id="photo" alt="Image du produit" src=<?= base_url($product->getImages()[0])?>>
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
                                    <div class="box">
                                        <a href="<?= base_url() ."shop/product/" . $product->getId() . "?color=" . $color ?>" class="box" a><p><?= str_replace('+', ' ', $color)?></p></a>
                                    </div>    
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php } else { ?>
                    
                        <div class="form">
                            <h3>Actuellement Indisponible</h3>
                        </div>

                    <?php } echo form_open('Cart/add');
                        if (isset($avalaibleSize)) { ?>
                        <div class="size">
                            <h2>Taille</h2>
                            <div class="allbox">
                                <input type="hidden" name="color" value=<?= $choosenColor ; ?>/>
                                <input type="hidden" name="idproduct" value=<?= $product->getId() ?>/>
                                <?php foreach ($taille as $value) : ?>
                                    <div class="box">
                                        <input type="radio" name="size" id="<?=$value?>" value=<?= $value ?> <?php if (!in_array($value,$avalaibleSize)) {  echo "disabled";} ?>></input>
                                        <label for="<?= $value ?>"><?= $value ?></label>
                                    </div>
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
                    <?php if (isset($avalaibleSize)) { ?>
                    <div class="form">
                        <input type="submit" value="AJOUTER AU PANIER"/>
                    </div>
                    </form>
                    <?php } ?>
                </div> 
            </div>
        </li>
    </ul>
</div>


<!-- shop/product/productContent -->
