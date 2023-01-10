<!-- admin/stock/view/script --->

<?php if (isset($dataMap)) { ?>

<script
src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
crossorigin=""></script>

<script type="text/javascript" src="<?= base_url('static/js/global/map.js') ?>"></script>

<script type="text/javascript">

    window.onload = function() {

        <?php foreach ($dataMap as $key => $value) {
            if ($value != null) { ?>

                initMapWithOneMarker(<?= $value['lat']; ?>, <?= $value['lng']; ?>, 'map<?= $key ?>');

        <?php

            }
        }

        ?>

    };
</script>

<?php } ?>

<!-- admin/stock/view/script --->
