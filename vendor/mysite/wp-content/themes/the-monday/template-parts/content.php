<?php
/**
 * Template part for displaying posts.
 *
 * @package The Monday
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		$image_id = get_post_thumbnail_id();
		$image_path = wp_get_attachment_image_src( $image_id, 'the-monday-classic-blog-thumb', true );
		$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	?>
		<div class="post-image-wrapper">
			<figure> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" />
			</a></figure>
		</div>
	
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php the_monday_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<div class="category-content">
			<?php
    			$get_post_content = get_the_content();
                $excerpt_length = get_theme_mod( 'excerpt_word_length', '150' );
                $post_content = the_monday_excerpt_word( $get_post_content, $excerpt_length );
                echo '<p>'. esc_html($post_content) .'</p>';
    		?>
		</div>
		<?php the_monday_post_tags(); ?>
		<a href="<?php the_permalink(); ?>" class="btn btn-blue"><?php echo esc_attr ( get_theme_mod( 'archive_read_more_btn_text', __( 'Read More', 'the-monday' ) ) ); ?></a>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-monday' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php the_monday_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
