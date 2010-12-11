<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

				<?php the_post(); ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: <span>%s</span>', 'toolbox' ), get_the_date() ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: <span>%s</span>', 'toolbox' ), get_the_date( 'F Y' ) ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: <span>%s</span>', 'toolbox' ), get_the_date( 'Y' ) ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'toolbox' ); ?>
						<?php endif; ?>
					</h1>
				</header>

				<?php rewind_posts(); ?>

				<?php get_template_part( 'loop', 'archive' ); ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>