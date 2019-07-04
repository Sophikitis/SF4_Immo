var $ = require('jquery');



import Places from 'places.js';
import Map from './modules/map.js';
import './modules/owl.carousel.min'
import './modules/bootstrap.bundle'
import './modules/masonry.pkgd.min'
import './modules/main'




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




// TODO : FIX
import './../../node_modules/toastr/build/toastr.css';
import toastr from 'toastr';
window.toastr = toastr;
//


require('../css/owl/owl.carousel.css');
require('../css/owl/owl.theme.default.css');

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
            slideSpeed: 350,
            singleItem: true,
            autoHeight: true,
            navigation: true,
            items : 3
        }
    );
});

$('.toast').toast();



/*------------------
		Background set
	--------------------*/
/*
$('.set-bg').each(function() {
    let bg = $(this).data('setbg');
    $(this).css('background-image', 'url(' + bg + ')');
});
*/



$('.gallery').find('.gallery-item').each(function() {
    let pi_height1 = $(this).outerWidth(true),
        pi_height2 = pi_height1 / 2;

    if($(this).hasClass('grid-long') && window_w > 991){
        $(this).css('height', pi_height2);
    }else{
        $(this).css('height', Math.abs(pi_height1));
    }
});


/*

$('.gallery').masonry({
    itemSelector: '.gallery-item',
    columnWidth: '.grid-sizer',
    gutter: 20
});
*/



/*import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel';*/



/*import  'slick-carousel';
import 'slick-carousel/slick/slick-theme.css';
import 'slick-carousel/slick/slick.css';*/



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



// CSSS
require('../css/app.css');
require('../css/footer.css');
require('../css/template/animate.css');
require('../css/template/bootstrap.min.css');
/*
require('../css/template/font-awesome.min.css');
*/
require('../css/template/magnific-popup.css');
require('../css/template/style.css');


// LIB JS
require('select2');


//slider
/*$('[data-slider]').slick({
    arrows: true,
    infinite: true,
    autoplay: true,
    fade: true,
    dots: true,
    autoplaySpeed: 5000,
    pauseOnHover: true
});*/


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
$('.select').select2(
    {
        placeholder: "Select a state",
        allowClear: true
    }
);


/*//contact
let $contactButton = $('#contactButton');
$contactButton.click(e =>{
    e.preventDefault();
    $('#contactForm').slideDown();
    $('#contactButton').slideUp();
});*/



document.querySelectorAll('[data-redirect]').forEach(b =>{
    b.addEventListener('click', d=>{
        d.preventDefault();
        window.location.href = b.getAttribute('data-redirect');
    })
});





// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in homePicture/js/app.js');
