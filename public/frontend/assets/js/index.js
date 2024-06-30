$(function() {
    "use strict";


	$('.banner-slider').owlCarousel({
		loop:true,
		margin:0,
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
				margin:0,
				items:1
			},
			576:{
				nav:false,
				items:1
			},
			768:{
				nav:false,
				items:1
			},
			1024:{
				nav:false,
				items:1
			},
			1366:{
				items:1
			},
			1400:{
				items:1
			}
	     },
    	})


	
	$('.new-arrivals').owlCarousel({
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




		$('.browse-category').owlCarousel({
			loop:true,
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
					items:5
				},
				1400:{
					items:5
				}
			 },
			})


			$('.latest-news').owlCarousel({
				loop:true,
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
						items:4
					}
				 },
				})




				$('.brands-shops').owlCarousel({
					loop:true,
					margin:0,
					responsiveClass:true,
					nav:true,
					navText: [
						"<i class='bx bx-chevron-left'></i>",
						"<i class='bx bx-chevron-right' ></i>"
					],
					autoplay:true,
					autoplayTimeout:5000,
					dots: false,
					responsive:{
						0:{
							nav:false,
							items:2
						},
						576:{
							nav:false,
							items:3
						},
						768:{
							nav:false,
							items:4
						},
						1024:{
							nav:false,
							items:5
						},
						1366:{
							items:5
						},
						1400:{
							items:6
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
   