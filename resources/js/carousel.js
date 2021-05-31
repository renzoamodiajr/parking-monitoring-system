$(document).ready(function(){

    // banner section owl carousel
    $("#bay-stats-container .owl-carousel").owlCarousel({
        autoplay: true,
        rewind: true,
        autoplayHoverPause: true,
        margin: 8,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:false
            }
        }
    });

});