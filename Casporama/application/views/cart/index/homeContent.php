<!-- user/cart -->


<div class="cart_content">
    <div class="cart_header">
        <a href="<?php base_url() ?>../" ><img src="<?php base_url() ?>../static/image/casporama.png" ></a>
    </div>

    <div class="cart_grid">
        <div class="cart_left">
            <div class="cart_left_title">
                <h1>Panier</h1>
            </div>
            <hr>
            <?php echo form_open('Cart/modifyQuantity'); ?>

                <div class="product">

                    <div>Article</div>
                    <div>Quantité</div>
                    <div>Prix</div>
                    <div>Sous-Total</div>

                    <?php if ($carts != null) {
                        foreach ($carts as $cart) {
                        if ($cart[0]->getIdcart() == 0) { 
                        foreach($cart as $product ) {
                        ?>
                        <div class="product_content">
                            <div class="product_img">
                                <img src=<?= $product->getProduct()->getCover() ?> alt="product_image">
                            </div>  
                            <div class="product_desc">
                                <p><?= $product->getProduct()->getName() ?></p>
                                <p><?= $product->getProduct()->getBrand() ?></p>
                                <p>Taille : <?= $product->getVariant()->getSize() ?></p>
                            </div> 
                        </div>
                        <div class="product_quantity">
                            <?php if ($product->getIdcart() != 0) {echo $product->getQuantity();} else {
                            $quantity = array_combine(range(1,$product->getVariant()->getQuantity()),range(1,$product->getVariant()->getQuantity()));
                            echo form_dropdown($product->getVariant()->getId(),$quantity,$product->getQuantity()); ?>
                            <a href="/Cart/deleteProduct?idproduit=<?= $product->getProduct()->getId()?>&idvariant=<?= $product->getVariant()->getId()?>">Supprimer</a>
                            <input type="submit" value="Modifier"/> 
                            <?php } ?> 

                        </div>
                        <div class="product_price">
                            <p><?= $product->getProduct()->getPrice() ?> €</p>
                        </div>
                        <div class="product_total">
                            <p><?= $product->getProduct()->getPrice()*$product->getQuantity() ?> €</p>
                        </div>
                    <?php } } } }?>
                </div>
            </form>

            <div class="cart_left_title">
                <h1>Panier Enregistrés</h1>
            </div>
            
            <hr>

            <?php echo form_open('Cart/modifyQuantity'); ?>

                <div class="product">

                    <div>Article</div>
                    <div>Quantité</div>
                    <div>Prix</div>
                    <div>Sous-Total</div>

                    <?php if ($carts != null) {
                        foreach ($carts as $cart) {
                        if ($cart[0]->getIdcart() != 0) { 
                        foreach($cart as $product ) {
                        ?>
                        <div class="product_content">
                            <div class="product_img">
                                <img src=<?= $product->getProduct()->getCover() ?> alt="product_image">
                            </div>  
                            <div class="product_desc">
                                <p><?= $product->getProduct()->getName() ?></p>
                                <p><?= $product->getProduct()->getBrand() ?></p>
                                <p>Taille : <?= $product->getVariant()->getSize() ?></p>
                            </div> 
                        </div>
                        <div class="product_quantity">
                            <?php if ($product->getIdcart() != 0) {echo $product->getQuantity();} else {
                            $quantity = array_combine(range(1,$product->getVariant()->getQuantity()),range(1,$product->getVariant()->getQuantity()));
                            echo form_dropdown($product->getVariant()->getId(),$quantity,$product->getQuantity()); ?>
                            <a href="/Cart/deleteProduct?idproduit=<?= $product->getProduct()->getId()?>&idvariant=<?= $product->getVariant()->getId()?>">Supprimer</a>
                            <input type="submit" value="Modifier"/> 
                            <?php } ?> 

                        </div>
                        <div class="product_price">
                            <p><?= $product->getProduct()->getPrice() ?> €</p>
                        </div>
                        <div class="product_total">
                            <p><?= $product->getProduct()->getPrice()*$product->getQuantity() ?> €</p>
                        </div>
                    <?php } } } }?>
                </div>
            </form>
            </div>

        <div class="cart_right">
            <div class="cart_recap">
                <div class="cart_recap_title">
                    <h3>Récapitulatif</h3>
                </div>
                <hr>
                <div class="cart_recap_desc">
                    <p>Sous-total : <?= $total[$carts[0][0]->getIdcart()] ?></p>
                </div>
                <div class="cart_recap_total">

                </div>
            </div>
        </div>

    </div>
</div>

