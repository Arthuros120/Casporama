<!-- admin/stock/addStock/content -->

<div class="add_stock">

  <div class="add_stock_title">
    <div class="main_title">
      <a href="javascript:history.back()"><img src="<?= base_url() ?>static/image/icon/arrow.svg" alt="arrow"></a>
      <h1> Ajout d'une nouvelle référence </h1>
    </div>
    
    <h3> Produits concerné : <?php echo $product->getName() ?> </h3>
  </div>

  <div class="add_stock_grid">

    <div class="add_stock_cover">
      <img src="<?= $product->getCover() ?>" alt="<?php echo $product->getName() ?>">
    </div>

    <div class="add_stock_desc">
      <h3> <?php echo $product->getName() ?> </h3>
      <p> <?php echo $product->getDescription() ?> </p>
      <p> <?php echo $product->getPrice() ?> € </p>
    </div>

  </div>

  <div class="add_stock_content">

    <div class="content_title">
      <h2> Ajouter une nouvelle référence </h2>
    </div>

    <hr>
    
    <?= form_open('admin/addStock/' . $product->getId()) ?>
    <div class="content_input">

      <div class="input">
        <p>Référence :</p>
        <input type="number" name="reference" placeholder="6973727422377">
      </div>

      <div class="input">
        <p>Color</p>
        <input type="text" name="color" placeholder="Rouge">
      </div>

      <div class="input">
        <p>Size</p>

        <select name="size" id="size">
          <?php foreach($sizes as $size): ?>
            <option value="<?= $size ?>"><?= $size ?></option>
          <?php endforeach; ?>
        </select>

      </div>

      <div class="input">
        <p>Quantité</p>
        <input type="number" name="quantity" placeholder="15">
      </div>

    </div>

    

    <div class="content_submit">
      <input type="submit" value="Ajouter la référence">
    </div>
    <?= form_close() ?>

    <div class="content_error">
    <?php if(isset($error) && $error[0] != ""): ?>
      <div class="error">
        <img src="<?= base_url() ?>static/image/icon/error_white.svg" alt="">
        <div class="error_text">
          <?php foreach ($error as $e) { ?> 
            <p class="error"> <?= $e ?> </p>
          <?php } ?>
        </div>
      </div>
    <?php endif; ?>
    </div>

    


  </div>

</div>












<!-- admin/stock/addStock/content -->
