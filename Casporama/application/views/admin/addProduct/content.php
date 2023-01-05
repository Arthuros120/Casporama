<!-- admin/addProduct/content -->

<h1> Ajout d'un nouveau produit </h1>

<?php echo form_open_multipart('admin/addProduct'); ?>

<h2> Informations du produit </h2>

<h3> Nom du produit </h3>
<input type="text" name="name" placeholder="Nom du produits">

<h3> Description du produit </h3>
<textarea name="description" placeholder="Description du produit"></textarea>

<h3> Prix du produit </h3>
<input type="number" name="price" step="any" placeholder="Prix du produit">

<h3> Genre du produit </h3>
<select name="genre" id="genre">

    <option value="default" default></option>
    <option value="Homme"> Homme </option>
    <option value="Femme"> Femme </option>
    <option value="Mixte"> Mixte </option>

</select>

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

<h2> Images du produit </h2>

<p> Vous pouvez ajouter jusqu'à 5 images pour votre produit </p>
<p> Les images doivent être au format .jpg, .jpeg, .png ou .gif </p>
<p> Les images doivent faire au minimum 100x100px et au maximum 800x800px </p>
<p> Les images doivent faire moins de 10Mo </p>
<p> Les images doivent avoir un nom de moins de 255 caractères </p>
<p> L'image de couverture n'est pas obligatoire mais rudement conseiller</p>

<h3> Image de couverture du produit </h3>
<input type="file" name="imageCover" accept="image/">

<h3> Image annexe des produits </h3>

<?php for ($i = 1; $i < 5; $i++) { ?>

    <h4> Image <?= $i ?> </h4>
    <input type="file" name="image<?= $i ?>" accept="image/">

<?php } ?>


<input type="submit" value="Ajouter le produit">

<?php echo form_close(); ?>

<datalist id="listBrand" name="listBrand">
    
    <?php foreach ($brands as $brand) { ?>

        <option value="<?= $brand ?>">

    <?php } ?>

</datalist>


<!-- admin/addProduct/content -->
