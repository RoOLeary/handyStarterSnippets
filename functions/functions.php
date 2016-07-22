<?php
/**
 * blueprint functions and definitions
 *
 * @package blueprint
 */

/*-------------------------------------------------------------------------------------------*/
/* Add global options page (ACF)
/*-------------------------------------------------------------------------------------------*/



if( function_exists('acf_add_options_page')){

	acf_add_options_page(array(
		'page_title'	=> 	'Site Config',
		'menu_title'	=> 	'Site Config',
		'menu_slug'		=> 	'theme-options',
		'capability'	=> 	'edit_posts',
		'parent_slug'	=>	'',
		'position'		=>	1,
		'icon_url'		=>	false,
		'redirect'		=>	false

	)); 	

}


/*===================================================================================
* Add Required Plugins Functionality
* =================================================================================*/

require_once get_template_directory() . '/req_plugins.php';


/*-------------------------------------------------------------------------------------------*/
/* blueprint Theme Setup
/*-------------------------------------------------------------------------------------------*/


if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}


if ( ! function_exists( 'blueprint_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blueprint_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */

	load_theme_textdomain( 'blueprint', get_template_directory() . '/languages' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */

	add_theme_support( 'post-thumbnails' );
	add_image_size( 'blog-thumb', 100, 100, array( 'center', 'center' ) );
	add_image_size( 'blog-feat', 730, 350, array( 'center', 'center' ) );
	add_image_size( 'index-thumb', 300, 300, array( 'center', 'center' ) );
	add_image_size( 'testimonial', 800, 500, array( 'center', 'center' ) );

	// This theme uses wp_nav_menu() in one location.

	register_nav_menus(
        array(
            'primary' => 'Primary Menu',
			'footer1' => 'Footer Information Menu',
			'footer2' => 'Footer Tracks Menu',
			'footer3' => 'Footer Network Menu',
			'footer4' => 'Footer Startups Menu',
			'footer5' => 'Footer Social Menu',
         )
    );


	//*-------------------------------------------------------------------------------------------*/
	/* Custom Walker to enable dropdown menu correct styles
	/*-------------------------------------------------------------------------------------------*/
	class menuWalker extends Walker_Nav_Menu {
	  function start_lvl(&$output, $depth) {
	    $indent = str_repeat("\t", $depth);
	    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	  }
	  function end_lvl(&$output, $depth) {
	    $indent = str_repeat("\t", $depth);
	    $output .= "$indent</ul>\n";
	  }
	}
	/*-------------------------------------------------------------------------------------------*/
	/*  Enable Active CLass on Menu remove the shite
	/*-------------------------------------------------------------------------------------------*/
	function custom_wp_nav_menu($var) {
	        return is_array($var) ? array_intersect($var, array(
                //List of allowed menu classes
                'current_page_item',
                'current_page_parent',
                'current_page_ancestor',
                'first',
                'last',
                'vertical',
                'horizontal',
                'dropdown'
                )
	        ) : '';
	}
	add_filter('nav_menu_css_class', 'custom_wp_nav_menu');
	add_filter('nav_menu_item_id', 'custom_wp_nav_menu');
	add_filter('page_css_class', 'custom_wp_nav_menu');
	 
	//Replaces "current-menu-item" with "active"
	function current_to_active($text){
	        $replace = array(
	                //List of menu item classes that should be changed to "active"
	                'current-menu-item' => 'active',
	                'current_page_item' => 'active',
	                'current_page_parent' => 'active',
	                'current_page_ancestor' => 'active',
	        );
	        $text = str_replace(array_keys($replace), $replace, $text);
	                return $text;
	        }
	add_filter('nav_menu_css_class', 'current_to_active');
	add_filter('nav_menu_item_id', 'current_to_active');


	/*-------------------------------------------------------------------------------------------*/
	/*  Enable Additional Theme Support
	/*-------------------------------------------------------------------------------------------*/

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*-------------------------------------------------------------------------------------------*/
	/*  Enable Post Format Support
	/*-------------------------------------------------------------------------------------------*/

	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

}

endif;

add_action( 'after_setup_theme', 'blueprint_setup' );

/*-------------------------------------------------------------------------------------------*/
/* Remove WP version number from header
/*-------------------------------------------------------------------------------------------*/

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'check_and_publish_future_post');
remove_action('wp_head', 'wp_print_styles');

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/*===================================================================================
* Disbale XMLRPC
* =================================================================================*/

add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'rsd_link');


