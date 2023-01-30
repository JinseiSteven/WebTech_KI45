window.addEventListener('load', function () {

    var navBarItems = document.querySelectorAll('.item');

    for(var i = 0; i < navBarItems.length; i++) {
        if (window.location.href == navBarItems[i].parentNode.href)
            navBarItems[i].classList.add("selected");
    }
})