<!-- shop/global/homeTemplate -->

<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url() ?>static/css/fonts.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>static/css/global/colors.css">

        <?= $loadView['head'] ?>

        <?= $loadView['headSport'] ?>

    </head>

    <body>

        <?= $loadView['header'] ?>

        <?= $loadView['content'] ?>

        <?= $loadView['footer'] ?>
    
    </body>
</html>

<!-- shop/global/homeTemplate -->
