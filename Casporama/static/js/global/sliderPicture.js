    nb_img = 3
    pos = 0
    timer = 5

    const baseUrl = window.location.origin

    function waiter() {
        pos--
        if (pos <= -nb_img) {
            pos = 0
        }

        container.style.transform="translate("+pos*100+"vw)"
        container.style.transition="all 0.5S ease"

        setTimeout(waiter,timer*1000)
    }

    function slider() {

        container = document.getElementById("container")
        gauche = document.getElementById("left")
        droite = document.getElementById("right")
        container.style.width = (100*nb_img)+"vw"

        for (i=1; i<=nb_img; i++) {
            div = document.createElement("div")
            div.className = "photo"
            div.style.backgroundImage = "url("+baseUrl+"/static/image/casporama_home_"+i+".png)"
            container.appendChild(div)
        }

        droite.onclick=function() {
            if (pos>-nb_img+1)
            pos--
            container.style.transform="translate("+pos*100+"vw)"
            container.style.transition="all 0.5S ease"
        }

        gauche.onclick=function() {
            if (pos<0)
            pos++
            container.style.transform="translate("+pos*100+"vw)"
            container.style.transition="all 0.5S ease"
        }
        
        setTimeout(waiter,"5000")
    }