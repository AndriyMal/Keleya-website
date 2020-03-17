<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package keleya
 */

?>
<style>
    .meta-info {
        text-align: center; }
    .meta-info > * {
        padding: 0 .75rem; }
    .meta-info .author {
        color: #69C0BA;
        border-right: 1px solid #4a4a4a; }
</style>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header content">

<!--		--><?php
//		if ( is_singular() ) :
//			the_title( '<h1 class="entry-title has-text-centered">', '</h1>' );
//		else :
//			the_title( '<h2 class="entry-title has-text-centered"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
//		endif;
//
//		?>

        <h3 class="has-text-centered"><?php the_field('subtitle') ?></h3>

        <div class="meta-info">
            <span class="author">
                            <?php echo get_the_author_link(); ?>
            </span>
            <span class="date">
                <?php the_date('d.m.y') ?>
            </span>
        </div>

	</header><!-- .entry-header -->

	<?php keleya_post_thumbnail(); ?>

	<div class="entry-content content" id="post-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'keleya' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'keleya' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php keleya_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
