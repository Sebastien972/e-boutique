
console.log('ojlkimyutrgthyukhiljkù');
$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
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
    let owl = $('.owl-carousel');
    owl.owlCarousel();


    $('.owl-prev').click(function() {
        owl.trigger('next.owl.carousel');
    })
    // Go to the previous item
    $('.owl-next').click(function() {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        owl.trigger('prev.owl.carousel');
    })

});

