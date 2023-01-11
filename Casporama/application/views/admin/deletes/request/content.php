<!-- admin/deletes/request/content -->

<div class="product_deletes">
    <div class="product_deletes_title">
        <h1> Supprimer les produits </h1>
        <h2> Vous vous apprêtez à supprimer les produits suivant : </h2>
    </div>

    <div class="product_deletes_table">
        <table>

        <tr>
            <th>Id</th>
            <th> Sport </th>
            <th> Categories </th>
            <th>Marque</th>
            <th>Nom</th>
            <th>Prix(€)</th>
            <th>Describtion</th>
        </tr>

        <?php foreach($products as $product): ?>
            <tr>
                    <td><?= $product->getId() ?></td>
                    <td><?php echo $product->getSportName() ?></td>
                    <td><?php echo $product->getType() ?></td>
                    <td><?php echo $product->getBrand() ?></td>
                    <td>
                        <a href="<?= site_url('shop/product/' . $product->getId()) ?>">
                            <?php echo $product->getName() ?>
                        </a>
                    </td>
                    <td><?php echo $product->getPrice() ?></td>
                    <td><?php echo $product->getTinyDescription(50) ?>
            </tr>
        <?php endforeach ?>

        </table>
    </div>

    <div class="product_deletes_submit">
        <p> Êtes-vous sûr de vouloir supprimer ces produits ? </p>
        <?php echo form_open('Admin/deleteProductsComf/'); ?>

        <input type="hidden" name="products" value="<?= $listProducts ?>">

        <div class="input_switch">
            <p> Non </p>
            <label class="switch">
            <input id="switch" type="checkbox" name="switch">
            <span class="slider round"></span>
            </label>
            <p> Oui </p>
        </div>

        <div class="input_submit">
            <input type="submit" id="submitButton" value="Ne pas supprimer les produits">
        </div>

        <?php echo form_close(); ?>
    </div>
</div>







<!-- admin/deletes/request/content -->
