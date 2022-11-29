<!-- shop/product/head -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/global/header_global.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/button.css">
<link rel="stylesheet" type="text/css" href="<?= base_url("/static/css/" . $sport . "/colors.css") ?>">
<link rel="stylesheet" href="<?php echo base_url()?>static/css/global/view_global.css">
<link rel="stylesheet" href="<?php echo base_url()?>static/css/global/product_content.css">

<script type="text/javascript">
    function changeImage(i) {
        document.getElementById("photo").src = i
    }            
</script>



<title><?= $product->getBrand() . " - " . $product->getName() ?></title>

<!-- shop/product/head -->
