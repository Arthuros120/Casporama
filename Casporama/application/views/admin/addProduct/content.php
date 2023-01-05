<!-- admin/addProduct/content -->

<h1> Ajout d'un nouveau produit </h1>

<?php echo form_open_multipart('admin/addProduct'); ?>

<h3> Nom du produit </h3>
<input type="text" name="name" placeholder="Nom du produits">

<h3> Description du produit </h3>
<textarea name="description" placeholder="Description du produit"></textarea>

<h3> Genre du produit </h3>
<select name="genre" id="genre">

    <option value="Homme"> Homme </option>
    <option value="Femme"> Femme </option>
    <option value="Mixte"> Mixte </option>

</select>

<h3> Prix du produit </h3>
<input type="number" name="price" placeholder="Prix du produit">

<h3> Sport du produit </h3>
<select name="sport" id="sport">

    <option value="default" default></option>

    <?php foreach ($sports as $sport) { ?>

        <option value="<?= $sport["id"] ?>"> <?= $sport["name"] ?> </option>

    <?php } ?>

</select>

<h3> Type du produit </h3>
<select name="type" id="type">*

    <option value="default" default></option>

    <?php foreach ($types as $type) { ?>

        <option value="<?= $type ?>"> <?= $type ?> </option>

    <?php } ?>

</select>

<h3> Marque du produit </h3>
<input type="text" name="brand" list="listBrand" placeholder="Marque du produit">

<h3> Image du produit </h3>
<input type="file" name="imagesCover" accept="image/">


<input type="submit" value="Ajouter le produit">

<?php echo form_close(); ?>

<datalist id="listBrand" name="listBrand">
    
    <?php foreach ($brands as $brand) { ?>

        <option value="<?= $brand ?>">

    <?php } ?>

</datalist>


<!-- admin/addProduct/content -->
