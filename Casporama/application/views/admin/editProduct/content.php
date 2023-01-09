<!-- admin/editProduct/content -->

<div class="modify_product">
    <div class="modify_product_header">
        <div class="header_logo">
            <a href=""><img src="<?= base_url() ?>static/image/icon/arrow.svg" alt=""></a>
            <a href=""><img src="<?= base_url() ?>static/image/casporama.png" alt=""></a>
        </div>
        <div class="header_title">
            <h1>Modification de produit</h1>
        </div>
    </div>

    <div class="modify_product_content">
        <div class="main_img_title">
            <h2>Image principale</h2>
        </div>
        <hr>
        <div class="main_img">
            <div class="image">
                <div class="img_size">
                    <img src="<?= $product->getCover() ?>" alt="Image de couverture du produit">
                </div> 
            </div>
            <div class="main_img_input">
            <?php echo form_open_multipart('admin/EditCoverImage/' . $product->getId()); ?>
                <h4>Modification de l'image de couverture</h4>
                <div class="input">
                    <input type="file" name="imageCover" accept="image/*">
                    <input class="add_btn" type="submit" value="Ajouter l'image">
                </div> 
            <?php echo form_close(); ?>
            </div>
        </div>

        <div class="second_images_title">
            <h2>Image secondaires</h2>
        </div>
        <hr>
        <div class="second_img">
            <?php
            if (!empty($images)) {
                foreach ($images as $imageKey => $imageValue) { ?>
                    <div class="image_scnd">
                        <img src="<?= $product->getImagesWithoutCover()[$imageKey] ?>"
                        alt="Image secondaire du produit">
                        <div class="delete">
                            <a href="<?=base_url('admin/deleteImage/'.$product->getId()."/".$imageValue) ?>">
                                Delete image
                            </a>
                        </div>
                    </div>
            <?php } } ?>
        </div>

        <?php echo form_open_multipart('admin/addImage/'. $product->getId()); ?>
        <div class="add_image">
        <?php 
            if ($countImages < 5) { ?>
                <div class="add_image_input">
                <?php for ($i = $countImages + 1; $i <= 5; $i++) { ?>
                    <div class="input">
                        <h4>Ajout d'une image <?= $i ?> </h4>
                        <input type="file" name="image<?= $i ?>" accept="image/*">
                    </div>
                    
                <?php } ?>
                </div>
                <input class="add_btn" type="submit" value="Ajouter les images">
            <?php } ?>
        </div>
        <?php echo form_close(); ?>

        <div class="info_produit_title">
            <h2>Informations du produits</h2>
        </div>
        <hr>
        <?php echo form_open('admin/editProduct/' . $product->getId()) ?>
        <div class="info_produit_content">

            <div class="info_input">
                <h3> Nom du produit </h3>
                <input type="text" name="name" placeholder="Nom du produits"
                value="<?= $product->getName() ?>"
                >
            </div>

            <div class="info_input">
                <h3> Genre du produit </h3>
                <select name="genre" id="genre">
                    <option value="Homme"
                    <?php if ($product->getGenre() == "Homme") { echo "selected"; } ?>
                    > Homme </option>
                    <option value="Femme"
                    <?php if ($product->getGenre() == "Femme") { echo "selected"; } ?>
                    > Femme </option>
                    <option value="Mixte"
                    <?php if ($product->getGenre() == "Mixte") { echo "selected"; } ?>
                    > Mixte </option>
                </select>
            </div>

            <div class="info_input">
                <h3> Sport du produit </h3>
                <select name="sport" id="sport">
                    <?php foreach ($sports as $sport) { ?>
                        <option value="<?= $sport["id"] ?>"
                        <?php if ($product->getSport() == $sport["id"]) { echo "selected"; } ?>
                        >
                        <?= $sport["name"] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="info_input">
                <h3> Type du produit </h3>
                <select name="type" id="type">
                    <?php foreach ($types as $type) { ?>
                        <option value="<?= $type ?>"
                        <?php if ($product->getType() == $type) { echo "selected"; } ?>
                        >
                        <?= $type ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="info_input">
                <h3> Marque du produit </h3>
                <input type="text" name="brand" list="listBrand" placeholder="Marque du produit"
                value="<?= $product->getBrand() ?>"
                >
            </div>

            <div class="info_input">
                <h3> Prix du produit </h3>
                <input type="number" name="price" step="any" placeholder="Prix du produit"
                value="<?= $product->getPrice() ?>"
                >
            </div>
        </div>
        
        <div class="info_produit_textarea">
            <div class="info_input">
                <h3> Description du produit </h3>
                <textarea
                name="description"
                placeholder="Description du produit"
                ><?= $product->getDescription() ?></textarea>
            </div>
        </div>
        <div class="info_produit_submit">
            <input type="submit" value="Modifier le produit">
            <a href="<?= base_url() ?>Admin/Product" ><p>Annuler</p></a>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if (isset($error)) {

    echo $error;

} ?>
 



    
</div>

<!-- admin/editProduct/content -->
