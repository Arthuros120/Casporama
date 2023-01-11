<!-- admin/user/modifAddress/content -->
<div class="modif_adress_content">

    <div class="modif_adress_form_content">
        <div class="modif_adress_form_title">
            <a href="<?= base_url('admin/user/' . $iduser) ?>">
                <img alt="fleche arrière" src="<?= base_url()?>/static/image/icon/arrow_white.svg">
            </a>
            <h1>Modification de l'adresse: <?= $location->getName() ?></h1>
        </div>

        <?php echo form_open('Admin/modifAddress/' . $location->getId()); ?>

        <input type="hidden" name="idUser" value="<?= $iduser?>">
        
        <div class="modif_adress_form">

            <div class="modif_adress_name">
                <h3>Nom de l'addresse:</h3>
                <input
                class="modif_adress_input"
                type="text"
                id="name"
                name="name"
                value="<?= $location->getName() ?>"
                required>
            </div>

            <div class="modif_adress_num">
                
            </div>

            <div class="modif_adress_adress">
                <div class="modif_adress_num">
                    <h3>Numéro:</h3>
                    <input
                        class="modif_adress_input"alt="fleche arrière"
                        type="number"
                        id="number"
                        name="number"
                        value="<?= $location->getAdresse()['number'] ?>"
                        required
                    >
                </div>
                <div class="modif_adress_adress_name">
                    <h3>Adresse:</h3>
                    <input
                        class="modif_adress_input"
                        type="text"
                        id="street"
                        name="street"
                        value="<?= $location->getAdresse()['street'] ?>"
                        required
                    >
                </div>
                
            </div>

            <div class="modif_adress_dep">
                <h3>Département:</h3>
                <select class="modif_adress_input" id="department" name="department"></select>
            </div>

            <div class="modif_adress_city">
                <h3>Ville:</h3>
                <input
                class="modif_adress_input"
                type="text"
                id="city"
                list="cityList"
                name="city"
                value="<?= $location->getCity() ?>">
            </div>

            <div class="modif_adress_zipcode">
                <h3>Code Postal:</h3>
                <input
                class="modif_adress_input"
                type="number"
                id="postalCode"
                list="postalList"
                name="postalCode"
                value="<?= $location->getCodePostal() ?>">
            </div>

            <div class="modif_adress_country">
                <h3>Pays:</h3>
                <select class="modif_adress_input" id="country" name="country"></select>
            </div>

            <div class="modif_adress_default">
                <h3>Addresse par défault:</h3>
                <input class="modif_adress_check" type="checkbox" name="default"
                    <?php if ($location->getIsDefault()) {
                        echo "checked";
                    } ?>
                >
            </div>

            
            <?php if (isset($error) && $error != "") { ?>
                <div class="modif_adress_error">
                    <img alt="error Icon" src=" <?= base_url() ?>/static/image/icon/error_white.svg">
                    <h3><?= $error ?></h3>
                </div>
            <?php } ?>
            

            <div class="modif_adress_submit">
                <input class="modif_btn" type="submit" value="Modifier">
                <input class="delete_btn" type="reset" onclick="resetEvent();" value="Tout supprimé">
            </div>
        </div>
        
    </div>

    <div class="modif_adress_map">
        <div id="div-map"></div>
    </div>

</div>

<?php echo form_close(); ?>

<datalist name="postalList" id="postalList"></datalist>
<datalist name="cityList" id="cityList"></datalist>

<!-- admin/user/modifAddress/content -->
