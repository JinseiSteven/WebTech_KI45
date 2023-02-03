window.addEventListener('load', function () {
    // generate a quote the first time the session is started
    if (!sessionStorage.quotePresent) {
        var quote_json = fetch('https://zenquotes.io/api/random/');
        sessionStorage.quote = quote_json["q"];
        sessionStorage.author = quote_json["a"];
        sessionStorage.quotePresent = 1;
    }

    document.querySelector("#quote").innerText = sessionStorage.quote;
    document.querySelector("#author").innerText = sessionStorage.author;
})