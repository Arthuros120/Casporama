<!-- admin/error/errorImage/content -->

<div class="error_img">

    <?php if (isset($errors)) {

    if (is_array($errors)) {

        foreach ($errors as $error) { ?>
        
        <div class="img_error">
            <h1> Image <?=$error["id"]?> </h1>
            <p> <?=$error["error"] ?></p>
        </div>

        <?php }

    } else { ?>

        <div class="cover_error">
            <h2> <?=$errors?> </h2>
            <img src="<?= base_url() ?>static/image/icon/error.svg" alt="">
        </div>

    <?php }
    } ?>

</div>

<div class="redirect">
    <p>Vous allez êtres redirigé dans <span id="redirect">5 secondes</span> vers la gestion des produits</p>
</div>



<!-- admin/error/errorImage/content -->
