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
    } ?>

</div>

<!-- admin/editProduct/content -->
