jQuery(document).ready(function($){

    //Circle counter  
    $('#circle-counter')
    .fadeOut(0) // immediately hide element
    .waypoint(function(direction) {
      if (direction === 'down') {
        $(this.element).fadeIn()
      }
      else {
        $(this.element).fadeOut()
      }
    }, {
      offset: 'bottom-in-view'
    });

    // .cloader function
    $('.skill-loader').each(function () {
     var that = $(this);
     var percent = that.attr("data-percentage");
     var color = that.attr("color");

     that.waypoint({
         handler: function (direction) {
             that.ClassyLoader({
                 percentage: percent,
                 diameter: 70,
                 lineWidth: 11,
                 speed: 30,
                 lineColor: color,
                 remainingLineColor: 'rgba(240, 240, 240, 1)',
             });
         },
         offset: '95%',
         triggerOnce: true
     });
    });

    // Static Counter    
    $('.counter').counterUp({
        delay: 20,
        time: 2000
    });

    //Header slider    
    if ( $( "#slideshow" ).length ) {
        $('#slideshow').superslides({
            play: $('#slideshow').data('speed'),
            animation: 'fade',
            animation_speed : 1300,
            pagination: true,
        });
    }

    // Portfoilos section
    $('#protfolios-gallery-container').imagesLoaded( function() {  
        $('#protfolios-gallery-container').isotope({ 
            filter: '*',
            itemSelector: '.isotope-item',
            layoutMode: 'fitRows',
            animationOptions: {
                duration: 750,
                easing: 'liniar',
                queue: false,
            }
        }); 

        $('.protfolios-filter a').click(function(){ 
            var selector = $(this).attr('data-filter');
    		$('.protfolios-filter li').removeClass('active');
    		$(this).parent().addClass('active');	        
            $('#protfolios-gallery-container').isotope({ 
                filter: selector,
                layoutMode: 'fitRows',
                animationOptions: {
                    duration: 750,
                    easing: 'liniar',
                    queue: false,
                } 
            }); 
          return false; 
        });
    });
    
    //Parallax effect
    $(window).on('load', function(){
        $('#tm-section-testimonials').parallax('30%', 0.6, true);
        $('#tm-section-subscribe').parallax('50%', 0.6, true);
    });
    
    //Top up arrow
    $("#scroll-up").hide();
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 1000) {
				$('#scroll-up').fadeIn();
			} else {
				$('#scroll-up').fadeOut();
			}
		});
		$('a#scroll-up').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

  $('#team-slider').lightSlider({
      item:4,
      loop:false,
      slideMove:1,
      easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
      speed:600,
      enableDrag:false,
      responsive : [
          {
              breakpoint:800,
              settings: {
                  item:3,
                  slideMove:1,
                  slideMargin:6,
                }
          },
          {
              breakpoint:480,
              settings: {
                  item:1,
                  slideMove:1
                }
          }
      ]
    });

  $('#testimonials-slider').lightSlider({
      item:1,
      loop:true,
      auto:true,
      speed:1500,
      enableDrag:false,
      pager:false,
      pause:4000
  });
  
  $('#client-slider').lightSlider({
      item:4,
      loop:true,
      auto:true,
      slideMove:1,
      easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
      speed:600,
      pager:false,
      controls:false,
      enableDrag: false,
      responsive : [
          {
              breakpoint:800,
              settings: {
                  item:4,
                  slideMove:1,
                  slideMargin:6,
                }
          },
          {
              breakpoint:480,
              settings: {
                  item:2,
                  slideMove:1
                }
          }
      ]
  });

  /*Responsive menu*/
  $('.nav-toggle').click(function() {
      $('.mainnav').slideToggle('slow');
      $(this).parent('.home-nav').toggleClass('active');
  });

  /*Get windows size*/
if( $('body').hasClass('home') ) {
    if( $('#slideshow').length ) {
        $(window).resize(function() {
            var wHeight = ( $(window).height()-90 );
            $('#tm-section-mainslider').height(wHeight);
        }).resize();
    }
    if( $('.front-header-image').length ) {
      $(window).resize(function() {
        var wHeight = ( $(window).height()-90 );
        $('.front-header-image').height(wHeight);
      }).resize();
    }
}

});