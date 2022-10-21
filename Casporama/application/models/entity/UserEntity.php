<?php

require_once APPPATH . 'models/entity/CoordonneesEntity.php';
require_once APPPATH . 'models/entity/LocalisationEntity.php';

class UserEntity {

    private int $id;

    private string $login;
    
    private string $status;

    private LocalisationEntity $Localisation;
    private CoordonneesEntity $coordonnees;

}