   <!-- admin/addProduct/content -->

<div class="addproduct">
    <div class="addproduct_header">
        <div class="addproduct_logo">
            <a href="javascript:history.back()" ><img src="<?= base_url() ?>static/image/icon/arrow.svg"></a>
            <a href="<?= base_url() ?>" ><img src="<?= base_url() ?>static/image/casporama.png"></a>
        </div>
        <div class="addproduct_title">
            <h1> Ajout d'un nouveau produit </h1>
        </div>
    </div>
    <div class="addproduct_content">
    <?php echo form_open_multipart('admin/addProduct'); ?>
        <div class="addproduct_info">
            <div class="addproduct_content_title">
                <h2> Informations du produit </h2>
            </div>
            <hr>
            <div class="addproduct_info_input">

                <div class="info_input">
                    <h3> Nom du produit </h3>
                    <input type="text" name="name" placeholder="Nom du produits"
                    <?php if (isset($post['name'])) { ?>
                        value="<?= $post['name'] ?>"
                    <?php } ?>>
                </div>

                <div class="info_input">
                    <h3> Genre du produit </h3>
                    <select name="genre" id="genre">
                        <option value="default" <?php if (!isset($post['genre'])) { echo "selected"; }?>></option>
                        <option value="Homme"
                        <?php if (isset($post['genre']) && $post['genre'] == "Homme") { echo "selected"; }?>
                        > Homme </option>
                        <option value="Femme"
                        <?php if (isset($post['genre']) && $post['genre'] == "Femme") { echo "selected"; }?>
                        > Femme </option>
                        <option value="Mixte"
                        <?php if (isset($post['genre']) && $post['genre'] == "Mixte") { echo "selected"; }?>
                        > Mixte </option>
                    </select>
                </div>

                <div class="info_input">
                    <h3> Sport du produit </h3>
                    <select name="sport" id="sport">
                        <option value="default" <?php if (!isset($post['sport'])) { echo "selected"; }?>></option>
                        <?php foreach ($sports as $sport) { ?>
                            <option value="<?= $sport["id"] ?>"
                            <?php if (isset($post['sport']) && $post['sport'] == $sport['id']) {echo "selected"; } ?>
                            >
                            <?= $sport["name"] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="info_input">
                    <h3> Type du produit </h3>
                    <select name="type" id="type">
                        <option value="default" <?php if (!isset($post['type'])) { echo "selected"; }?>></option>
                        <?php foreach ($types as $type) { ?>
                            <option value="<?= $type ?>"
                            <?php if (isset($post['type']) && $post['type'] == $type) {echo "selected"; } ?>
                            ><?= $type ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="info_input">
                    <h3> Marque du produit </h3>
                    <input type="text" name="brand" list="listBrand" placeholder="Marque du produit"
                    <?php if (isset($post['brand'])) { ?>
                        value="<?= $post['brand'] ?>"
                    <?php } ?>>
                </div>

                <div class="info_input">
                    <h3> Prix du produit </h3>
                    <input type="number" name="price" step="any" placeholder="Prix du produit"
                    <?php if (isset($post['price'])) { ?>
                        value="<?= $post['price'] ?>"
                    <?php } ?>>
                </div>
            </div>

            <div class="addproduct_info_textarea">
                <div class="info_input">
                    <h3> Description du produit </h3>
                    <textarea name="description" placeholder="Description du produit"><?php if (isset($post['description'])) { ?>
                    <?= $post['description'] ?>
                    <?php } ?></textarea>
                </div>
            </div>
        </div>

        <div class="addproduct_img">
            <div class="addproduct_content_title">
                <h2> Images du produit </h2>
            </div>
            <hr>
            <div class="addproduct_img_desc">
                <p>
                    Il est possible d'ajouter jusqu'a 5 images, elles doivent être au format .jpg, .jpeg, .png ou .gif
                    Les images doivent faire au minimum 100x100px et au maximum 800x800px et elles doivent faire moins de 10Mo
                    Les images doivent avoir un nom de moins de 255 caractères. L'image de couverture n'est pas obligatoire mais conseiller
                <p> 
            </div>
            <div class="addproduct_img_content">
                <div class="img_cover">
                    <h3> Image de couverture du produit </h3>
                    <div class="box">
                        <h4>Image 1</h4>
                        <input type="file" name="imageCover" accept="image/*">
                    </div>
                    
                </div>

                <div class="img_box">
                    <h3> Image annexe des produits </h3>
                    <div class="img">
                    <?php for ($i = 2; $i < 6; $i++) { ?>
                        <div class="box">
                            <h4> Image <?= $i ?> </h4>
                            <input type="file" name="image<?= $i ?>" accept="image/*"> 
                        </div>       
                    <?php } ?>
                    </div>
                </div>
            </div>

            <?php if (isset($errors)) { ?>
            <?php if (count($errors) > 0) { ?>
            <div class="addproduct_error">
                <img src="<?= base_url() ?>static/image/icon/error_white.svg" >
                <div class="error">
                    <?php foreach ($errors as $error) { ?>
                            <p> <?= $error ?>.</p>
                    <?php } ?>
                </div>
            </div>
            <?php } } ?>

            <?php if (isset($errorFile)) { ?>
            <div class="addproduct_error">
                <img src="<?= base_url() ?>static/image/icon/error_white.svg" >
                <div class="error">
                    <?php foreach ($errorFile as $error) { ?>
                        <h5>Images n°<?= $error['id'] ?></h5>
                        <p><?= $error['error'] ?></p>
                    <?php } ?>
                </div>   
            </div>
            <?php } ?>

            <div class="addproduct_submit">
                <input type="submit" value="Ajouter le produit">
                <a href="javascript:history.back()"><p>Annuler</p></a>
            </div>
        </div>
    <?php echo form_close(); ?>
    </div>
</div>
























<datalist id="listBrand" name="listBrand">
    
    <?php foreach ($brands as $brand) { ?>

        <option value="<?= $brand ?>">

    <?php } ?>

</datalist>


<!-- admin/addProduct/content -->
