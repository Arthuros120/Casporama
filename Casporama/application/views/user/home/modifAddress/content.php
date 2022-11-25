<!-- user/home/modifAddress/content -->

<h1>Modification de l'address: <?= $address->getName() ?></h1>

<?php echo form_open('user/home/modifAddress/' . $address->getId()); ?>

<p>Nom de l'addresse: <input type="text" id="name" name="name" value="<?= $address->getName() ?>" required></p>
<p>Numéro: <input type="number" id="number" name="number" value="<?= $address->getAdresse()['number'] ?>" required></p>
<p>Addresse: <input type="text" id="street" name="street" value="<?= $address->getAdresse()['street'] ?>" required></p>

<p>Département:
    <select id="department" name="department">

    </select>
</p>

<p>Ville: <input type="text" id="city" list="cityList" name="city" value="<?= $address->getCity() ?>"></p>

<p>Code Postal <input type="number" id="postalCode" list="postalList" name="postalCode" value="<?= $address->getCodePostal() ?>"></p>

<p>Pays:
    <select id="country" name="country">

    </select>
</p>

<div id="div-map"></div>

<p>Addresse par défault ?:<input type="checkbox" name="default" <?php if ($address->getIsDefault()) {

                                                                    echo "checked";
                                                                } ?>>

</p>

<input type="reset" value="Tout supprimé">
<p><input type="submit" value="Modifier"></p>

<?php echo form_close(); ?>

<?php if (isset($error)) { ?>
    <div class="error">
        <?= $error ?>
    </div>
<?php } ?>


<datalist name="cityList" id="cityList">

</datalist>

<datalist name="postalList" id="postalList">

</datalist>
<!-- user/home/modifAddress/content -->
