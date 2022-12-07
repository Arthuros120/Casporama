<!-- user/home/info/content -->

<div class="user_info_content">
    <div class="user_info_logo">
        <a href="javascript:history.back()">
            <img alt="fleche arrière" src="<?= base_url()?>/static/image/icon/arrow_white.svg">
        </a>
        <a href="<?= base_url() ?>">
            <img src="<?= base_url() . "static/image/icon/casporama.svg" ?>" alt="Casporama" />
        </a>
    </div>
    <div class="user_info_info">
        <div class="user_info_login">

            <div class="user_info_title">
                <h1>Information de connexion</h1>
                <hr>
            </div>

            <div class="user_info_login_content">
                <div class="user_info_login">
                    <h2 class="value">Login : <span class="text_content"><?= $user->getLogin() ?></span></h2>
                </div>

                <div class="user_info_pass">
                    <h2>Mots de passe : <span class="text_content">●●●●●●●●●</span></h2>
                    <a href="<?= base_url('User/home/modifPass'); ?>"><img src="<?=base_url() . "static/image/icon/modify.svg"?>"></a>
                </div>

                <div class="user_info_statut">
                    <?php $status = $user->getStatus(); ?>
                    <?php if ($status == "Administrateur") { ?>
                        <img src="<?= base_url() . "static/image/icon/castor/AdminCastor.svg" ?>" alt="Administrateur" />
                    <?php } elseif ($status == "Caspor") { ?>
                        <img src="<?= base_url() . "static/image/icon/castor/Caspor.svg" ?>" alt="Caspor" />
                    <?php } elseif ($status == "Client") { ?>
                        <img src="<?=base_url() . "static/image/icon/castor/castor.png" ?>" alt="Castor" />
                    <?php } else { ?>
                        <p>Votre compte est en attente de validation</p>
                    <?php } ?>
                </div>
            </div>
        </div>


        <div class="user_info_name">

            <div class="user_info_title">
                <h1>Information de l'utilisateur</h1>
                <hr>
            </div>

            <div class="user_info_name_content">

                <div class="user_info_name_name">
                    <h2 class="value">Nom : <span class="text_content"><?= $user->getCoordonnees()->getNom() ?></span></h2>
                    <a href="<?= base_url('User/home/modifLastName'); ?>"><img src="<?=base_url() . "static/image/icon/modify.svg"?>"></a>
                </div>
                <div class="user_info_name_firstName">
                    <h2 class="value">Prénom : <span class="text_content"><?= $user->getCoordonnees()->getPrenom() ?></span></h2>
                    <a href="<?= base_url('User/home/modifFirstName'); ?>"><img src="<?=base_url() . "static/image/icon/modify.svg"?>"></a>
                </div>
                <div class="user_info_name_email">
                    <h2 class="value">Email : <span class="text_content"><?= $user->getCoordonnees()->getEmail() ?></span></h2>
                    <a href="<?= base_url('User/home/modifEmail'); ?>"><img src="<?=base_url() . "static/image/icon/modify.svg"?>"></a>
                </div>

                <div class="user_info_name_telMobile">
                    <h2 class="value">Téléphone mobile : <span class="text_content"><?= $user->getCoordonnees()->getTelephone() ?></span></h2>
                    <a href="<?= base_url('User/home/modifMobile'); ?>"><img src="<?=base_url() . "static/image/icon/modify.svg"?>"></a>
                </div>
                
                <div class="user_info_name_telFixe">
                    <h2 class="value">Téléphone fixe : <span class="text_content">
                        <?= $user->getCoordonnees()->getFixe() ?>
                </span></h2>
                    <a href="<?= base_url('User/home/modifFixe'); ?>">
                    <img src="<?=base_url() . "static/image/icon/modify.svg"?>" alt='icon modify'>
                </span></a>
                </div>

            </div>
        </div>

        <div class="user_info_address">

            <div class="user_info_title">
                <h1>Vos addresse <?php echo $nbrAddr ?></h1>
                <hr>
            </div>

            <div class="cards_address">
                <?php if (isset($listLoc)) {
                    foreach ($listLoc as $localisation) { ?>
                    <div class="card_all">
                        <div class="user_info_address_title">
                            <h2><?= $localisation->getName()?></h2>
                            <?php if ($localisation->getIsDefault()) { ?>
                                <h2>(Par défaut)</h2>
                            <?php } ?>
                        </div>
                        <div class="card_address">
                            <div class="user_info_address_addr">
                                <h2>Adresse : <span class="text_content">
                                    <?=$localisation->getAdresse()['number'] . " " . $localisation->getAdresse()['street']?>
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
                                <img src="<?=base_url() . "static/image/icon/modify.svg"?>" alt="image icon modify"></a>
                                <a href="<?= base_url('User/home/supprAddress/') . $localisation->getId(); ?>">
                                <img
                                src="<?=base_url() . "static/image/icon/delete.svg"?>"
                                alt="image icon delete" ></a>
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
                        <a
                        href="<?= base_url('User/home/addAddress/')?>" >
                        <img src="<?= base_url() . "static/image/icon/add.svg" ?>"
                        alt="Add" ></a>
                    </div>
                <?php } ?>

            </div>
            <div class="user_info_delete">
                <a href="<?= base_url("User/home/supprUser") ?>">Supprimer l'utilisateur</a>
            </div> 
        </div>
    </div>
</div>
<?php

/* <!-- user/home/info/content --> */
