window.addEventListener('load', function () {

    // getting the csrf-token from the meta tag
    var csrf_token = this.document.querySelector('meta[name="csrf_token"]').content;

    // entering the csrf-token into all the hidden fields
    var csrf_fields = this.document.getElementsByName("csrf_token");
    for(var i = 0; i < csrf_fields.length; i++) {
        csrf_fields[i].value = csrf_token;
    }
})