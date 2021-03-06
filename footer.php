<?php
/**
 * @package WordPress
 * @subpackage Haxrat
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
			<div id="site-generator">
				<a href="http://wordpress.org/" rel="generator">Proudly powered by WordPress</a><span class="sep"> | </span><?php printf( __( 'Theme: %1$s by %2$s.', 'toolbox' ), 'Toolbox', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='<?php echo get_template_directory_uri(); ?>/js/libs/jquery-1.6.1.min.js'>\x3C/script>")</script>
<script src="<?php bloginfo( 'template_directory' ); ?>/js/script.js"></script>
<?php wp_footer(); ?>

</body>
</html>
