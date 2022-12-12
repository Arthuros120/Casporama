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

<?php echo form_open_multipart('Dao/export'); ?>

<label for="export">Export Your File</label> 
<select name="export-Table" id="table-select">
    <option value="user">User</option>
    <option value="product">Product</option>
    <option value="order">Order</option>
    <option value="location">Location</option>
    <option value="information">Information</option>
    <option value="catalog">Catalog</option>
	<option value="sport">Sport</option>
</select>

<select name="export-Ext" id="table-select">
    <option value="csv">CSV</option>
    <option value="json">JSON</option>
    <option value="xml">XML</option>
    <option value="yaml">YAML</option>
</select>

<input type="submit" value="Download File"/> 
</form>
</body>
</html>

<!-- test/testDAO -->
