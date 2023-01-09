<div class="user_info_address">

    <div class="user_info_title">
        <h1>Choisissez une adresse</h1>
        <hr>
    </div>

    <div class="cards_address">
        <?php if (isset($listLoc)) {
            foreach ($listLoc as $localisation) { ?>
                <div class="card_all">
                    <div class="user_info_address_title">
                        <h2><?= $localisation->getName() ?></h2>
                        <?php if ($localisation->getIsDefault()) { ?>
                            <h2>(Par défaut)</h2>
                        <?php } ?>
                    </div>
                    <div class="card_address">
                        <div class="user_info_address_addr">
                            <h2>Adresse : <span class="text_content">
                                    <?= $localisation->getAdresse()['number'] . " " . $localisation->getAdresse()['street'] ?>
                                </span></h2>
                        </div>

                        <div class="user_info_address_loc">
                            <h2>Code postal : <span class="text_content">
                                    <?= $localisation->getCodePostal() ?>
                                </span></h2>
                        </div>

                        <div class="user_info_address_city">
                            <h2>Ville : <span class="text_content"><?= $localisation->getCity() ?></span></h2>
                        </div>

                        <div class="user_info_address_dep">
                            <h2>Département : <span class="text_content">
                                    <?= $localisation->getDepartment() ?>
                                </span></h2>
                        </div>

                        <div class="user_info_address_country">
                            <h2>Pays : <span class="text_content"><?= $localisation->getCountry() ?></span></h2>
                        </div>

                        <div class="user_info_address_modify">
                            <a href="<?= base_url('User/home/modifAddress/') . $localisation->getId(); ?>">
                                <img src="<?= base_url() . "static/image/icon/modify.svg" ?>" alt="image icon modify"></a>
                                <a onclick="disabled(this)" id='link' href=<?= base_url("Order/addOrder") . "?idlocation=" . $localisation->getId() . "&idcart=$idcart" ?>>Choisir cette adresse</a>
                        </div>

                    </div>
                    <div class="map_all">
                        <div class="card-map">
                            <?php
                            if ($localisation->getLatitude() != null && $localisation->getLongitude() != null) { ?>
                                <div id="map<?= $localisation->getId() ?>" class="map"></div>
                            <?php } else { ?>
                                <div class="map_error">
                                    <h2>Aucune localisation n'a été trouvé pour cette adresse</h2>
                                    <img src="<?= base_url() . "static/image/icon/error.svg" ?>" alt="error">
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>

            <?php }
        } else {
            echo ' <div class="card"><p>Vous n\'avez pas d\'adresse enregistré<p></div>';
        }

        if (!$addAddIsPos) { ?>
            <div class="card_add_address">
                <a href="<?= base_url('User/home/addAddress/') ?>">
                    <img src="<?= base_url() . "static/image/icon/add.svg" ?>" alt="Add"></a>
            </div>
        <?php } ?>

    </div>
</div>  