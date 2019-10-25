<?php
/**
 * Custom functions and definitions for The Monday theme
 *
 * @package The Monday
 */
 
/*----------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue script and style for admin 
 * 
 */

add_action( 'admin_enqueue_scripts', 'the_monday_admin_scripts_styles' ); 

if( ! function_exists( 'the_monday_admin_scripts_styles' ) ):
function the_monday_admin_scripts_styles() {
        
    /**
     * Add custom css for admin section
     */
    wp_register_style( 'custom_wp_admin_css', THE_MONDAY_ADMIN_CSS_URL . '/admin-style.css', false, THE_MONDAY_THEME_VERSION );
    wp_register_style( 'jquery-ui-css', THE_MONDAY_ADMIN_CSS_URL . '/jquery-ui-css.css', false, THE_MONDAY_THEME_VERSION );
    wp_enqueue_style( 'custom_wp_admin_css' );
    wp_enqueue_style( 'jquery-ui-css' );
    
    /**
     * Add custom script for admin section
     */    
    wp_enqueue_script( 'custom_wp_admin_script', THE_MONDAY_ADMIN_JS_URL . '/admin-script.js', array(), THE_MONDAY_THEME_VERSION, true );
     
}
endif;

/*---------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles.
 */
  
add_action( 'wp_enqueue_scripts', 'the_monday_scripts_styles' );

