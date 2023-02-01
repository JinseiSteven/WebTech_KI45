

const EXPIRY_DAYS = 10; // idk whats normal but 10 days seems good

function setCookie(name, value) {
    var date = new Date();

    // 86400 = 1 day in seconds
    date.setTime(date.getTime() + (EXPIRY_DAYS * 86400 *1000)); 
    expires = "; expires=" + date.toDateString();
  
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

const getCookieValue = (name)  => {
    var cookiesArray = document.cookie.split(';');
    for(var i = 0; i < cookiesArray.length; i++) {
        var cookie = cookiesArray[i].split('=');
        if (cookie[0].trim() == name) {
            return cookie[1];
        }
    }
  
    return null;
}


const handleCookieConsent = () => {
    var acceptButton = document.getElementById('accept-cookies');
    var declineButton = document.getElementById('deny-cookies');
    var cookieOverlay = document.getElementsByClassName('cookie-overlay')[0]

    // Check if cookie is set
    let cookiesValue = getCookieValue('cookieConsent');
    console.log(cookiesValue)
    // not null means we already set the cookie, true or false
    if (cookiesValue !== null) {
        cookieOverlay.classList.add('hidden');
    }
    else {
        //remove hidden class to show the overlay
        cookieOverlay.classList.remove('hidden');

        // add event listeners to buttons
        declineButton.addEventListener('click', function () {
            cookieOverlay.classList.add('hidden');
            setCookie('cookieConsent', 'declined')
            Nosifier.error('That\'s okay, you can still use the site!')
        });
        acceptButton.addEventListener('click', function () {
            cookieOverlay.classList.add('hidden');
            setCookie('cookieConsent', 'accepted')
            Nosifier.sucess('Cookies accepted!')
        });
    }
}


window.addEventListener('load', function () {
   

    handleCookieConsent();

    
});