/*-------------------------------------------------------------------------------------------*/
/* Add cusotm styles to wysiwyg editor
/*-------------------------------------------------------------------------------------------*/


function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}

add_filter('mce_buttons_2', 'wpb_mce_buttons_2');


/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats( $init_array ) {

// Define the style_formats array

	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title' => 'Lead',
			'selector' => 'p',
			'classes' => 'lead',
			'wrapper' => true,

		),
		array(
			'title' => 'TabFix',
			'selector' => 'p',
			'classes' => 'tab-fix',
			'wrapper' => true,

		)
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

/*-------------------------------------------------------------------------------------------*/
/* Queue async page load.
/*-------------------------------------------------------------------------------------------*/

function blueprint_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async"; 
    }
add_filter( 'clean_url', 'blueprint_async_scripts', 11, 1 );

/*-------------------------------------------------------------------------------------------*/
/* Enqueue theme scripts and styles.
/*-------------------------------------------------------------------------------------------*/

function blueprint_scripts() {

	wp_enqueue_style( 'blueprint', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css'));
	wp_enqueue_style( 'fs', get_stylesheet_directory_uri() . '/styles/formstack-hacks.css', array(),  false, false );
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css', array(), '4.6.1' );
	
	// /* Scripts */
	wp_enqueue_script( 'bp-main', get_template_directory_uri() . '/scripts/bp-main.js', array(), filemtime( get_stylesheet_directory() . '/scripts/bp-main.js' ) , true );
 	wp_enqueue_script( 'blueprint', get_template_directory_uri() . '/scripts/blueprint.min.js', array(), filemtime( get_template_directory() . '/scripts/blueprint.min.js' ) , true );
 	wp_enqueue_script( 'counterup', get_template_directory_uri() . '/scripts/jquery.counterup.js', array(), filemtime( get_template_directory() . '/scripts/jquery.counterup.js' ) , true );
  	wp_enqueue_script( 'handlebars', get_template_directory_uri() . '/scripts/handlebars.js', array(), filemtime( get_template_directory() . '/scripts/handlebars.js' ) , true );
	wp_enqueue_script( 'api-helper', get_template_directory_uri() . '/scripts/api-helper.js', array(), filemtime( get_template_directory() . '/scripts/api-helper.js' ) , true );
  	
  	

  	if(is_page('tickets')){
		// Load only on tickets page - pricing script
  		wp_enqueue_script( 'curry', get_stylesheet_directory_uri() . '/scripts/curry.js', array(), filemtime( get_stylesheet_directory() . '/scripts/curry.js' ) , true );
    	wp_enqueue_script( 'pricing', get_stylesheet_directory_uri() . '/scripts/pricing.js#asyncload', array(), filemtime( get_stylesheet_directory() . '/scripts/pricing.js' ) , true );
    	wp_enqueue_style( 'pricing-styles', get_stylesheet_directory_uri() . '/styles/pricing.css', array(),  false, false );
  	}

  	// Load only on "Reviews page"
	if(is_page('reviews')){
	    // scripts
	    wp_enqueue_script( 'twitter', get_stylesheet_directory_uri() . '/scripts/lib/twitterFetcher.js', array(), filemtime( get_stylesheet_directory() . '/scripts/lib/twitterFetcher.js' ) , true );
	    wp_enqueue_script( 'cilabs-twitter', get_stylesheet_directory_uri() . '/scripts/cilabs-twitter.js', array(), filemtime( get_stylesheet_directory() . '/scripts/cilabs-twitter.js' ) , true );
	    wp_enqueue_script( 'reviews-modernizr', get_stylesheet_directory_uri() . '/scripts/lib/modernizr.custom.js', array(), filemtime( get_stylesheet_directory() . '/scripts/ib/modernizr.custom.js' ) , false );
	    wp_enqueue_script( 'rotator', get_stylesheet_directory_uri() . '/scripts/lib/jquery.cbpQTRotator.js', array(), filemtime( get_stylesheet_directory() . '/scripts/lib/jquery.cbpQTRotator.js' ) , true );
	    // styles
	    wp_enqueue_style( 'cilabs-twitter-styles', get_stylesheet_directory_uri() . '/styles/cilabs-twitter.css', array(),  false, false );
	    wp_enqueue_style( 'quote-slider-styles', get_stylesheet_directory_uri() . '/styles/quotes/component.css', array(),  false, false );
	    wp_enqueue_style( 'quote-slider-default', get_stylesheet_directory_uri() . '/styles/quotes/default.css', array(),  false, false );
	}
    
}

add_action( 'wp_enqueue_scripts', 'blueprint_scripts', 11);

/*===================================================================================
* Require Custom Post Types
* =================================================================================*/


require get_template_directory() . '/cpt/cpt-hotels.php';

require get_template_directory() . '/cpt/cpt-tickets.php';

require get_template_directory() . '/cpt/cpt-faq.php';

require get_template_directory() . '/cpt/cpt-partners.php';

require get_template_directory() . '/cpt/cpt-reviews.php';


/*===================================================================================
* Remove automatic p tags in text editor
* =================================================================================*/

if(!is_single()){
	remove_filter ('the_content',  'wpautop');
};

/*===================================================================================
 * Add Author Links
 * =================================================================================*/

function add_to_author_profile( $contactmethods ) {

	$contactmethods['rss_url'] = 'RSS URL';
	$contactmethods['google_profile'] = 'Google Profile URL';
	$contactmethods['twitter_profile'] = 'Twitter Profile URL';
	$contactmethods['facebook_profile'] = 'Facebook Profile URL';
	$contactmethods['linkedin_profile'] = 'Linkedin Profile URL';

	return $contactmethods;
}

add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);


