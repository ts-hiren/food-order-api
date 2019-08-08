(function($) {
    'use strict';

    

/*============ Scroll Up Activation ============*/
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'slide'
    });

/*=========== Mobile Menu ===========*/
    $('nav.mobilemenu__nav').meanmenu({
        meanMenuClose: 'X',
        meanMenuCloseSize: '18px',
        meanScreenWidth: '991',
        meanExpandableChildren: true,
        meanMenuContainer: '.mobile-menu',
        onePage: true
    });

/*=========== Wow Active ===========*/
    new WOW().init();

/*=========== Sticky Header ===========*/
    function stickyHeader() {
        $(window).on('scroll', function () {
            var sticky_menu = $('.sticky__header');
            var pos = sticky_menu.position();
            if (sticky_menu.length) {
                var windowpos = sticky_menu.top;
                $(window).on('scroll', function () {
                  var windowpos = $(window).scrollTop();
                  if (windowpos > pos.top + 250) {
                    sticky_menu.addClass('is-sticky');
                  } else {
                    sticky_menu.removeClass('is-sticky');
                  }
            });
          }
        });
    }
    stickyHeader();

/*=============  Produst Activation  ==========*/
    $('.productcategory__slide').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        autoplay: false,
        autoplayTimeout: 10000,
        items:4,
        navText: ['<i class="zmdi zmdi-chevron-left"></i>', '<i class="zmdi zmdi-chevron-right"></i>' ],
        dots: false,
        lazyLoad: true,
        responsive:{
            0:{
                items:2
            },
            992:{
                items:4
            },
            768:{
                items:3
            },
            576:{
                items:2
            },
            1920:{
                items:4
            }
        }
    });


/*=============  Produst Activation  ==========*/
    $('.productcategory__slide--2').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        autoplay: true,
        autoplayTimeout: 10000,
        items:4,
        navText: ['<i class="zmdi zmdi-chevron-left"></i>', '<i class="zmdi zmdi-chevron-right"></i>' ],
        dots: false,
        lazyLoad: true,
        responsive:{
            0:{
              items:2
            },
            576:{
              items:2
            },
            768:{
              items:3
            },
            1080:{
              items:4
            },
            1920:{
              items:4
            }
        }
    });


/*=============  Product Activation ============*/
    $('.product__indicator--4').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        autoplay: false,
        autoplayTimeout: 10000,
        items:4,
        navText: ['<i class="zmdi zmdi-chevron-left"></i>', '<i class="zmdi zmdi-chevron-right"></i>' ],
        dots: false,
        lazyLoad: true,
        responsive:{
            0:{
              items:2
            },
            576:{
              items:2
            },
            768:{
              items:3
            },
			992:{
                items:4
            },
            1920:{
              items:4
            }
        }
    });
  

/*=============  Product Activation  ==============*/
    $('.furniture--4').owlCarousel({
        loop:true,
        margin: 0,
        nav:true,
        autoplay: false,
        autoplayTimeout: 10000,
        items:4,
        navText: ['<i class="zmdi zmdi-chevron-left"></i>', '<i class="zmdi zmdi-chevron-right"></i>' ],
        dots: false,
        lazyLoad: true,
        responsive:{
            0:{
              items:2
            },
            576:{
              items:2
            },
            768:{
              items:3
            },
			992:{
                items:4
            },
            1920:{
              items:4
            }
        }
    });


/*============= Setting Toggler ==============*/
    function settingToggler() {
        var settingTrigger = $('.setting__active'),
          settingContainer = $('.setting__block');
        settingTrigger.on('click', function (e) {
          e.preventDefault();
          settingContainer.toggleClass('is-visible');
        });
        settingTrigger.on('click', function (e) {
          e.preventDefault();
          settingContainer.toggleClass('');
        });
    }
    settingToggler();


/*============= Fancybox ==============*/
    $('.fancybox').fancybox({
        prevEffect  : 'none',
        nextEffect  : 'none',
        helpers : {
          title : {
            type: 'outside'
          },
          thumbs  : {
            width : 50,
            height  : 50
          }
        }
    });


/*========= Video ===========*/
    var video_frame_w= $('.img_static').outerWidth();
    var video_frame_h= $('.img_static').outerHeight();
    $('#cms_play').on('click', function(){
        $(this).hide('fast');
        $(".img_static").fadeOut('fast');
        $('.static_video').append('<iframe class="added_video" width="'+video_frame_w+'px" height="'+video_frame_h+'px" src="https://www.youtube.com/embed/0fYMLQjK-MI?rel=0&autoplay=1" frameborder="0"></iframe>');
    });


/*====== Dropdown ======*/
    $('.dropdown').parent('.drop').css('position' , 'relative');

	
/*====== slick slider ======*/
	$('.center').owlCarousel({
	    loop:true,
	    margin: 0,
	    nav:false,
	    autoplay: true,
	    autoplayTimeout: 10000,
	    items:7,
	    dots: false,
	    center: true,
	    lazyLoad: true,
	    responsive:{
	    0:{
	      items:2
	    },
	    480:{
	      items:2
	    },
	    768:{
	      items:3
	    },
	    970:{
	      items:5
	    },
	    1100:{
	      items:5
	    },
	    1366:{
	      items:6
	    },
	    1920:{
	      items:7
	    }
	    }
	});
})(jQuery);

