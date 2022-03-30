
$(document).ready(function(){
    let owl = $('.owl-carousel');

    owl.owlCarousel({
        margin: 30,
        //loop: true,
        items: 4,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
                loop:true,
            },
            1000:{
                items:3,
                center: false
            }
        },
    });
    let meilleurVentCarousel = $('.meilleurVenteCarousel')
    meilleurVentCarousel.owlCarousel();


    $('.owl-prev').click(function() {
        meilleurVentCarousel.trigger('prev.owl.carousel');
    })
    // Go to the previous item
    $('.owl-next').click(function() {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        meilleurVentCarousel.trigger('next.owl.carousel');
    })

    let categorieCarousel = $('.categorieCarousel')
    categorieCarousel.owlCarousel();


    $('.prev').click(function() {
        categorieCarousel.trigger('prev.owl.carousel');
    })
    // Go to the previous item
    $('.next').click(function() {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        categorieCarousel.trigger('next.owl.carousel');
    })


});

