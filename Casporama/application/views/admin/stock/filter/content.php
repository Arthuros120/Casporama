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

<select name="step" id="step">

    <option value="1">1</option>

    <option value="2">2</option>

    <option value="5">5</option>

    <option value="10">10</option>

    <option value="20" selected>20</option>

    <option value="50">50</option>

    <option value="100">100</option>

</select>

<input id='submit' type="submit" value="Filtrer">

<!-- admin/stock/filter/content --->
