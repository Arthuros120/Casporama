<!-- admin/user/reviveUser/request/content -->


<div class="reset_pass">
    <div class="reset_pass_title">
        <h1> Résucité l'utilisateur</h1>
        <h2> Vous vous apprêtez à résucité l'utilisateur suivant : </h2>
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

    <div class="reset_pass_form">
      <div class="input_title">
        <h3> Êtes-vous sûr de vouloir résucité cette utilisateur ? </h3>
      </div>

      <?php echo form_open('Admin/reviveUser/' . $user->getId()); ?>
      <div class="switch_input">
        <p> Non </p>
        <label class="switch">
          <input id="switch" type="checkbox" name="switch">
          <span class="slider round"></span>
        </label>
        <p> Oui </p>
      </div>
      
      <div class="form_submit">
          <input type="submit" id="submitButton" value="Ne pas réssucité l'utilisateur">
      </div>

      <?php echo form_close(); ?>
    </div>
</div>






<!-- admin/user/reviveUser/request/content -->
