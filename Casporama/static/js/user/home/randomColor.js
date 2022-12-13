function hover(elem) {
    let rd = Math.floor(Math.random()*4)
    if (rd == 0) {
        elem.classList.add('green_hover')
        elem.classList.remove('blue_hover')
        elem.classList.remove('yellow_hover')
        elem.classList.remove('red_hover')
    }
    if (rd == 1) {
        elem.classList.add('blue_hover')
        elem.classList.remove('green_hover')
        elem.classList.remove('yellow_hover')
        elem.classList.remove('red_hover')
    }
    if (rd == 2) {
        elem.classList.add('yellow_hover')
        elem.classList.remove('green_hover')
        elem.classList.remove('blue_hover')
        elem.classList.remove('red_hover')
    }
    if (rd == 3) {
        elem.classList.add('red_hover')
        elem.classList.remove('green_hover')
        elem.classList.remove('blue_hover')
        elem.classList.remove('yellow_hover')
    }
}