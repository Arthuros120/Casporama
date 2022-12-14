<!-- home/home -->

<script>
    document.body.onload=function() {
        let nb_img = 3;
        let pos = 0;

        const container = document.getElementById("container")
        const left = document.getElementById("left")
        const right = document.getElementById("right")

        container.style.width = 100 + "vw"
        container.style.height = 68 + "vh"

        for (let i=1; i<=nb_img; i++) {
            div = document.createElement('div');
            div.className="picture";
            div.style.backgroundImage="url(<?= base_url() ?>static/image/casporama_home_"+i+".png)";
            container.appendChild(div);
        }
    }
</script>


<div class="home">
    <nav class="home_nav">
        <div class="home_nav_left">
            <a><img src="<?= base_url()?>static/image/casporama.png"></a>
        </div>
        <div class="home_nav_right">
            <a><h2>S'inscrire</h2></a>
            <a><h2>Se connecter</h2></a>
        </div>
    </nav>
    <div class="home_picture" id="carrousel">
        <div id="container"></div>
        <img id="left" class="home_picture_arrow_left" src="<?= base_url() ?>static/image/icon/arrow.svg">
        <img id="right" class="home_picture_arrow_right" src="<?= base_url() ?>static/image/icon/arrow.svg">
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
            <a href="<?= base_url()?>Shop/home/Art_martiaux">
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




<!-- home/home -->
