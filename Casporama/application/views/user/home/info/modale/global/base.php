<!-- user/home/modale/global/base -->

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

    <?= $loadView['modaleHead'] ?>

</head>

<body>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->     
        <div class="out_modal">
            <a class="out_modal" href="<?= base_url() . "User/home/info" ?>"></a>
        </div>
   
        <div class="modal-content">
            
            
            <div class="modal-body" id="modal-body">

                <?= $loadView['modaleContent'] ?>

            </div>
        </div>
    </div>

    
        <?= $loadView['content'] ?>

        <?= $loadView['script'] ?>

        <?= $loadView['modaleScript'] ?>

</body>

</html>

<!-- user/home/modale/global/base -->
