<!-- user/recoverPass/request/content -->

<h1>Recover your password</h1>

<p>Enter your email address and we will send you a link to reset your password.</p>

<?php echo form_open('User/recoverPass'); ?>

<input type="email" name="email" placeholder="Email" />

<input type="submit" value="Validé" />

<?php echo form_close(); ?>

<div class="error" <?php

                    if ($error == null) {
                        echo "hidden";
                    }

                    ?>><?= $error ?>
</div>

<!-- user/recoverPass/request/content -->
