<!-- user/verify/content -->

<script>
function suivant(enCours, suivant, precedent, limite) {
    console.log("suivant")
    if (enCours.value.length == limite) {
        document.verifyForm[suivant].focus();
    }

    if (enCours.value.length == 0) {
        document.verifyForm[precedent].focus();
    }
}

</script>

<div class="input_verify_content">
    <div class="input_verify_title">
        <h1>Veuillez entrez le code de verification </h1>
    </div>

    <div class="input_verify_input">
        <?php echo form_open('User/verify?idKey=' . $idKey, $formAttributes); ?> <!-- class = input_verify_form -->
            <div class="input_content">
                <input class="input_verify" name="code1" maxlength="1" type="text" onkeyup="suivant(this,1,0,1)" onkeydown="return /[0-z]/i.test(event.key)">
                <input class="input_verify" name="code2" maxlength="1" type="text" onkeyup="suivant(this,2,0,1)" onkeydown="return /[0-z]/i.test(event.key)">
                <input class="input_verify" name="code3" maxlength="1" type="text" onkeyup="suivant(this,3,1,1)" onkeydown="return /[0-z]/i.test(event.key)">
                <input class="input_verify" name="code4" maxlength="1" type="text" onkeyup="suivant(this,4,2,1)" onkeydown="return /[0-z]/i.test(event.key)">
                <input class="input_verify" name="code5" maxlength="1" type="text" onkeyup="suivant(this,5,3,1)" onkeydown="return /[0-z]/i.test(event.key)">
                <input class="input_verify" name="code6" maxlength="1" type="text" onkeyup="suivant(this,6,4,1)" onkeydown="return /[0-z]/i.test(event.key)">
            </div>
            <div class="submit_content">
                <input class="input_verify_submit" onmouseenter="hover(this)" type="submit" name="submit" value="Valider" />
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?= $error ?>

<!-- user/verify/content -->
