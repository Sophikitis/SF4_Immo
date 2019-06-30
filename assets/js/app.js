import Places from 'places.js';
import Map from './modules/map.js';
import  'slick-carousel';
import 'slick-carousel/slick/slick-theme.css';
import 'slick-carousel/slick/slick.css';


Map.init();

let inputAddress = document.querySelector('#property_address');
if(inputAddress !== null){
    let place = Places({
        container: inputAddress
    });
    place.on('change', e =>{
        document.querySelector('#property_city').value =  e.suggestion.city;
        document.querySelector('#property_postal_code').value =  e.suggestion.postcode;
        document.querySelector('#property_lat').value =  e.suggestion.latlng.lat;
        document.querySelector('#property_lng').value =  e.suggestion.latlng.lng;
    })
}

let searchAddress = document.querySelector('#search_address');
if(searchAddress !== null){
    let place = Places({
        container: searchAddress
    });
    place.on('change', e =>{
        document.querySelector('#lat').value =  e.suggestion.latlng.lat;
        document.querySelector('#lng').value =  e.suggestion.latlng.lng;
    })
}






//Jquery
var $ = require('jquery');

// CSSS
require('../css/app.css');
require('../css/footer.css');

// LIB JS
require('select2');



//slider
$('[data-slider]').slick({
    arrows: true,
    infinite: true,
    autoplay: true,
    fade: true,
    dots: true,
    autoplaySpeed: 5000,
    pauseOnHover: true
});


/*$('[data-slider]').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000,
    speed: 300,
    slidesToShow: 1,
    centerMode: false,
    variableWidth: false,
    fade: true,
    cssEase: 'linear'
});*/









// select2
$('select').select2(
    {
        placeholder: "Select a state",
        allowClear: true
    }
);

//contact
let $contactButton = $('#contactButton');
$contactButton.click(e =>{
    e.preventDefault();
    $('#contactForm').slideDown();
    $('#contactButton').slideUp();
});

// Suppression des éléments
document.querySelectorAll('[data-delete]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault();
        fetch(a.getAttribute('href'), {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({'_token': a.dataset.token})
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    a.parentNode.parentNode.removeChild(a.parentNode)
                } else {
                    alert(data.error)
                }
            })
            .catch(e => alert(e))
    })
});




// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in homePicture/js/app.js');
