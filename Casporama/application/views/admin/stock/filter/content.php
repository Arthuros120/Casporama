<!-- admin/stock/filter/content --->

<h1> Selectionnez les filtres pour voir apparaitre le stock</h1>

<select name="sport" id="sport">

    <?php foreach ($sports as $sport) {?>

        <option value="<?= $sport["id"] ?>"><?= $sport["name"] ?></option>

    <?php } ?>

</select>

<select name="type" id="type">

    <?php foreach ($types as $type) {?>

        <option value="<?= $type ?>"><?= $type ?></option>

    <?php } ?>

</select>

<input type="submit" value="Filtrer">

<!-- admin/stock/filter/content --->