/*===================================================================================
 * Limit Excerpt Length
 * =================================================================================*/

function custom_excerpt_length( $length ) {
 	return 50;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/*===================================================================================
 * Check for last post on blog index
 * =================================================================================*/

function is_last_post($rel_query) {
    $post_current = $rel_query->current_post + 1;
    $post_count = $rel_query->post_count;
    if ( $post_current == $post_count ) {
        return true;
    } else {
        return false;
    }
}

/*===================================================================================
 * Function to check for posts by popularity
 * =================================================================================*/

function observePostViews($postID) {
	$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		} else {
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
}

function fetchPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 View";
		}
		return $count.' Views';
}



/*===================================================================================
* Remove WP-admin bar for logged in Users
* =================================================================================*/

add_filter('show_admin_bar', '__return_false');

/*===================================================================================
 * Remove WP autop in ACF
 * =================================================================================*/

remove_filter( 'acf_the_content', 'wpautop' );


/*===================================================================================
* Remove 'page' from pagination query - posts (news)
* =================================================================================*/

function remove_page_from_query_string($query_string){
	if ($query_string['name'] == 'page' && isset($query_string['page'])) {
	unset($query_string['name']);
	// 'page' in the query_string looks like '/2', so i'm spliting it out
	list($delim, $page_index) = split('/', $query_string['page']);
	$query_string['paged'] = $page_index;
	}
	return $query_string;
}
// I will kill you if you remove this. Took fucking ages to get this hook to play nicely!
add_filter('request', 'remove_page_from_query_string');


/*===================================================================================
* Allow SVG as image type in Media Uploader.
* =================================================================================*/

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


/*===================================================================================
 * Customise Login Logo & link to main website
 * =================================================================================*/

function customise_login_image() { ?>

  <style type="text/css">
    body.login #login h1 a {
      background: url('wp-content/themes/blueprint/images/branding/websummit/login-logo.png') 8px 0 no-repeat transparent;
      background-position: center;
      height:100px;
      width:320px; }
    </style>
<?php }

add_action("login_head", "customise_login_image");

