
<h3>Adresses : </h3>
<?php foreach ($locations as $location) { ?>

    <p><?= $location->getAdresse()['number'] . " " . $location->getAdresse()['street'] . ", " . $location->getCodePostal() . " " . $location->getCity() . ", " . $location->getCountry()?></p>
    <a href=<?= base_url("Order/addOrder")."?idlocation=".$location->getId()."&idcart=$idcart" ?>>Choisir cette adresse</a>
<?php } ?>