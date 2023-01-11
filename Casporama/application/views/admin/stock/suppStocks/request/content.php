<!-- admin/stock/suppStocks/request/content -->

<div class="stock_delete">

  <div class="stock_delte_title">
    <div class="main_title">
      <a href="javascript:history.back()"></a>
      <h1> Supprimer les référence </h1>
    </div>
    <h3> Vous vous apprêtez à supprimer les références du produit suivant : <?php echo $product->getName() ?> </h3>
  </div>

  <div class="stock_delete_grid">
    <div class="cover">
      <img src="<?= $product->getCover() ?>" alt="<?php echo $product->getName() ?>">
    </div>
    <div class="desc">
      <h3> <?php echo $product->getName() ?> </h3>
      <p> <?= $product->getDescription() ?> </p>
      <p> <?= $product->getPrice() ?> € </p>
    </div>
  </div>

  <div class="stock_delete_content">
    <div class="content_title">
      <h3>Les référence suivantes seront supprimées</h3>
    </div>
    <hr>

    <div class="content_desc table">
      <table>

        <tr>
            <th>Taille</th>
            <th> Référence </th>
            <th> Quantité </th>
        </tr>

        <?php foreach($catalogs as $catalog): ?>
            <tr>
                    <td><?= $catalog->getSize() ?></td>
                    <td><?= $catalog->getReference() ?></td>
                    <td><?= $catalog->getQuantity() ?></td>
            </tr>
        <?php endforeach ?>

      </table>
    </div>

    <div class="content_confirm">
    <h3> Êtes-vous sûr de vouloir supprimer ces références ?  </h3>
    <?php echo form_open('Admin/suppStocksComf/'); ?>
    <input type="hidden" name="catalogs" value="<?= $listCatalogs ?>">
    <input type="hidden" name="product" value="<?= $product->getId() ?>">
    <div class="box_switch">
      <p> Non </p>
      <label class="switch">
        <input id="switch" type="checkbox" name="switch">
        <span class="slider round"></span>
      </label>
      <p> Oui </p>
      </div>
    </div>

    <div class="content_submit">
      <input type="submit" id="submitButton" value="Ne pas supprimer les référence">
    </div>

    <?php echo form_close(); ?>

  </div>

</div>
<!-- admin/stock/suppStocks/request/content -->
