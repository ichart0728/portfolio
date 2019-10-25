<?php
/**
 * Dymanic css choose from backend
 * 
 * @package The Monday
 */

header("Content-type: text/css");

$url    = dirname( __FILE__ );
$strpos = strpos( $url, 'wp-content' );
$root   = substr( $url, 0, $strpos );

if ( file_exists( $root . '/wp-load.php' ) ) {
   require_once $root . '/wp-load.php';
}else {
   die('/* Error */');
}
 
 //Converts hex colors to rgba for the menu background color
function the_monday_hex2rgba($color, $opacity = false) { 
    $default = 'rgb(0,0,0)'; 
    //Return default if no color provided
    if(empty($color))
     return $default;  
    //Sanitize $color if "#" is provided 
   if ($color[0] == '#' ) {
    $color = substr( $color, 1 );
   }

   //Check if color has 6 or 3 characters and get values
   if (strlen($color) == 6) {
           $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
   } elseif ( strlen( $color ) == 3 ) {
           $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
   } else {
           return $default;
   }

   //Convert hexadec to rgb
   $rgb =  array_map('hexdec', $hex);

   //Check if opacity is set(rgba or rgb)
   if($opacity){
    if(abs($opacity) > 1)
    $opacity = 1.0;
    $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
   } else {
    $output = 'rgb('.implode(",",$rgb).')';
   }

   //Return rgb(a) color string
   return $output;
}

function the_monday_colour_brightness($hex, $percent) {
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    //// CALCULATE 
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}

