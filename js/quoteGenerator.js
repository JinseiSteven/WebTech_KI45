const getFormattedDate = () => {
    var dateObj = new Date();
    var month = dateObj.getUTCMonth() + 1; //months from 1-12
    var day = dateObj.getUTCDate();
    var year = dateObj.getUTCFullYear();
    
    formattedDate = year + "/" + month + "/" + day;
    return formattedDate;
}

window.addEventListener('load', function async() {
    // load quote date and current quote from localstorage
    // if its not set fetch a new quote and store it in local storage
    // if its set but setdate doenst equal current date set a new one

    let quoteData = window.localStorage.getItem('quote')
    
    
    if(quoteData.date !== getFormattedDate() || quoteData === undefined){ 
        let data = await fetchNewQuote()
        return setQuote(data.author, quoteData.value)

    }  else {
        return setQuote(quoteData.author, quoteData.value)
    }
    
})



const fetchNewQuote = async () => {
    var quote_json = fetch("https://zenquotes.io/api/random", {
        "headers": {
          "accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
          "accept-language": "en-US,en;q=0.9,nl;q=0.8,fr;q=0.7",
          "cache-control": "no-cache",
          "pragma": "no-cache",
          "sec-ch-ua": "\"Not?A_Brand\";v=\"8\", \"Chromium\";v=\"108\", \"Google Chrome\";v=\"108\"",
          "sec-ch-ua-mobile": "?0",
          "sec-ch-ua-platform": "\"macOS\"",
          "sec-fetch-dest": "document",
          "sec-fetch-mode": "navigate",
          "sec-fetch-site": "none",
          "sec-fetch-user": "?1",
          "upgrade-insecure-requests": "1"
        },
        "referrerPolicy": "strict-origin-when-cross-origin",
        "body": null,
        "method": "GET",
        "mode": "cors",
        "credentials": "omit"
      });

    var quote_json = await quote_json.json()[0]


    let quoteData = {
        'date': getFormattedDate(),
        'author': quote_json['a'],
        'value': quote_json['q']

    }
    window.localStorage.setItem('quote', JSON.stringify(quoteData));
    return quoteData;
}



const setQuote = async(author, value) =>{
    document.querySelector("#author").innerText = author;
    document.querySelector("#quote").innerText = value;
 
}