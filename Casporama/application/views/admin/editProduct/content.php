<!-- admin/editProduct/content -->

<?php if (isset($error)) {

    echo $error;

} ?>

<div class="images">

    <h2>Images</h2>

    <h3>Image principale</h3>

    <div class="image">

        <img src="<?= $product->getCover() ?>" alt="Image de couverture du produit">

    </div>

    <?php echo form_open_multipart('admin/EditCoverImage/' . $product->getId()); ?>

    <h4>Modification de l'image de couverture</h4>

    <input type="file" name="imageCover" accept="image/*">

    <input type="submit" value="Ajouter l'image">

    <?php echo form_close(); ?>

    <h3>Images secondaires</h3>

<?php

    if (!empty($images)) {

        foreach ($images as $imageKey => $imageValue) { ?>

            <div class="image">

                <img src="<?= $product->getImagesWithoutCover()[$imageKey] ?>"
                alt="Image secondaire du produit">

                <div class="delete">

                    <a href="<?=base_url('admin/deleteImage/'.$product->getId()."/".$imageValue) ?>">

                        Delete image

                    </a>

                </div>

        <?php }
    }

    echo form_open_multipart('admin/addImage/'. $product->getId());
    
    if ($countImages < 5) {

        for ($i = $countImages + 1; $i <= 5; $i++) { ?>

            <h4>Ajout d'une image <?= $i ?> </h4>
            <input type="file" name="image<?= $i ?>" accept="image/*">

        <?php } ?>

            <input type="submit" value="Ajouter les images">

    <?php } ?>

    

    <?php echo form_close(); ?>

    <div>

        <?php echo form_open('admin/editProduct/' . $product->getId()) ?>

        <div class="editPoduct_info">
            <div class="editPoduct_content_title">
                <h2> Informations du produit </h2>
            </div>
            <div class="editPoduct_info_input">

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

            <div class="editPoduct_info_textarea">
                <div class="info_input">
                    <h3> Description du produit </h3>
                    <textarea
                    name="description"
                    placeholder="Description du produit"
                    ><?= $product->getDescription() ?></textarea>
                </div>
            </div>
        </div>

        <div class="editPoduct_submit">
                <input type="submit" value="Modifier le produit">
                <a href="<?= base_url() ?>Admin/Product" ><p>Annuler</p></a>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<!-- admin/editProduct/content -->
