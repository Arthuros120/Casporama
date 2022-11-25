<!-- user/home/info/content -->

<div class="user_info_content">
    <div class="user_info_logo">
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
                    <h2 class="value">Login : <?= $user->getLogin() ?></h2>
                </div>

                <div class="user_info_pass">
                    <h2>Mots de passe : ●●●●●●●●●</h2>
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
                    <h2 class="value">Nom : <?= $user->getCoordonnees()->getNom() ?></h2>
                    <a href="<?= base_url('User/home/modifLastName'); ?>"><img src="<?=base_url() . "static/image/icon/modify.svg"?>"></a>
                </div>
                <div class="user_info_name_firstName">
                    <h2 class="value">Prénom : <?= $user->getCoordonnees()->getPrenom() ?></h2>
                    <a href="<?= base_url('User/home/modifFirstName'); ?>"><img src="<?=base_url() . "static/image/icon/modify.svg"?>"></a>
                </div>
                <div class="user_info_name_email">
                    <h2 class="value">Email : <?= $user->getCoordonnees()->getEmail() ?></h2>
                    <a href="<?= base_url('User/home/modifEmail'); ?>"><img src="<?=base_url() . "static/image/icon/modify.svg"?>"></a>
                </div>  

                <div class="user_info_name_telMobile">
                    <h2 class="value">Téléphone mobile : <?= $user->getCoordonnees()->getTelephone() ?></h2>
                    <a href="<?= base_url('User/home/modifMobile'); ?>"><img src="<?=base_url() . "static/image/icon/modify.svg"?>"></a>
                </div>    
                
                <div class="user_info_name_telFixe">
                    <h2 class="value">Téléphone fixe : <?= $user->getCoordonnees()->getFixe() ?></h2>
                    <a href="<?= base_url('User/home/modifFixe'); ?>"><img src="<?=base_url() . "static/image/icon/modify.svg"?>"></a>
                </div>

            </div>           
        </div>

        <div class="user_info_address">

        <h1>Vos address</h1>

            <div class="cards">

                <?php

                if (isset($listLoc)) {

                    foreach ($listLoc as $localisation) { ?>

                        <div class="card">

                            <p>

                                <span class="label">Adresse :</span>

                                <span class="value"><?=

                                    $localisation->getAdresse()['number'] . " " . $localisation->getAdresse()['street']

                                ?></span>

                                <br>

                                <span class="label">Code postal :</span>

                                <span class="value"><?= $localisation->getCodePostal() ?></span>

                                <br>

                                <span class="label">Ville :</span>

                                <span class="value"><?= $localisation->getCity() ?></span>

                                <br>

                                <span class="label">Département :</span>

                                <span class="value"><?= $localisation->getDepartment() ?></span>

                                <br>

                                <span class="label">Pays :</span>

                                <span class="value"><?= $localisation->getCountry() ?></span>

                                <br>

                                <a href="<?= base_url('User/home/modifAddress/') . $localisation->getId(); ?>">Modifier</a>

                                <a href="<?= base_url('User/home/supprAddress/') . $localisation->getId(); ?>">Supprimer</a>

                            </p>

                            <div class="card-map">

                                <?php

                                if ($localisation->getLatitude() != null && $localisation->getLongitude() != null) { ?>

                                    <div id="map<?= $localisation->getId() ?>" class="map"></div>

                                <?php } else { ?>

                                    <p> Aucune localisation n'a été trouvé pour cette adresse </p>

                                <?php } ?>

                            </div>

                        </div>

                <?php }
                } else {

                    echo ' <div class="card"><p>Vous n\'avez pas d\'adresse enregistré<p></div>';
                }

                ?>

            </div>

            </div>

        </div>
    </div>
</div>




<?php

/*


    

</p>

<!-- Todo: Faire le logo du castor pour le status -->




*/

/* <!-- user/home/info/content --> */
