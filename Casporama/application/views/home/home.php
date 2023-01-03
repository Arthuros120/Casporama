<!-- home/home -->

<div class="home">
    <nav class="home_nav">
        <div class="home_nav_left">
            <a><img src="<?= base_url()?>static/image/casporama.png"></a>
        </div>
        <?php if (isset($user)) { ?> 
        <div class="home_nav_right">
            <a href="<?= base_url() ?>User/logout"><h2>Se déconnecter</h2></a>
            <a href="<?= base_url() ?>User/home"><h2>Mon compte</h2></a>
        </div>
        <?php } else { ?>
        <div class="home_nav_right">
            <a href="<?= base_url() ?>User/register"><h2>S'inscrire</h2></a>
            <a href="<?= base_url() ?>User/login"><h2>Se connecter</h2></a>
        </div>
        <?php } ?>
    </nav>
    <div id="carousel" >
        <div id="container" ></div>
        <button class="home_picture_arrow_left" id="left">
            <img src="<?= base_url() ?>static/image/icon/arrow.svg" >
        </button>
        <button class="home_picture_arrow_right" id="right" >
            <img src="<?= base_url() ?>static/image/icon/arrow.svg" >
        </button>
    </div>
    <div class="home_cat">
        <div class="home_foot">
            <a href="<?= base_url()?>Shop/home/Football">
                <div class="home_cat_img">
                    <img src="<?= base_url() ?>static/image/home_foot.png" >
                </div>
                <div class="home_cat_title">
                    <h2>Football</h2>
                </div>
            </a>  
        </div>
        <div class="home_volley">
            <a href="<?= base_url()?>Shop/home/Volleyball">
            <div class="home_cat_img">
                <img src="<?= base_url() ?>static/image/home_volley.png" >
            </div>
            <div class="home_cat_title">
                <h2>Volleyball</h2>
            </div>
            </a>
        </div>
        <div class="home_bad">
            <a href="<?= base_url()?>Shop/home/Badminton">
            <div class="home_cat_img">
                <img src="<?= base_url() ?>static/image/home_bad.png" >
            </div>
            <div class="home_cat_title">
                <h2>Badminton</h2>
            </div>
            </a>
        </div>
        <div class="home_mma">
            <a href="<?= base_url()?>Shop/home/Arts-martiaux">
            <div class="home_cat_img">
                <img src="<?= base_url() ?>static/image/home_mma.png" >
            </div>
            <div class="home_cat_title">
                <h2>Arts-Martiaux</h2>
            </div>
            </a>
        </div>
    </div>
</div>

<script>

    document.body.onload=function() {
        slider()
    }
    
</script>

<!-- home/home -->
