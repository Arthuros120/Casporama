<!-- admin/user/resetPass/error/content -->

<div class="resetPass_error">
    <div class="reset_pass_title">
        <h1> Le mots de passe de l'utilisateur suivant n'a pas été réinitialiser</h1>
    </div>

    <div class="reset_pass_info">

        <div class="box">
          <h3>Login :</h3>
          <p><?= $user->getLogin() ?></p>
        </div>

        <div class="box">
          <h3>Nom :</h3>
          <p><?= $user->getCoordonnees()->getNom() ?></p>
        </div>

        <div class="box">
          <h3>Prénom :</h3>
          <p><?= $user->getCoordonnees()->getPrenom() ?></p>
        </div>

        <div class="box">
          <h3>Email :</h3>
          <p><?= $user->getCoordonnees()->getEmail() ?></p>
        </div>

    </div>
</div>

<!-- admin/user/resetPass/error/content -->