//Dynamic styles
    function the_monday_dynamic_styles() {

    	$custom_css = '';
        
        $the_monday_header_font_family = get_theme_mod( 'header_fonts', 'Lato' );
        $the_monday_body_font_family = get_theme_mod( 'body_fonts', 'Lato' );
        
        $the_monday_h1font_size = get_theme_mod( 'h1_font_size', '26' );
        $the_monday_h2font_size = get_theme_mod( 'h2_font_size', '24' );
        $the_monday_h3font_size = get_theme_mod( 'h3_font_size', '22' );
        $the_monday_h4font_size = get_theme_mod( 'h4_font_size', '20' );
        $the_monday_h5font_size = get_theme_mod( 'h5_font_size', '18' );
        $the_monday_h6font_size = get_theme_mod( 'h6_font_size', '16' );
        $the_monday_body_size = get_theme_mod( 'body_font_size', '14' );
        $the_monday_section_title_size = get_theme_mod( 'home_section_title_size', '24' );
            
        $custom_css .='#content h2{
            font:700 {$the_monday_section_title_size}px {$the_monday_header_font_family}
            }';

        $custom_css .='h1, h2, h3, h4, h5, h6{
            font-family:{$the_monday_header_font_family}
            }';

        $custom_css .='h1, h1.entry-title{
            font-size: {$the_monday_h1font_size}px
            }';

        $custom_css .='h2{
            font-size: {$the_monday_h2font_size}px
            }';

        $custom_css .="h3, #content .plan h3{ font-size:". esc_attr( $the_monday_h3font_size ) ."px; }"."\n";
        $custom_css .="h4{ font-size:". esc_attr( $the_monday_h4font_size ) ."px; }"."\n";
        $custom_css .="h5, #content .canvas .four-col .col .text-holder h5.canvas-title, .tm-home-section .single-blog-wrapper .home-blog-desc h5.blog-title a{ font-size:". esc_attr( $the_monday_h5font_size ) ."px; }"."\n";
        $custom_css .="h6, #content .specialized-content .info h4{ font-size:". esc_attr( $the_monday_h6font_size ) ."px; }"."\n";
        $custom_css .="body, #content{ font-family:".esc_attr( $the_monday_body_font_family )." }"."\n";
        $custom_css .="#content{font:400 ". esc_attr( $the_monday_body_size ) ."px ".esc_attr( $the_monday_body_font_family )."}"."\n";
        $custom_css .= ".tm-page-container .entry-content p { font-size:".esc_attr( $the_monday_body_size )."px; }"."\n";

        /*Dynamic Color*/
        $the_monday_primary_color = get_theme_mod( 'primary_color', '#2e8ecb' );
            
            $custom_css .= "#content .subscribe form input.newsletter-submit, .tm-home-section .widget_the_monday_call_to_action .cta-wrapper .btn-holder a, .header-image-wrapper .header-img-caption .banner-button-holder a.active, .header-image-wrapper .header-img-caption .banner-button-holder a:hover, .home-blog-read-more a, #secondary.widget-area .search-submit, .newsletter-widget input[type='submit'], .tm-page-container .comment-respond .submit, .tm-page-container .post-navigation .nav-previous a, .tm-page-container .post-navigation .nav-next a{ background:". esc_attr( $the_monday_primary_color ) ."; }"."\n";

            $custom_css .= "#content .subscribe form input.newsletter-submit:hover, .tm-home-section .widget_the_monday_call_to_action .cta-wrapper .btn-holder a:hover, .home-blog-read-more a:hover{ background:". the_monday_colour_brightness( $the_monday_primary_color, '-0.9' ) ."; }"."\n";

            $custom_css .= ".header-image-wrapper .header-img-caption .banner-button-holder a:hover{ border: 3px solid ". esc_attr( $the_monday_primary_color ) ."; }"."\n";

            $custom_css .= ".site-header .head-wrap .home-nav ul > li a:hover:before, .site-header .head-wrap .home-nav ul > li a.active:before { border-top: 1px solid". esc_attr( $the_monday_primary_color ) ."}"."\n";

            $custom_css .= "#content .specialized-content .icon-holder, .tm-home-section .widget_the_monday_call_to_action .cta-wrapper .btn-holder a, .tm-home-section .widget_the_monday_call_to_action .cta-wrapper .btn-holder a:hover, .home-blog-read-more a{ border: 1px solid". esc_attr( $the_monday_primary_color ) ."}"."\n";        

            $custom_css .= ".footer-contact-info a:hover, .footer-contact-info a:hover i.fa{ color:". the_monday_colour_brightness( $the_monday_primary_color, '0.7' ) ."; }"."\n";

            $custom_css .= "#content .about-content a:hover, ul.protfolios-filter li.active a, #content .specialized-content .icon-holder, .tm-home-section .single-blog-wrapper .home-blog-desc h3.blog-title a:hover, .tm-home-section .single-blog-wrapper .home-blog-desc .posted-on a:hover time, .tm-home-section .single-blog-wrapper .home-blog-desc .byline-post-author .vcard a:hover, .tm-home-section .single-blog-wrapper .home-blog-desc .comments-link a:hover, .footer-section .contact-info .icon-holder, a#scroll-up i, .theme-designer-section a:hover, #secondary.widget-area aside ul li:hover, #secondary.widget-area aside ul li:hover a, #secondary.widget-area aside ul li a:hover,
                .error-404 .page-header .page-title,
                .tm-page-container .entry-header h1 a:hover{
                    color:{$the_monday_primary_color};
                }";

            $custom_css .= "#content .about-content a:hover, .site-header .head-wrap .home-nav ul li:hover ul.sub-menu{ border-color:". esc_attr( $the_monday_primary_color ) ."}"."\n";        
            
            //background hex2rgba
            $custom_css .= ".site-header .tm-header-title{ background:". the_monday_hex2rgba( $the_monday_primary_color, '0.8' ) ."; }"."\n";

            //slider button hex2rbga
            $custom_css .= ".header-slider .static-button:hover{ background:". the_monday_hex2rgba( $the_monday_primary_color, '0.38' ) ."; }"."\n";

            //heder title bg color
            $custom_css .= ".tm-innerpage-head-section .tm-header-title{ background:". the_monday_hex2rgba( $the_monday_primary_color, '0.8' ) ."; }"."\n";        

            //background color
            $custom_css .= ".lSSlideOuter .lSPager.lSpg > li:hover a, .lSSlideOuter .lSPager.lSpg > li.active a, .table-tag, .btn-blue { background-color:". esc_attr( $the_monday_primary_color ) ."; }"."\n";

            //background color secondary color
            $custom_css .= ".lSSlideOuter .lSPager.lSpg > li a, .single-price-table-wrapper:hover .table-tag{ background-color:". esc_attr( $the_monday_primary_color ) ." }"."\n";
            
            //border-color
            $custom_css .= ".home-blog-image:hover figure, .single-blog-wrapper:hover:before, .single-blog-wrapper:hover:after, .btn-blue, .wpcf7 input.wpcf7-submit{ border-color:". esc_attr( $the_monday_primary_color ) ."; }"."\n";         

            //border-color 
            $custom_css .= ".single-price-table-wrapper:hover .price-check:before{border-bottom-color:". esc_attr( $the_monday_primary_color ) ."; }"."\n";
            $custom_css .= ".single-price-table-wrapper:hover .price-check:before{border-left-color:". esc_attr( $the_monday_primary_color ) ."; }"."\n";        
            
            //background dark
            $custom_css .= ".btn-blue:hover, .tm-page-container .post-navigation .nav-previous a:hover, .tm-page-container .post-navigation .nav-next a:hover, .tm-page-container .comment-respond .submit:hover, .newsletter-widget input[type='submit']:hover{ background:". the_monday_colour_brightness( $the_monday_primary_color, '-0.9' ) ." }"."\n";

            // Medica Qeuries
            $custom_css .= "
                @media (max-width: 1169px) {
                    .site-header .head-wrap .home-nav ul > li a:hover, .site-header .head-wrap .home-nav ul > li a.active{
                        color: {$the_monday_primary_color} !important;
                    }
                }";

            //Custom css from customizer option
            $the_monday_custom_css_value = get_theme_mod( 'custom_css_textarea', '' );
            
            $custom_css .= $the_monday_custom_css_value;
        
        wp_add_inline_style( 'the-monday-style', $custom_css );
    }
    add_action( 'wp_enqueue_scripts', 'the_monday_dynamic_styles' );

?>