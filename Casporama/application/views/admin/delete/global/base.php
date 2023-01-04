<!-- admin/delete/global/base -->

<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url() ?>static/css/fonts.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>static/css/global/color.css">
        <link rel="icon" type="image/svg" sizes="16x16" href="<?= base_url("static/image/icon/favicon.svg") ?>">

        <?= $loadView['head'] ?>

    </head>

    <body>

        <?= $loadView['header'] ?>

        <?= $loadView['content'] ?>

        <?= $loadView['script'] ?>
    
    </body>
</html>

<!-- templates/base -->
