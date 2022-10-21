<!-- shop/global/productContent -->

<?= $product -> get_brand() ?>
<?= $product -> get_name() ?>
<?= $product -> get_description() ?>
<?= $product -> get_price() ?>
<img src=<?= $product->get_cover() ?>>
<img src=<?= base_url($product -> get_images()[1]) ?>>

<!-- shop/global/productContent -->