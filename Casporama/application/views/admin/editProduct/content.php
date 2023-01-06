<!-- admin/editProduct/content -->

<div class="images">

    <h2>Images</h2>

    <h3>Image principale</h3>

    <?php if ($imageCover != null) { ?>

        <div class="image">

            <img src="<?= $product->getCover() ?>" alt="Image de couverture du produit">

            <div class="delete">

                <a href="<?= base_url('admin/deleteImage/' . $product->getId()  . "/" . $imageCover) ?>">

                    Delete image

                </a>

            </div>

        </div>

    <?php } ?>

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

    form_open_multipart('admin/addImage/'.$product->getId());
    
    if ($countImages < 5) {

        for ($i = $countImages + 1; $i <= 5; $i++) { ?>

            <h4>Ajout d'une image <?= $i ?> </h4>
            <input type="file" name="image<?= $i ?>" accept="image/*">

        <?php }
    } ?>

    <input type="submit" value="Ajouter les images">

    <?php echo form_close(); ?>

</div>

<!-- admin/editProduct/content -->
