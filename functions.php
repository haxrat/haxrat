<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 * If you're building a theme based on toolbox, use a find and replace
 * to change 'toolbox' to the name of your theme in all the template files
 */
load_theme_textdomain( 'toolbox', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * This theme uses wp_nav_menu() in one location.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'toolbox' ),
) );

/**
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function toolbox_page_menu_args($args) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'toolbox_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function toolbox_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar 1', 'toolbox' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array (
		'name' => __( 'Sidebar 2', 'toolbox' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional second sidebar area', 'toolbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );	
}
add_action( 'init', 'toolbox_widgets_init' );

#delete above


function haxrat_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'haxrat_setup' );



/**
 * Tags as meta keywords
 **/
function meta_keywords() {
	$posttags = get_the_tags();
	foreach((array)$posttags as $tag) {
			$meta_keywords .= $tag->name . ',';
	}
	return substr($meta_keywords,0,-1);
}

/**
 * Title optimize
 */
function seo_title() {
	global $page, $paged;
    $sep = " - "; # delimiter
    $newtitle = get_bloginfo('name'); # default title

    # Single & Page 
    if (is_single() || is_page())
        $newtitle = single_post_title("", false);

    # Category 
    if (is_category())
        $newtitle = single_cat_title("", false);

    # Tag 
    if (is_tag())
     $newtitle = single_tag_title("", false);

    # Search result 
    if (is_search())
     $newtitle = "Search Result " . $s;

    # Taxonomy 
    if (is_tax()) {
        $curr_tax = get_taxonomy(get_query_var('taxonomy'));
        $curr_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); # current term data
        # if it's term
        if (!empty($curr_term)) {
            $newtitle = $curr_tax->label . $sep . $curr_term->name;
        } else {
            $newtitle = $curr_tax->label;
        }
    }

    # Page number
    if ($paged >= 2 || $page >= 2)
            $newtitle .= $sep . sprintf('第%页', max($paged, $page));

    # Home & Front Page ########################################
    if (is_home() || is_front_page()) {
        $newtitle = get_bloginfo('name') . $sep . get_bloginfo('description');
    } else {
        $newtitle .=  $sep . get_bloginfo('name');
    }
	return $newtitle;
}
add_filter('wp_title', 'seo_title');

function post_ago() {
	$diff = (current_time('timestamp') - get_the_time('U'));
	if ( $diff > 86400)
	printf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
               get_permalink(),
               esc_attr( get_the_time() ),
               get_the_date()
               );
		else
	echo '发布于' . human_time_diff(get_the_time('U'),current_time('timestamp')) . '前';
}

/*
 * Better Pagination
 */
function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}
