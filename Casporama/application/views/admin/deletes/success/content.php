<!-- admin/deletes/success/content -->

<h1> Les produits suivant on été détruit :</h1>

<?php foreach ($products as $id) : ?>

<p> <?php echo $id; ?> </p>

<?php endforeach; ?>

<h2> Ils seront supprimé de la base de donnée dans 1 mois</h2>

<!-- admin/deletes/success/content -->
