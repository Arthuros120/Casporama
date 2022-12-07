<!-- user/content/head -->

<div class="dead_account_content">

    <div class="dead_title">
        <div class="dead_title_main">
            <h1><span class="green">O</span><span class="blue">o</span><span class="yellow">p</span><span class="red">s</span>, </h1>
            <h1> votre compte est expiré.</h1>
        </div>
        <p> Votre compte est expiré depuis le <?=$date['day']?> <?=$date['month']?> <?=$date['year']?>. </p>
    </div>

    <div class="dead_content">
        <p> Il vous reste <?= $dayRemaining[0] ?> jours <?= $dayRemaining[1] ?> heures et <?= $dayRemaining[2] ?> minutes pour renouveler votre compte. </p>
        <p> Si vous ne renouvelez pas votre compte, il sera supprimé définitivement. </p>
        <p> Pour renouveler votre compte, contacter un administrateur. </p>
    </div>

</div>




<!-- user/content/head -->
