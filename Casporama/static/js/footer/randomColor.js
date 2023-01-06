function hover(elem) {
    let rd = Math.floor(Math.random()*4)
    if (rd == 0) {
        elem.classList.add('green_hover_footer')
        elem.classList.remove('blue_hover_footer')
        elem.classList.remove('yellow_hover_footer')
        elem.classList.remove('red_hover_footer')
    }
    if (rd == 1) {
        elem.classList.add('blue_hover_footer')
        elem.classList.remove('green_hover_footer')
        elem.classList.remove('yellow_hover_footer')
        elem.classList.remove('red_hover_footer')
    }
    if (rd == 2) {
        elem.classList.add('yellow_hover_footer')
        elem.classList.remove('green_hover_footer')
        elem.classList.remove('blue_hover_footer')
        elem.classList.remove('red_hover_footer')
    }
    if (rd == 3) {
        elem.classList.add('red_hover_footer')
        elem.classList.remove('green_hover_footer')
        elem.classList.remove('blue_hover_footer')
        elem.classList.remove('yellow_hover_footer')
    }
}