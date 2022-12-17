<!-- test/testDAO -->

<?php echo form_open_multipart('Dao/import'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>gg</title>
</head>
<body>

<p>test tah les fous</p>
<label for="file">Upload Your File</label> 
<input accept=".json,.csv,.xml,.yaml" name="userfile" type="file" /> 

<select name="import" id="table-select">
    <option value="user">User</option>
    <option value="product">Product</option>
    <option value="order">Order</option>
    <option value="location">Location</option>
    <option value="information">Information</option>
    <option value="catalog">Catalog</option>
</select>

<br>
<input type="submit" value="Upload File"/> 
</form>

<?php echo form_open_multipart('Dao/select'); ?>

<label for="export">Export Your File</label> 
<select name="export-Table" id="table-select">
    <option value="user" <?php if (isset($table) && $table == "user") { echo "selected";} ?>>User</option>
    <option value="product" <?php if (isset($table) && $table == "product") { echo "selected";} ?>>Product</option>
    <option value="`order`" <?php if (isset($table) && $table == "`order`") { echo "selected";} ?>>Order</option>
    <option value="location" <?php if (isset($table) && $table == "location") { echo "selected";} ?>>Location</option>
    <option value="information" <?php if (isset($table) && $table == "information") { echo "selected";} ?>>Information</option>
    <option value="catalog" <?php if (isset($table) && $table == "catalog") { echo "selected";} ?>>Catalog</option>
</select>

<select name="export-Ext" id="table-select">
    <option value="csv" <?php if (isset($ext) && $ext == "csv") { echo "selected";} ?>>CSV</option>
    <option value="json"<?php if (isset($ext) && $ext == "json") { echo "selected";} ?>>JSON</option>
    <option value="xml" <?php if (isset($ext) && $ext == "xml") { echo "selected";} ?>> XML</option>
    <option value="yaml"<?php if (isset($ext) && $ext == "yaml") { echo "selected";} ?>>YAML</option>
</select>

<input type="submit" value="Select Table"/> 
</form>

<?php if (isset($msg)) { ?>
    <p><?= $msg ?></p>
<?php } ?>

<?php if (isset($table) && isset($ext)) { ?>
    <?php echo form_open_multipart('Dao/export'); ?>
    <input type="hidden" name="table" value=<?= $table ?>>
    <input type="hidden" name="ext" value=<?= $ext ?>>
    <?php foreach ($colonnes as $value) { ?>
        <input type="checkbox" name="export-Filter[]" value=<?= $value ?>>
        <label for="export-Filter[]"><?= $value ?></label>
    <?php } ?>
    <br>
    <input type="submit" value="Export File"/> 
    </form>
<?php } ?>

</body>
</html>

<!-- test/testDAO -->
