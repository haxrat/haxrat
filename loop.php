<?php
/**
 * @package WordPress
 * @subpackage Haxrat
 */
?>
<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '点击阅读全文', 'haxrat' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<div class="entry-meta">
				<?php time_ago(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
	
		<div class="entry-summary">
			<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'toolbox' ) ); ?>
		</div><!-- .entry-summary -->
		
		<footer class="entry-meta">
			<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', 'toolbox' ); ?></span><?php the_category( ', ' ); ?></span>
			<span class="sep"> | </span>
			<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'toolbox' ) . '</span>', ', ', '<span class="sep"> | </span>' ); ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'toolbox' ), __( '1 Comment', 'toolbox' ), __( '% Comments', 'toolbox' ) ); ?></span>
			<?php edit_post_link( __( 'Edit', 'toolbox' ), '<span class="sep">|</span> <span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php comments_template( '', true ); ?>

<?php endwhile; ?>

<?php if (function_exists("pagination")) { 
	pagination($additional_loop->max_num_pages);
} ?>

