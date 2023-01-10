function disabled(link)
{
    link.onclick = function(event) {
        event.preventDefault();
    }
};