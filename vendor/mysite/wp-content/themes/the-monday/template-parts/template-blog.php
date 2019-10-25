<?php
/**
 * Template Name: Blog Page
 *
 * This is the template that displays all posts .
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package The Monday
 */

get_header(); ?>
<div class="tm-page-container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            
            <?php
                $the_monday_blog_cat_ids = get_theme_mod( 'blog_include_categories', '1' );
                $the_monday_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                $blog_page_args = array(
                                    'cat' => $the_monday_blog_cat_ids,
                                    'paged' => $the_monday_paged
                                );
                $blog_page_query = new WP_Query( $blog_page_args );
                if( $blog_page_query->have_posts() ) {
                    while( $blog_page_query->have_posts() ) {
                        $blog_page_query->the_post();
                        get_template_part( 'template-parts/content', get_post_format() );
                    }

                    $big = 999999999; // need an unlikely integer
                    $the_monday_pagination_args = array(
                        'base'               => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                        'format'             => '?page=%#%',
                        'total'              => $blog_page_query->max_num_pages,
                        'current'            => max( 1, get_query_var('paged') ),
                        'show_all'           => False,
                        'end_size'           => 1,
                        'mid_size'           => 2,
                        'prev_next'          => True,
                        'prev_text'          => __( 'Previous', 'the-monday' ),
                        'next_text'          => __( 'Next', 'the-monday' ),
                        'type'               => 'plain',
                        'add_args'           => False,
                        'add_fragment'       => '',
                        'before_page_number' => '',
                        'after_page_number'  => ''
                    );
            ?>
                    <div class="archive-pagination blog-pagination">
                        <?php echo wp_kses( paginate_links( $the_monday_pagination_args ), array( 'a' => array( 'href' => array(), 'class' => array() ), 'span' => array( 'class' => array() ) ) ); ?>
                    </div>
            <?php
                } else {
                    get_template_part( 'template-parts/content', 'none' );
                }
            ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php the_monday_get_sidebar(); ?>
</div><!--.tm-page-container-->
<?php get_footer(); ?>
