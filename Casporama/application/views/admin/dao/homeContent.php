<!-- dao/homeContent -->

<div class="dao_content">
    <div class="menu">
        <ul>
            <li><a href="<?php echo site_url('Admin/Product')  ?>">Gerer les Produit</a></li>
            <li><a href="<?php echo site_url('Admin/User') ?>">Gerer les utilisateurs</a></li>
            <li><a href="<?php echo site_url('Admin/Order') ?>">Gerer les commandes</a></li>
            <li><a href="<?php echo site_url('Admin/Stock') ?>">Gerer le stock</a></li>
            <li><a href="<?php echo site_url('Dao') ?>">Import / Export les données</a></li>
        </ul>
    </div>

    <div class="dao_import">
        <div class="dao_import_title">
            <h2>Importer des données</h2>
        </div>
        <div class="dao_import_form">
            <?php echo form_open_multipart('Dao/import'); ?>
            <div class="dao_import_file">
                <h3>1 - Choissisez un fichier</h3>
                <label for="file">Upload</label>
                <input class="input" accept=".json,.csv,.xml,.yaml" name="userfile" type="file" id="file" />
            </div>
            <div class="dao_import_table">
                <h3>2 - Choissisez la table</h3>
                <select class="input" name="import" id="table-select">
                    <option value="user">User</option>
                    <option value="product">Product</option>
                    <option value="order">Order</option>
                    <option value="location">Location</option>
                    <option value="information">Information</option>
                    <option value="catalog">Catalog</option>
                </select>
            </div>
            <div class="dao_import_submit">
                <h3>3 - Envoyer le fichier</h3>
                <input class="input" type="submit" value="Submit"/>
            </div>
            </form>
        </div>
    </div>

    <div class="dao_export">
        <div class="dao_export_title">
            <h2>Exporter des données</h2>
        </div>
        <div class="dao_export_form">
        <?php echo form_open_multipart('Dao/select'); ?>

            <div class="dao_export_table">
                <h3>1 - Choissisez la table</h3>
                <select class="input" name="export-Table" id="table-select">
                    <option value="user" <?php if (isset($table) && $table == "user") { echo "selected";} ?>>User</option>
                    <option value="product" <?php if (isset($table) && $table == "product") { echo "selected";} ?>>Product</option>
                    <option value="`order`" <?php if (isset($table) && $table == "`order`") { echo "selected";} ?>>Order</option>
                    <option value="location" <?php if (isset($table) && $table == "location") { echo "selected";} ?>>Location</option>
                    <option value="information" <?php if (isset($table) && $table == "information") { echo "selected";} ?>>Information</option>
                    <option value="catalog" <?php if (isset($table) && $table == "catalog") { echo "selected";} ?>>Catalog</option>
                </select>
            </div>
            
            <div class="dao_export_format">
                <h3>2 - Choissisez le format</h3>
                <select class="input" name="export-Ext" id="table-select">
                    <option value="csv" <?php if (isset($ext) && $ext == "csv") { echo "selected";} ?>>CSV</option>
                    <option value="json"<?php if (isset($ext) && $ext == "json") { echo "selected";} ?>>JSON</option>
                    <option value="xml" <?php if (isset($ext) && $ext == "xml") { echo "selected";} ?>> XML</option>
                    <option value="yaml"<?php if (isset($ext) && $ext == "yaml") { echo "selected";} ?>>YAML</option>
                </select>
            </div>

            <div class="dao_export_submit">
                <h3>3 - Confirmer</h3>
                <input class="input" type="submit" value="Confirmer"/>
            </div>
        </form>
        </div>
        <?php if (isset($table) && isset($ext)) { ?>
            <div class="dao_export_next">
                <?php echo form_open_multipart('Dao/export'); ?>
                    <input type="hidden" name="table" value=<?= $table ?>>
                    <input type="hidden" name="ext" value=<?= $ext ?>>
                    <h3><?=$table?>.<?= $ext ?> :</h3>
                    <?php foreach ($colonnes as $value) { ?>
                        <div class="export_collumns">
                            <label for="export-Filter[]"><?= $value ?></label>
                            <input type="checkbox" name="export-Filter[]" value=<?= $value ?>>
                        </div>
                    <?php } ?>
                    <div class="dao_export_next_submit">
                        <input class="export_collumns_input" type="submit" value="Export File"/>
                    </div>
                </form>
            </div>
        <?php }
        
        if (isset($msg)) {

            if (is_array($msg)) {
                foreach ($msg as $error) {?>

                    <div class="dao_error">

                        <div class="dao_error_content">
                            <img src="<?php base_url() ?>../static/image/icon/error_white.svg" alt="error icon">
                            <h3><?= $error ?></h3>
                        </div>
                    </div>

        <?php   }

            } else { ?>

                <div class="dao_error">
                    <h3 style='color:crimson'><?= $msg ?></h3>
                </div>

        <?php   }
        } ?>

        <?php if (isset($msgSucces)) { ?>

                <div class="dao_error_content">
                    <img src="<?php base_url() ?>../static/image/icon/error_white.svg" alt="error icon">
                    <h3><?= $msgSucces ?></h3>
                </div>

        <?php } ?>

<!-- dao/homeContent -->
