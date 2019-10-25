<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package The Monday
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function the_monday_body_classes( $classes ) {
	
	global $post;

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	/**
     * option for site layout 
     */
    $the_monday_site_layout = get_theme_mod( 'site_layout', 'wide_layout' );
    
    if( !empty( $the_monday_site_layout ) ) {
        $classes[] = $the_monday_site_layout;
    }
    
    /**
     * sidebar option for post/page/archive 
     */
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
                $classes[] = 'right-sidebar';
            } elseif( $post_default_sidebar_layout == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif( $post_default_sidebar_layout == 'no_sidebar_full_width' ) {
                $classes[] = 'no-sidebar';
            } elseif( $post_default_sidebar_layout == 'no_sidebar_content_centered' ) {
                $classes[] = 'no-sidebar-centered';
            }
        } elseif( is_page() ) {
            if( $page_default_sidebar_layout == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif( $page_default_sidebar_layout == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif( $page_default_sidebar_layout == 'no_sidebar_full_width' ) {
                $classes[] = 'no-sidebar';
            } elseif( $page_default_sidebar_layout == 'no_sidebar_content_centered' ) {
                $classes[] = 'no-sidebar-centered';
            }
        } elseif( $archive_default_sidebar_layout == 'right_sidebar' ) {
            $classes[] = 'right-sidebar';
        } elseif( $archive_default_sidebar_layout == 'left_sidebar' ) {
            $classes[] = 'left-sidebar';
        } elseif( $archive_default_sidebar_layout == 'no_sidebar_full_width' ) {
            $classes[] = 'no-sidebar';
        } elseif( $archive_default_sidebar_layout == 'no_sidebar_content_centered' ) {
            $classes[] = 'no-sidebar-centered';
        }
    } elseif( $sidebar_meta_option == 'right_sidebar' ) {
        $classes[] = 'right-sidebar';
    } elseif( $sidebar_meta_option == 'left_sidebar' ) {
        $classes[] = 'left-sidebar';
    } elseif( $sidebar_meta_option == 'no_sidebar_full_width' ) {
        $classes[] = 'no-sidebar';
    } elseif( $sidebar_meta_option == 'no_sidebar_content_centered' ) {
        $classes[] = 'no-sidebar-centered';
    }
    $the_monday_header_type = get_theme_mod( 'front_header_type', 'image' );
    if( is_front_page() ) {
        $classes[] = 'home-header-'.$the_monday_header_type;
    }

	return $classes;
}
add_filter( 'body_class', 'the_monday_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function the_monday_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'the-monday' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'the_monday_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function the_monday_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'the_monday_render_title' );
endif;