if( ! function_exists( 'the_monday_scripts_styles' ) ):
function the_monday_scripts_styles() {
    
    /**
     * Use google fonts 
     */
    $query_args = array(
        'family' => get_theme_mod( 'header_fonts', 'Lato' ).':300,300italic,400,400italic,500,600,700,700italic|'.get_theme_mod( 'body_fonts', 'Lato' ).':300,300italic,400,400italic,500,600,700,700italic',
    );
    wp_enqueue_style( 'google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ) );
    
    wp_enqueue_style( 'lightslider-style', THE_MONDAY_CSS_URL . '/lightslider.css', array(), '1.1.5' ); //bxslider css
	
    wp_enqueue_style( 'font-awesome', THE_MONDAY_CSS_URL . '/font-awesome.css', array(), '4.3.0' ); //Font awesome css

    wp_enqueue_style( 'superslide-css', THE_MONDAY_CSS_URL . '/superslides.css', array(), THE_MONDAY_THEME_VERSION ); //Animate css
	
	wp_enqueue_style( 'animate-css', THE_MONDAY_CSS_URL . '/animate.css', array(), THE_MONDAY_THEME_VERSION ); //Animate css
    
    /**
     * The Monday theme style 
     */
    wp_enqueue_style( 'the-monday-style', get_stylesheet_uri(), array( 'font-awesome' ), THE_MONDAY_THEME_VERSION );

    wp_enqueue_style( 'the-monday-responsive', THE_MONDAY_CSS_URL . '/responsive.css', array(), THE_MONDAY_THEME_VERSION );
    
    wp_enqueue_script( 'isotop-pkgd', THE_MONDAY_JS_URL . '/isotope.pkgd.js', array('jquery'), '2.2.0' );
    
    wp_enqueue_script( 'superslide', THE_MONDAY_JS_URL. '/jquery.superslides.js', array('jquery'), '0.6.3-wip' );

    wp_enqueue_script( 'lightSlider', THE_MONDAY_JS_URL . '/lightslider.js', array(), '1.1.5' );

	wp_enqueue_script( 'imagesloaded-pkgd', THE_MONDAY_JS_URL . '/imagesloaded.pkgd.js', array(), '3.1.8' );
    
    wp_enqueue_script( 'smoothscroll', THE_MONDAY_JS_URL . '/smoothscroll.js', array(), '1.3.8' );
    
    wp_enqueue_script( 'counterup', THE_MONDAY_JS_URL . '/jquery.counterup.js', array('jquery'), '1.0' );
    
    wp_enqueue_script( 'classyloader', THE_MONDAY_JS_URL. '/jquery.classyloader.js', array('jquery') );
    
    wp_enqueue_script( 'waypoints', THE_MONDAY_JS_URL . '/jquery.waypoints.js', array('jquery'), '2.0.5' );
    
    wp_enqueue_script( 'parallax-js', THE_MONDAY_JS_URL . '/parallax.js', array(), '1.1.3' );    

    wp_enqueue_script( 'the-monday-custom-script', THE_MONDAY_JS_URL. '/custom-script.js', array(), THE_MONDAY_THEME_VERSION );
    
    wp_enqueue_script( 'the-monday-navigation', THE_MONDAY_JS_URL . '/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'the-monday-skip-link-focus-fix', THE_MONDAY_JS_URL . '/skip-link-focus-fix.js', array(), '20130115', true );
    
    if ( get_theme_mod( 'the_monday_main_sticky_menu', 'sticky' ) == 'sticky' ) {
        wp_enqueue_script( 'the-monday-sticky-menu', THE_MONDAY_JS_URL. '/sticky/jquery.sticky.js', array( 'jquery' ), '20150309', true );
        wp_enqueue_script( 'the-monday-sticky-menu-setting', THE_MONDAY_JS_URL. '/sticky/sticky-setting.js', array( 'the-monday-sticky-menu' ), THE_MONDAY_THEME_VERSION, true );
   }
   
   if( get_theme_mod( 'single_page_menu_option', 0 ) != 1 && is_front_page() ) {
        wp_enqueue_script( 'jquery-nav', THE_MONDAY_JS_URL . '/singlepagenav/jquery.nav.js', array('jquery'), '2.2.0', true );
        wp_enqueue_script( 'jquery-scrollTojs', THE_MONDAY_JS_URL . '/singlepagenav/jquery.scrollTo.js', array('jquery'), '2.1.1', true );
        wp_enqueue_script( 'the-monday-singlepagenav-setting', THE_MONDAY_JS_URL . '/singlepagenav/nav-settings.js', array( 'jquery-nav', 'jquery-scrollTojs' ), THE_MONDAY_THEME_VERSION, true );
   }

	/**
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;

/*function the_monday_dynamic_styles() {
    wp_enqueue_style( 'the-monday-dynamic-style', THE_MONDAY_CSS_URL . '/styles.php', array(), THE_MONDAY_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'the_monday_dynamic_styles', 15 );*/

/*-------------------------------------------------------------------------------------------------------*/
/**
 * wp_head filter
 */
add_filter( 'wp_head', 'the_monday_wp_head' );

if( !function_exists( 'the_monday_wp_head' ) ):
function the_monday_wp_head() {
    $subscribe_background = get_theme_mod( 'subscribe_background_image', '' );
    if( !empty( $subscribe_background ) && ( get_theme_mod( 'subscribe_section_option', 'enable' ) == 'enable' ) ) {
    ?>
        <style>
            #tm-section-subscribe {
                background: url('<?php echo esc_url( $subscribe_background );?>'); 
                background-attachment:fixed;
                height: 517px;
                background-size: cover;
                background-repeat: no-repeat;
                }
        </style>
    <?php
    }
    $blog_background = get_theme_mod( 'blog_background_image', '' );
    if( !empty( $blog_background ) && ( get_theme_mod( 'blog_section_option', 'enable' ) == 'enable' ) ) {
    ?>
        <style>
            #tm-section-blog {
                background: url('<?php echo esc_url( $blog_background );?>'); 
                background-attachment: fixed;
                background-size: cover;
                background-repeat: no-repeat;
    
            }
        </style>
    <?php    
    }
    $testimonials_background = get_theme_mod( 'testimonials_background_image', '' );
    if( !empty( $testimonials_background ) ) {
    ?>
        <style>
            #tm-section-testimonials {
                background: url('<?php echo esc_url( $testimonials_background );?>'); 
                background-attachment: fixed;
                background-size: cover;
                background-repeat: no-repeat;
    
            }
        </style>
    <?php
    }
}
endif;

/*---------------------------------------------------------------------------------------------*/
/**
 * Change the menu postion in dashboard
 */ 
