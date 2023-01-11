<!-- admin/deletes/success/content -->

<div class="deletes_success">
    <h1> Les produits suivant on été détruit :</h1>

    <div class="deletes_success_content">

    <?php foreach ($products as $id) : ?>
        <p> Produit n°<?php echo $id; ?> </p>
    <?php endforeach; ?>

    </div>

    <h2> Ils seront supprimé de la base de donnée dans 1 mois</h2>
</div>

<!-- admin/deletes/success/content -->
