<!-- admin/user/reviveUser/success/content -->

<div class="resetPass_error">
    <div class="reset_pass_title">
        <h1> L'utilisateur suivant a bien été réssucité</h1>
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

<!-- admin/user/reviveUser/success/content -->
