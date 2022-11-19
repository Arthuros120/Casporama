<!-- user/home/overlay/modifLastName -->

<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">

        <div class="modal-body" id="modal-body">

            <h1>Changement du nom de famille</h1>

            <h2>Veuillez entrer le nouveau nom de famille</h2>

            <p>Votre nom actuel: <?= $user->getCoordonnees()->getNom() ?></p>

            <?php echo form_open('User/home/modifLastName'); ?>

            <input type="text" name="newLastName" placeholder="Nouveau nom de famille" />

            <button type="submit">Valider</button>

            <?php echo form_close(); ?>

            <div class="error" <?php

                    if ($error == null) {
                        echo "hidden";
                    }

                    ?>><?= $error ?>
            </div>

            <a class="close-button" href="<?= base_url('User/home/info'); ?>"><p>Annuler</p></a></br>

        </div>

    </div>
</div>

<!-- user/home/overlay/modifLastName -->