function the_monday_move_post () {
    global $menu;
    $menu[30] = $menu[25]; //move post from post 5 to 6
    unset($menu[25]); //free the position 5 so you can use it!
}
add_action( 'admin_menu', 'the_monday_move_post' );

/*-------------------------------------------------------------------------------------------------------*/
/**
 * Function define about page/post/archive sidebar
 */
if( ! function_exists( 'the_monday_get_sidebar' ) ):
function the_monday_get_sidebar() {
    global $post;
    if( $post ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'the_monday_page_sidebar', true );
    }
     
    if( is_home() ) {
        $set_id = get_option( 'page_for_posts' );
		$sidebar_meta_option = get_post_meta( $set_id, 'the_monday_page_sidebar', true );
    }
    
    if( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_layout';
    }
    
    $archive_default_sidebar_layout = get_theme_mod( 'the_monday_archive_sidebar', 'right_sidebar' );
    $post_default_sidebar_layout = get_theme_mod( 'the_monday_post_sidebar', 'right_sidebar' );
    $page_default_sidebar_layout = get_theme_mod( 'the_monday_page_sidebar', 'right_sidebar' );
    
    if( $sidebar_meta_option == 'default_layout' ) {
        if( is_single() ) {
            if( $post_default_sidebar_layout == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $post_default_sidebar_layout == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( is_page() ) {
            if( $page_default_sidebar_layout == 'right_sidebar' ) {
                get_sidebar();
            } elseif( $page_default_sidebar_layout == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif( $archive_default_sidebar_layout == 'right_sidebar' ) {
            get_sidebar();
        } elseif( $archive_default_sidebar_layout == 'left_sidebar' ) {
            get_sidebar( 'left' );
        }
    } elseif( $sidebar_meta_option == 'right_sidebar' ) {
        get_sidebar();
    } elseif( $sidebar_meta_option == 'left_sidebar' ) {
        get_sidebar( 'left' );
    }
}
endif;

/*-----------------------------------------------------------------------------------------------*/
/**
 * Describe function to popluate section menu
 */

add_action( 'the_monday_single_page_menu', 'the_monday_single_page_menu_define', 10 );

if( !function_exists( 'the_monday_single_page_menu_define' ) ):
    function the_monday_single_page_menu_define() {
        $home_tab_option = get_theme_mod( 'single_page_menu_home_option', '' );
        $home_tab_text = get_theme_mod( 'single_menu_home_text', __( 'Home', 'the-monday' ) );
?>  
    <div class="primary-menu-container">
        <ul>
            <?php if( $home_tab_option !=1 ) { ?>
                <li id="home-menu-text"><a href="<?php echo esc_url( home_url() ); ?>/#tm-section-mainslider" ><?php echo esc_attr( $home_tab_text ); ?></a></li>
            <?php } ?>
            <?php
                $sections = array( 'about', 'services', 'featured_product', 'subscribe', 'team', 'testimonials', 'portfolio', 'skill', 'clients', 'blog', 'price_tables', 'footer_contact' );
                $default_menu_tab = array( 
                                    'about' => 'About',
                                    'services' => 'Services', 
                                    'featured_product' => '', 
                                    'subscribe' => '', 
                                    'team' => '', 
                                    'testimonials' => '', 
                                    'portfolio' => 'Portfolio', 
                                    'skill' => '', 
                                    'clients' => 'Clients', 
                                    'blog' => 'Blog', 
                                    'price_tables' => '', 
                                    'footer_contact' => 'Contact'
                                        );
                foreach( $sections as $section ) {
                    $section_option = get_theme_mod( $section.'_section_option', 'enable' );
                    $menu_tab_text = get_theme_mod( $section . '_section_menu_title', $default_menu_tab[$section] );
                        if( $section_option == 'enable' && !empty( $menu_tab_text ) ) {
                                $menu_tab = '';
                                $menu_tab .= '<li id="'. $section .'-menu-text">';
                                $menu_tab .= '<a href="'. esc_url( home_url() ) .'/#tm-section-'. $section .'">'. esc_attr( $menu_tab_text ) .'</a>';
                                $menu_tab .= '</li>';
                                echo  $menu_tab;
                        }
              }
            ?>
        </ul>
    </div>
<?php
    }
endif;

/*---------------------------------------------------------------------------------------------*/
/**
 * Get attachement id from url
 */
function the_monday_get_attachment_id_from_url( $attachment_url = '' ) {
 
    global $wpdb;
    $attachment_id = false;
 
    // If there is no url, return.
    if ( '' == $attachment_url )
        return;
 
    // Get the upload directory paths
    $upload_dir_paths = wp_upload_dir();
 
    // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
        // If this is the URL of an auto-generated thumbnail, get the URL of the original image
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
        // Remove the upload path base directory from the attachment URL
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
        // Finally, run a custom database query to get the attachment ID from the modified attachment URL
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
    }
 
    return $attachment_id;
}

/*--------------------------------------------------------------------------------------------------------*/
/**
 * Define default option for themes
 */
 $the_monday_default_posts_per_page = get_option( 'posts_per_page' );

/*----------------------------------------------------------------------------------------------------------*/
/**
 * get rid category from archive title
 */
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        }
    return $title;
});

