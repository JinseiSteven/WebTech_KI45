window.addEventListener('load', function () {

    var courses = document.querySelectorAll('.course');

    for(var i = 0; i < courses.length; i++) {
        window.addEventListener('change', function (e) {
            var name = e.target.name;
            var classes = document.querySelectorAll(`#${name}`);
            if (e.target.checked) {
                for(var i = 0; i < classes.length; i++) {
                    classes[i].style.display = 'block';
                }
            }
            else {
                for(var i = 0; i < classes.length; i++) {
                    classes[i].style.display = 'none';
                }
            }
        })
    }
})