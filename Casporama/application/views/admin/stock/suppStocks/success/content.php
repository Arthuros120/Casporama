<!-- admin/deletes/success/content -->

<div class="deletes_succes">
    <div class="deletes_success_title">
        <h1> Les référence suivante on été détruite : </h1>
    </div>
    <div class="deletes_success_content">
    <?php foreach ($listCatalogs as $id) : ?>
        <p> <?php echo $id; ?> </p>
    <?php endforeach; ?>
    </div>
    <div class="deletes_success_footer">
        <h2> Elles seront supprimée de la base de donnée dans 1 mois</h2>
    </div>
</div>







<!-- admin/deletes/success/content -->
