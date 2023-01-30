window.addEventListener('load', function () {

var navBarItems = document.querySelectorAll('.item')

    for(var i = 0; i < navBarItems.length; i++) {
            navBarItems[i].addEventListener('click', function() {
            document.getElementsByClassName('selected')[0].classList.remove('selected');
            document.getElementsByClassName('active')[0].classList.remove('active');
            
            // for this demo we put the classname of the content in our navbar id
            // so using the id of the navbar item do shit with the content
            document.getElementsByClassName(this.id)[0].classList.add('active')
            this.className += ' selected'
        })
    
    }
})