/*--------------------------------------------------------------------------------------------------------*/
/**
 * innerpage head title section
 */
if( !function_exists( 'the_monday_innerpage_title_section' ) ):
    function the_monday_innerpage_title_section() {
?>
    <div class="tm-header-title">
    <?php if( is_page() ) { ?>
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
    <?php } elseif ( is_archive() ) { ?>
        <header class="page-header">
            <?php
                the_archive_title( '<h1 class="page-title archive-title">', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">', '</div>' );            
            ?>
        </header><!-- .page-header -->
    <?php } elseif ( is_single() ) {
            if ( get_post_type() == 'post' ) {
                $post_category = get_the_category();
                $cat_name = $post_category[0]->cat_name;
                $cat_desc = $post_category[0]->category_description;
    ?>
            <div class="post-cat-info">
                <div class="post-cat-name"><h1 class="page-title archive-title"><?php echo $cat_name; ?></h1></div>
                <div class="post-cat-desc"><div class="taxonomy-description"><?php echo $cat_desc; ?></div></div>
            </div>
    <?php
            }
        } elseif( is_404() ) {
            echo '<h1 class="page-title archive-title">'. __( '404', 'the-monday' ) .'</h1>';
        } elseif( is_search() ) {
    ?>
            <header class="page-header">
                <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'the-monday' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            </header><!-- .page-header -->
    <?php
        }
    ?>
        <?php if(  get_theme_mod( 'the_monday_breadcrumbs_option', 'yes' ) == 'yes' ) { ?>
        <div class="tm-breadcrumbs-area">
            <?php the_monday_breadcrumbs(); ?>
        </div>
        <?php } ?>
    </div>
<?php
    }
endif;

/*------------------------------------------------------------------------------------------------------*/
/**
 * Excerpt Word Length
 */
if( !function_exists( 'the_monday_excerpt_word' ) ):
    function the_monday_excerpt_word( $content, $limit ) {
        $string = force_balance_tags( $content );
        $strip_string = strip_shortcodes( $string );
        $words = explode( ' ', $strip_string );    
        $excerpt_word = implode( ' ', array_slice( $words, 0, $limit ) );
        return $excerpt_word;
    }
endif;

/*------------------------------------------------------------------------------------------------------*/
/**
 * Changed comment form title
 */

add_filter( 'comment_form_defaults', 'the_monday_comment_title_next' );

function the_monday_comment_title_next( $defaults ) {
    $defaults['title_reply'] = __( 'Join the Conversation', 'the-monday' );
    $defaults['title_reply_to'] =  __( 'Join the Conversation', 'the-monday' );
    return $defaults;
}

/**
 * Registers an editor stylesheet for the theme.
 */
function the_monday_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'the_monday_add_editor_styles' );