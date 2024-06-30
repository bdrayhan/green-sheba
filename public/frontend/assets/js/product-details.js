$(function() {
	"use strict";

    $('.similar-products').owlCarousel({
		loop:false,
		margin:24,
		responsiveClass:true,
		nav:true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
		    "<i class='bx bx-chevron-right' ></i>"
		 ],
		dots: false,
		responsive:{
			0:{
				nav:false,
				margin:16,
				items:2
			},
			576:{
				nav:false,
				items:2
			},
			768:{
				nav:false,
				items:3
			},
			1024:{
				nav:false,
				items:4
			},
			1366:{
				items:4
			},
			1400:{
				items:5
			}
	     },
    	})




    $('.product-gallery').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        nav:false,
        dots: false,
        thumbs: true,
        thumbsPrerendered: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
             }
          }
        })














});