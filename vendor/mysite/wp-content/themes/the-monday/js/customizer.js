/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
    // Site title and description.
    	wp.customize( 'blogname', function( value ) {
    		value.bind( function( to ) {
    			$( '.site-title a' ).text( to );
                $( '.cp-sitename' ).html( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
    
    //Slider button text
    wp.customize( 'slider_button_text', function( value ) {
		value.bind( function( to ) {
			$( '.text-slider-section' ).find( '.button-header-slider a' ).text( to ) ;
		} );
	} );
	
    // Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
    
    //Site title
	wp.customize('site_title_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-title a').css('color', newval );
		} );
	});
	
    //Site desc
	wp.customize('site_desc_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-description').css('color', newval );
		} );
	});

    // Home Tab
    wp.customize( 'single_menu_home_text', function( value ) {
        value.bind( function( to ) {
            $( '#home-menu-text a' ).text( to );
        } );
    } );
    
    /*About section*/
    wp.customize( 'about_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-about' ).fadeOut();
            }else{
                $( '#tm-section-about' ).fadeIn();
            }
        } );
    } );
    // Menu Tab Text
    wp.customize( 'about_section_menu_title', function( value ) {
		value.bind( function( to ) {
			$( '#about-menu-text a' ).text( to );
		} );
	} );

    // About us read more button
    wp.customize( 'about_section_button_text', function( value ) {
        value.bind( function( to ) {
            $( '#tm-section-about a.read-btn' ).text( to );
        } );
    } );
    
    /*Service section*/
    wp.customize( 'services_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-services' ).fadeOut();
            }else{
                $( '#tm-section-services' ).fadeIn();
            }
        } );
    } );

    wp.customize( 'services_section_menu_title', function( value ) {
		value.bind( function( to ) {
			$( '#services-menu-text a' ).text( to );
		} );
	} );

    /*Team Member section*/
    wp.customize( 'team_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-team' ).fadeOut();
            }else{
                $( '#tm-section-team' ).fadeIn();
            }
        } );
    } );
    
    wp.customize( 'team_section_menu_title', function( value ) {
		value.bind( function( to ) {
			$( '#team-menu-text a' ).text( to );
		} );
	} );

    /*Subscribe section*/
    wp.customize( 'subscribe_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-subscribe' ).fadeOut();
            }else{
                $( '#tm-section-subscribe' ).fadeIn();
            }
        } );
    } );

    /*Portfolio section*/
    wp.customize( 'portfolio_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-portfolio' ).fadeOut();
            }else{
                $( '#tm-section-portfolio' ).fadeIn();
            }
        } );
    } );

    wp.customize( 'portfolio_section_menu_title', function( value ) {
        value.bind( function( to ) {
            $( '#portfolio-menu-text a' ).text( to );
        } );
    } );
    
    /*Testimonials section*/
    wp.customize( 'testimonials_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-testimonials' ).fadeOut();
            }else{
                $( '#tm-section-testimonials' ).fadeIn();
            }
        } );
    } );

    wp.customize( 'testimonials_section_menu_title', function( value ) {
		value.bind( function( to ) {
			$( '#testimonials-menu-text a' ).text( to );
		} );
	} );    
    

    /*Skill section*/
    wp.customize( 'skill_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-skill' ).fadeOut();
            }else{
                $( '#tm-section-skill' ).fadeIn();
            }
        } );
    } );

    /*Featured Product section*/
    wp.customize( 'featured_product_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-featured_product' ).fadeOut();
            }else{
                $( '#tm-section-featured_product' ).fadeIn();
            }
        } );
    } );
    
    /*clients section*/
    wp.customize( 'clients_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-clients' ).fadeOut();
            }else{
                $( '#tm-section-clients' ).fadeIn();
            }
        } );
    } );

    wp.customize( 'clients_section_menu_title', function( value ) {
		value.bind( function( to ) {
			$( '#clients-menu-text a' ).text( to );
		} );
	} );

    /*clients section*/
    wp.customize( 'blog_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-blog' ).fadeOut();
            }else{
                $( '#tm-section-blog' ).fadeIn();
            }
        } );
    } );
    
    wp.customize( 'blog_section_menu_title', function( value ) {
		value.bind( function( to ) {
			$( '#blog-menu-text a' ).text( to );
		} );
	} );

    /*Price table section*/
    wp.customize( 'price_tables_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-price_tables' ).fadeOut();
            }else{
                $( '#tm-section-price_tables' ).fadeIn();
            }
        } );
    } );
    
    wp.customize( 'price_tables_section_menu_title', function( value ) {
		value.bind( function( to ) {
			$( '#price_tables-menu-text a' ).text( to );
		} );
	} );
    
    //Slider button text
    wp.customize( 'slider_button_text', function( value ) {
		value.bind( function( to ) {
			$( '.button-header-slider a' ).text( to );
		} );
	} );    
    
    //Services section
	wp.customize( 'service_section_title', function( value ) {
		value.bind( function( to ) {
			$( '#tm-section-services h2' ).html( to );
		} );
	} );
    
    //Team Member section
	wp.customize( 'team_section_title', function( value ) {
		value.bind( function( to ) {
			$( '#tm-section-team h2' ).html( to );
		} );
	} );
    
    //Static counter section    
    wp.customize( 'static_counter_icon_1', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-1' ).find( 'i' ).attr( 'class', 'fa '+to );
        } );
    } );
    
    wp.customize( 'static_counter_icon_2', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-2' ).find( 'i' ).attr( 'class', 'fa '+to );
        } );
    } );
    
    wp.customize( 'static_counter_icon_3', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-3' ).find( 'i' ).attr( 'class', 'fa '+to );
        } );
    } );
    
    wp.customize( 'static_counter_icon_4', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-4' ).find( 'i' ).attr( 'class', 'fa '+to );
        } );
    } );
    
    wp.customize( 'static_counter_number_1', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-1' ).find( '.counter' ).html( to );
        } );
    } );

    wp.customize( 'static_counter_number_2', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-2' ).find( '.counter' ).html( to );
        } );
    } );

    wp.customize( 'static_counter_number_3', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-3' ).find( '.counter' ).html( to );
        } );
    } );

    wp.customize( 'static_counter_number_4', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-4' ).find( '.counter' ).html( to );
        } );
    } );
    
    wp.customize( 'static_counter_title_1', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-1' ).find( '.counter-title' ).html( to );
        } );
    } );

    wp.customize( 'static_counter_title_2', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-2' ).find( '.counter-title' ).html( to );
        } );
    } );

    wp.customize( 'static_counter_title_3', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-3' ).find( '.counter-title' ).html( to );
        } );
    } );

    wp.customize( 'static_counter_title_4', function( value )  {
        value.bind( function( to )  {
            $( '#counter-post-4' ).find( '.counter-title' ).html( to );
        } );
    } );

    //Portfolio section
    wp.customize( 'portfolio_section_title', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-portfolio h2' ).html( to );
        } );
    } );

    // Testimonilas section
    wp.customize( 'testimonials_section_menu_title', function( value ) {
        value.bind( function( to ) {
            $( '#testimonials-menu-text a' ).text( to );
        } );
    } );

    wp.customize( 'testimonials_section_title', function( value ) {
        value.bind( function( to ) {
            $( '#tm-section-testimonials h2' ).html( to );
        } );
    } );

    //Skill Section
    wp.customize( 'skill_section_title', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-skill h2' ).html( to );
        } );
    } );

    wp.customize( 'skill_section_description', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-skill p' ).html( to );
        } );
    } );

    
    wp.customize( 'skill_title_1', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-skill h5' ).html( to );
        } );
    } );

    wp.customize( 'skill_info_1', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-skill p' ).html( to );
        } );
    } );

    wp.customize( 'skill_title_2', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-skill h5' ).html( to );
        } );
    } );

    wp.customize( 'skill_info_2', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-skill p' ).html( to );
        } );
    } );

    wp.customize( 'skill_title_3', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-skill h5' ).html( to );
        } );
    } );

    wp.customize( 'skill_info_3', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-skill p' ).html( to );
        } );
    } );

    wp.customize( 'skill_title_4', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-skill h5' ).html( to );
        } );
    } );

    wp.customize( 'skill_info_4', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-skill p' ).html( to );
        } );
    } );

    //Featured section
    wp.customize( 'featired_product_section_title', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-featured_product h2' ).html( to );
        } );
    } );
    
    wp.customize( 'featired_product_section_description', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-featured_product p' ).html( to );
        } );
    } );
    
    //Price Table
    wp.customize( 'price_tables_section_title', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-price_tables h2' ).html( to );
        } );
    } );

    wp.customize( 'price_tables_section_description', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-price_tables p' ).html( to );
        } );
    } );

    //Our Clients    
    wp.customize( 'client_section_title', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-clients h2' ).html( to );
        } );
    } ); 

    //Blog section
    wp.customize( 'blog_section_title', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-blog h2' ).html( to );
        } );
    } );
    
    wp.customize( 'blog_more_button_title', function( value )  {
        value.bind( function( to )  {
            $( '.home-blog-read-more > a' ).html( to );
        } );
    } );
    
    
    // footer contact

    wp.customize( 'footer_contact_section_menu_title', function( value ) {
        value.bind( function( to ) {
            $( '#footer_contact-menu-text a' ).text( to );
        } );
    } );

    wp.customize( 'footer_contact_section_option', function( value ) {
        value.bind( function( to ) {
            if( to === 'disable' ) {
                $( '#tm-section-footer_contact' ).fadeOut();
            }else{
                $( '#tm-section-footer_contact' ).fadeIn();
            }
        } );
    } );

    wp.customize( 'footer_contact_section_title', function( value )  {
        value.bind( function( to )  {
            $( '#tm-section-footer_contact h2' ).html( to );
        } );
    } );

    wp.customize( 'footer_contact_title_1', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt1 h5' ).html( to );
        } );
    } );
    wp.customize( 'footer_contact_icon_1', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt1' ).find( 'i' ).attr( 'class', 'fa '+to );
        } );
    } );
    wp.customize( 'footer_contact_info_4', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt4 span' ).html( to );
        } );
    } );

    wp.customize( 'footer_contact_title_2', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt2 h5' ).html( to );
        } );
    } );
    wp.customize( 'footer_contact_icon_2', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt2' ).find( 'i' ).attr( 'class', 'fa '+to );
        } );
    } );
    wp.customize( 'footer_contact_info_2', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt2 span' ).html( to );
        } );
    } );

    wp.customize( 'footer_contact_title_3', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt3 h5' ).html( to );
        } );
    } );
    wp.customize( 'footer_contact_icon_3', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt3' ).find( 'i' ).attr( 'class', 'fa '+to );
        } );
    } );
    wp.customize( 'footer_contact_info_3', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt3 span' ).html( to );
        } );
    } );

    wp.customize( 'footer_contact_title_4', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt4 h5' ).html( to );
        } );
    } );
    wp.customize( 'footer_contact_icon_4', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt4' ).find( 'i' ).attr( 'class', 'fa '+to );
        } );
    } );
    wp.customize( 'footer_contact_info_4', function( value )  {
        value.bind( function( to )  {
            $( '#footer-cnt4 span' ).html( to );
        } );
    } );
    
    //Header font
    wp.customize( 'header_fonts', function( value )  {
        value.bind( function( to )  {
            $( '#content h2, #content h3, #content h3 a, #content h4, #content h5' ).css( "font-family", to );
        } );
    } );

    //Body font
    wp.customize( 'body_fonts', function( value )  {
        value.bind( function( to )  {
            $( '#content' ).css( "font-family", to );
        } );
    } );
    
} )( jQuery );