<?php
/**
 * Taskerrz functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Taskerrz
 * @since Taskerrz 
 */

	session_start();

	function PricerrTheme_load_textdomain() 
	{
		$locale = apply_filters( 'theme_locale', get_locale(), "PricerrTheme" );
		load_textdomain( "PricerrTheme", TEMPLATEPATH .'/languages/'.$locale.".mo" );
	}
	
	PricerrTheme_load_textdomain();
	
	
	//----------------------------------------------
	global $width_widget_categories, $height_widget_categories;
	$width_widget_categories = 190;
	$height_widget_categories = 65;
	
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'my_category_image_thing', $width_widget_categories, $height_widget_categories, true ); //category images in the widget
	add_image_size( 'thumb_picture_size', 155, 115, true ); //grid view image
	add_image_size( 'my_small_thumbnail_pricerr', 62, 50, true ); //grid view image
	
	//-----------------------------------------------
	
	DEFINE("PRICERRTHEME_VERSION", "2.0.4");
	DEFINE("PRICERRTHEME_RELEASE", "10 October 2013");

	global $default_search;
	$default_search = __("Begin to search by typing here...",'PricerrTheme');
	
	global $allowed_files_in_conversation;
	$allowed_files_in_conversation = array('zip','rar','jpg','png', 'psd', 'gif','jpeg');
	
	global $current_theme_locale_name;	
	$current_theme_locale_name = 'PricerrTheme';

	global $jobs_url_thing;
	$jobs_url_thing = "jobs";
	
	global $default_search;
	$default_search = __("Begin to search by typing here...",'PricerrTheme');
	
//------------------------------------------------------------------
	
	/*include 'lib/first_run.php';
	include 'lib/blog_posts.php';
	include 'lib/admin_menu.php';
	include 'lib/post_new.php';
	include 'lib/pay_for_job.php';
	include 'lib/login_register/custom2.php';
	include 'lib/my_account/my_account.php';
	include 'lib/my_account/payments.php';
	include 'lib/my_account/shopping.php';
	include 'lib/my_account/sales.php';
	include 'lib/my_account/private_messages.php';
	include 'lib/my_account/personal_info.php';
	include 'lib/my_account/reviews.php';
	include 'lib/cronjob.php';
	include 'lib/all_categories.php';
	include 'lib/all_locations.php';
	
	include 'lib/widgets/browse-by-category.php';
	include 'lib/widgets/browse-by-location.php';
	include 'lib/widgets/latest-posted-jobs.php';
	include 'lib/widgets/latest-featured-jobs.php';
	include 'lib/widgets/request-widget.php';
	include 'lib/widgets/category-with-images.php';
	
	//include 'lib/social/social.php';
	include 'classes/ip2locationlite.class.php';*/


	// Advance search options

	include 'advanced_search.php';
	include 'autosuggest.php';
	add_action('the_content', 'PricerrTheme_display_adv_src_pg');

	// Advance search end
//-----------------------------------------------------------------

	// add_action('admin_menu', 					'PricerrTheme_admin_menu');
	// add_action('admin_head', 					'PricerrTheme_admin_stylesheet');
	add_action('init',							'PricerrTheme_create_post_type');
	add_filter('wp_mail_from', 					'PricerrTheme_mail_from');
	add_filter('wp_mail_from_name', 			'PricerrTheme_mail_from_name');
	add_action('the_content', 					'PricerrTheme_display_post_new_pg');
	add_action('the_content', 					'PricerrTheme_display_my_account_pg');
	add_action('the_content', 					'PricerrTheme_display_my_account_payments_pg');
	add_action('the_content', 					'PricerrTheme_display_my_account_shopping_pg');
	add_action('the_content', 					'PricerrTheme_display_my_account_sales_pg');
	add_action('the_content', 					'PricerrTheme_display_all_cats_pg');
	add_action('the_content', 					'PricerrTheme_display_all_locs_pg');
	add_action('the_content', 					'PricerrTheme_display_my_account_priv_mess_pg');
	add_action('the_content', 					'PricerrTheme_display_my_account_pers_info_pg');
	add_action('the_content', 					'PricerrTheme_display_my_account_reviews_pg');	
	//add_action('the_content', 					'PricerrTheme_display_blog_posts_pg');	
	add_action('the_content', 					'PricerrTheme_display_pay_for_job_pg');	
	//add_action('wp_head',						'PricerrTheme_custom_css_thing');
	//add_filter('template_redirect',				'PricerrTheme_template_redirect');
	add_action('widgets_init',	 				'PricerrTheme_framework_init_widgets' );
	add_action("manage_posts_custom_column", 	"PricerrTheme_my_custom_columns");
	add_filter("manage_edit-job_columns", 		"PricerrTheme_my_jobs_columns");
	add_action('save_post',						'PricerrTheme_save_custom_fields');
	add_action('generate_rewrite_rules', 		'PricerrTheme_rewrite_rules' );
	add_action('query_vars', 					'PricerrTheme_add_query_vars'); 
	add_action('draft_to_publish', 				'PricerrTheme_run_when_post_published',10,1);
	add_action('admin_notices', 				'PricerrTheme_admin_notices');
	add_action('init', 							'PricerrTheme_register_my_menus' );
	add_action('wp_enqueue_scripts', 			'PricerrTheme_add_theme_styles');
	add_filter('request', 						'PricerrTheme__myfeed_request');

//-------------------------------------------------
/*************************************************************
*
*	ClassifiedTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_containsTLD($string) {
  preg_match(
    "/(AC($|\/)|\.AD($|\/)|\.AE($|\/)|\.AERO($|\/)|\.AF($|\/)|\.AG($|\/)|\.AI($|\/)|\.AL($|\/)|\.AM($|\/)|\.AN($|\/)|\.AO($|\/)|\.AQ($|\/)|\.AR($|\/)|\.ARPA($|\/)|\.AS($|\/)|\.ASIA($|\/)|\.AT($|\/)|\.AU($|\/)|\.AW($|\/)|\.AX($|\/)|\.AZ($|\/)|\.BA($|\/)|\.BB($|\/)|\.BD($|\/)|\.BE($|\/)|\.BF($|\/)|\.BG($|\/)|\.BH($|\/)|\.BI($|\/)|\.BIZ($|\/)|\.BJ($|\/)|\.BM($|\/)|\.BN($|\/)|\.BO($|\/)|\.BR($|\/)|\.BS($|\/)|\.BT($|\/)|\.BV($|\/)|\.BW($|\/)|\.BY($|\/)|\.BZ($|\/)|\.CA($|\/)|\.CAT($|\/)|\.CC($|\/)|\.CD($|\/)|\.CF($|\/)|\.CG($|\/)|\.CH($|\/)|\.CI($|\/)|\.CK($|\/)|\.CL($|\/)|\.CM($|\/)|\.CN($|\/)|\.CO($|\/)|\.COM($|\/)|\.COOP($|\/)|\.CR($|\/)|\.CU($|\/)|\.CV($|\/)|\.CX($|\/)|\.CY($|\/)|\.CZ($|\/)|\.DE($|\/)|\.DJ($|\/)|\.DK($|\/)|\.DM($|\/)|\.DO($|\/)|\.DZ($|\/)|\.EC($|\/)|\.EDU($|\/)|\.EE($|\/)|\.EG($|\/)|\.ER($|\/)|\.ES($|\/)|\.ET($|\/)|\.EU($|\/)|\.FI($|\/)|\.FJ($|\/)|\.FK($|\/)|\.FM($|\/)|\.FO($|\/)|\.FR($|\/)|\.GA($|\/)|\.GB($|\/)|\.GD($|\/)|\.GE($|\/)|\.GF($|\/)|\.GG($|\/)|\.GH($|\/)|\.GI($|\/)|\.GL($|\/)|\.GM($|\/)|\.GN($|\/)|\.GOV($|\/)|\.GP($|\/)|\.GQ($|\/)|\.GR($|\/)|\.GS($|\/)|\.GT($|\/)|\.GU($|\/)|\.GW($|\/)|\.GY($|\/)|\.HK($|\/)|\.HM($|\/)|\.HN($|\/)|\.HR($|\/)|\.HT($|\/)|\.HU($|\/)|\.ID($|\/)|\.IE($|\/)|\.IL($|\/)|\.IM($|\/)|\.IN($|\/)|\.INFO($|\/)|\.INT($|\/)|\.IO($|\/)|\.IQ($|\/)|\.IR($|\/)|\.IS($|\/)|\.IT($|\/)|\.JE($|\/)|\.JM($|\/)|\.JO($|\/)|\.JOBS($|\/)|\.JP($|\/)|\.KE($|\/)|\.KG($|\/)|\.KH($|\/)|\.KI($|\/)|\.KM($|\/)|\.KN($|\/)|\.KP($|\/)|\.KR($|\/)|\.KW($|\/)|\.KY($|\/)|\.KZ($|\/)|\.LA($|\/)|\.LB($|\/)|\.LC($|\/)|\.LI($|\/)|\.LK($|\/)|\.LR($|\/)|\.LS($|\/)|\.LT($|\/)|\.LU($|\/)|\.LV($|\/)|\.LY($|\/)|\.MA($|\/)|\.MC($|\/)|\.MD($|\/)|\.ME($|\/)|\.MG($|\/)|\.MH($|\/)|\.MIL($|\/)|\.MK($|\/)|\.ML($|\/)|\.MM($|\/)|\.MN($|\/)|\.MO($|\/)|\.MOBI($|\/)|\.MP($|\/)|\.MQ($|\/)|\.MR($|\/)|\.MS($|\/)|\.MT($|\/)|\.MU($|\/)|\.MUSEUM($|\/)|\.MV($|\/)|\.MW($|\/)|\.MX($|\/)|\.MY($|\/)|\.MZ($|\/)|\.NA($|\/)|\.NAME($|\/)|\.NC($|\/)|\.NE($|\/)|\.NET($|\/)|\.NF($|\/)|\.NG($|\/)|\.NI($|\/)|\.NL($|\/)|\.NO($|\/)|\.NP($|\/)|\.NR($|\/)|\.NU($|\/)|\.NZ($|\/)|\.OM($|\/)|\.ORG($|\/)|\.PA($|\/)|\.PE($|\/)|\.PF($|\/)|\.PG($|\/)|\.PH($|\/)|\.PK($|\/)|\.PL($|\/)|\.PM($|\/)|\.PN($|\/)|\.PR($|\/)|\.PRO($|\/)|\.PS($|\/)|\.PT($|\/)|\.PW($|\/)|\.PY($|\/)|\.QA($|\/)|\.RE($|\/)|\.RO($|\/)|\.RS($|\/)|\.RU($|\/)|\.RW($|\/)|\.SA($|\/)|\.SB($|\/)|\.SC($|\/)|\.SD($|\/)|\.SE($|\/)|\.SG($|\/)|\.SH($|\/)|\.SI($|\/)|\.SJ($|\/)|\.SK($|\/)|\.SL($|\/)|\.SM($|\/)|\.SN($|\/)|\.SO($|\/)|\.SR($|\/)|\.ST($|\/)|\.SU($|\/)|\.SV($|\/)|\.SY($|\/)|\.SZ($|\/)|\.TC($|\/)|\.TD($|\/)|\.TEL($|\/)|\.TF($|\/)|\.TG($|\/)|\.TH($|\/)|\.TJ($|\/)|\.TK($|\/)|\.TL($|\/)|\.TM($|\/)|\.TN($|\/)|\.TO($|\/)|\.TP($|\/)|\.TR($|\/)|\.TRAVEL($|\/)|\.TT($|\/)|\.TV($|\/)|\.TW($|\/)|\.TZ($|\/)|\.UA($|\/)|\.UG($|\/)|\.UK($|\/)|\.US($|\/)|\.UY($|\/)|\.UZ($|\/)|\.VA($|\/)|\.VC($|\/)|\.VE($|\/)|\.VG($|\/)|\.VI($|\/)|\.VN($|\/)|\.VU($|\/)|\.WF($|\/)|\.WS($|\/)|\.XN--0ZWM56D($|\/)|\.XN--11B5BS3A9AJ6G($|\/)|\.XN--80AKHBYKNJ4F($|\/)|\.XN--9T4B11YI5A($|\/)|\.XN--DEBA0AD($|\/)|\.XN--G6W251D($|\/)|\.XN--HGBK6AJ7F53BBA($|\/)|\.XN--HLCJ6AYA9ESC7A($|\/)|\.XN--JXALPDLP($|\/)|\.XN--KGBECHTV($|\/)|\.XN--ZCKZAH($|\/)|\.YE($|\/)|\.YT($|\/)|\.YU($|\/)|\.ZA($|\/)|\.ZM($|\/)|\.ZW)/i",
    $string,
    $M);
  $has_tld = (count($M) > 0) ? true : false;
  return $has_tld;
}
/*************************************************************
*
*	ClassifiedTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_url_cleaner($url) {
  $U = explode(' ',$url);

  $W =array();
  foreach ($U as $k => $u) {
    if (stristr($u,".")) { //only preg_match if there is a dot    
      if (PricerrTheme_containsTLD($u) === true) {
      unset($U[$k]);
      return PricerrTheme_url_cleaner( implode(' ',$U));
    }      
    }
  }
  return implode(' ',$U);
}

 

/*************************************************************
*
*	ClassifiedTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_custom_taxonomy_count2($post_type, $tax_term, $taxonomy_name) 
{
	$taxonomy = 'my_taxonomy'; // this is the name of the taxonomy
    $args = array(
        'post_type' => $post_type, 'posts_per_page' => '1',
		'meta_query' => array(
				array(
					'key' => 'closed',
					'value' => '0',
					'compare' => '='
				)
			),		
        'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy_name,
                        'field' => 'slug',
                        'terms' => $tax_term)
                )
        );

     $my_query = new WP_Query( $args );
	 return $my_query->found_posts;
	
}
/*************************************************************
*
*	ClassifiedTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_total_nr_of_listings()
{
	$query = new WP_Query( "post_type=job&order=DESC&orderby=id&posts_per_page=-1&paged=1" );	
	return $query->post_count;
}
/*************************************************************
*
*	ClassifiedTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_total_nr_of_open_listings()
{
	$query = new WP_Query( "meta_key=closed&meta_value=0&post_type=job&order=DESC&orderby=id&posts_per_page=-1&paged=1" );	
	return $query->post_count;
}
/*************************************************************
*
*	ClassifiedTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_total_nr_of_closed_listings()
{
	$query = new WP_Query( "meta_key=closed&meta_value=1&post_type=job&order=DESC&orderby=id&posts_per_page=-1&paged=1" );	
	return $query->post_count;
}
	
/*************************************************************
*
*	ClassifiedTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_country_code_of_ip($ip)
{
	global $wpdb;
	
	$s = "select * from ".$wpdb->prefix."job_ipcache where ipnr='$ip'";
	$r = $wpdb->get_results($s);
	
	if(count($r) == 0)
	{
	
		$ipLite = new ip2location_lite;
		$ipLite->setKey(get_option('PricerrTheme_ip_key_db'));
	 
		//Get errors and locations
		$locations = $ipLite->getCountry($ip);
		$ccode = $locations['countryCode'];
		
		$s = "insert into ".$wpdb->prefix."job_ipcache (ipnr, country) values('$ip','$ccode')";
		$wpdb->query($s);
		
		return $ccode;
	}
	
	return $r[0]->country;
	
}
/*************************************************************
*
*	ClassifiedTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_show_badge_user($uid)
{
	$user_level = get_user_meta($uid,'user_level',true);
	if($user_level == "2") return '<div class="user_level2"></div>';
	if($user_level == "3") return '<div class="user_level3"></div>';
	
	return '<div class="user_level1"></div>';	
}
/*************************************************************
*
*	ClassifiedTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_show_badge_user2($uid)
{
	$user_badge = get_user_meta($uid,'user_badge',true);
	if($user_badge == "1")	return '<div class="user_badge1"></div>';
	if($user_badge == "2")	return '<div class="user_badge2"></div>';	
}
/*************************************************************
*
*	ClassifiedTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_show_badge_user_account_panel($uid)
{
	$user_level = get_user_meta($uid,'user_level',true);
	if($user_level == "2") return '<div class="user_level2_u"></div>';
	if($user_level == "3") return '<div class="user_level3_u"></div>';
	
	return '<div class="user_level1_u"></div>';	
}
/*************************************************************
*
*	ClassifiedTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_show_badge_user_account_panel2($uid)
{
		$user_badge = get_user_meta($uid,'user_badge',true);
	if($user_badge == "1")	return '<div class="user_badge1u"></div>';
	if($user_badge == "2")	return '<div class="user_badge2u"></div>';	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_parseHyperlinks($string) {
    // Add <a> tags around all hyperlinks in $string
    return ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "[link_removed]", $string);
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function 
*
**************************************************************/
 
function PricerrTheme_parseEmails($string) {
    // Add <a> tags around all email addresses in $string
    return ereg_replace("[_A-Za-z0-9-]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,3})", "[email_removed]", $string);
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function 
*
**************************************************************/

function PricerrTheme_is_home()
{
	global $current_user, $wp_query;
	$p_action 	=  $wp_query->query_vars['jb_action'];	
	$job_category = $wp_query->query_vars['job_category'];	
	
	if(!empty($job_category)) return true;
	
	if(!empty($p_action)) return false;
	if(is_home()) return true;
	return false;	
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_add_theme_styles()  
{ 
	global $wp_query;
  	//	wp_register_style( 'bootstrap_style1', get_bloginfo('template_url').'/css/bootstrap_min.css', array(), '20120822', 'all' );
	//wp_register_script( 'social_pr', get_bloginfo('template_url').'/js/connect.js');
	
	
	global $wp_styles, $wp_scripts;
	// enqueing:
  //	wp_enqueue_style( 'bootstrap_style1' );
		// wp_enqueue_script( 'social_pr' );
	 
	//$wp_styles->add_data('bootstrap_ie6', 'conditional', 'lte IE 7');
	/*wp_register_style( 'mega_menu_thing', 	get_bloginfo('template_url').'/css/menu.css', array(), '20120822', 'all' );
	wp_enqueue_script( 'jqueryhoverintent', get_bloginfo('template_url') . '/js/jquery.hoverIntent.minified.js', array('jquery') );
	wp_enqueue_script( 'dcjqmegamenu', get_bloginfo('template_url') . '/js/jquery.dcverticalmegamenu.1.3.js', array('jquery') );

	
	wp_enqueue_script( 'jqueryhoverintent' );
	wp_enqueue_script( 'dcjqmegamenu' );
	wp_enqueue_style( 'mega_menu_thing' );*/
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

	
function PricerrTheme__myfeed_request($qv) 
{
	if (isset($qv['feed']))
		$qv['post_type'] = get_post_types(array('name'=>'job'));
	return $qv;
} 

	
	
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_register_my_menus() 
{
	register_nav_menu( 'taskerrz_header', 'Top Header Menu' );
	register_nav_menu( 'taskerrz_footer', 'Footer Menu First Row' );	
	register_nav_menu( 'taskerrz_footer1','Footer Menu Second Row' );	
	register_nav_menu( 'taskerrz_footer2','Footer Menu Third Row' );	
		
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
	
function PricerrTheme_run_when_post_published($post)
{
    
	if($post->post_type == 'job'):
	
		$under_review = get_post_meta($post->ID, 'under_review',true);
		
		if($under_review == '1') {	
			PricerrTheme_send_email_posted_job_approved($post->ID);
			update_post_meta($post->ID, 'under_review', '0');
		}
	endif;
}	
	
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_add_query_vars($public_query_vars) 
{  
    	$public_query_vars[] = 'jb_action'; 
		$public_query_vars[] = 'orderid'; 
		$public_query_vars[] = 'step'; 
		$public_query_vars[] = 'my_second_page';
		$public_query_vars[] = 'third_page';
		$public_query_vars[] = 'username';
		$public_query_vars[] = 'pid';
		$public_query_vars[] = 'term_search';		//job_sort, job_category, page
		$public_query_vars[] = 'method';
		$public_query_vars[] = 'jobid';
		$public_query_vars[] = 'page';
		$public_query_vars[] = 'job_category';
		$public_query_vars[] = 'job_sort';
		$public_query_vars[] = 'job_tax';
		
    	return $public_query_vars;  
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
	
function PricerrTheme_get_user_profile_link($username, $paged = 1)
{
	$using_permalinks = PricerrTheme_using_permalinks();
	if($using_permalinks == false)
	{
		if($paged == 1)
		return get_bloginfo('siteurl'). "/?jb_action=user_profile&username=".$username;
		else
		return get_bloginfo('siteurl'). "/?jb_action=user_profile&username=".$username."&paged=".$paged;	
	}
	else
	{
		if($paged == 1)
		return get_bloginfo('siteurl'). "/user-profile/".$username. "/" ;
		else
		return get_bloginfo('siteurl'). "/user-profile/".$username."/paged/".$paged."/";
	}
	
}

 
	
	
	
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_browse_jobs_link($taxonomy, $term, $sort = 'auto', $page = 1, $term_search = '')
{
	$using_permalinks = PricerrTheme_using_permalinks();
	global $wp_query;
	$query_vars 	= $wp_query->query_vars;
	
	if(empty($term_search)) $term_search 	= $query_vars['term_search'];
		
	if($using_permalinks == true)
	{
		if(empty($term_search))	return get_bloginfo('siteurl'). "/jobs/".$taxonomy."/".$term."/".$sort."/page/".$page;	
		else return get_bloginfo('siteurl'). "/jobs/".$taxonomy."/".$term."/".$sort."/page/".$page."/?term_search=".$term_search;
	}
	else 
	{
		if(empty($term_search)) return get_bloginfo('siteurl'). "/index.php?jb_action=jobs_total&job_sort=".$sort."&job_category=".$term."&job_tax=".$taxonomy."&page=".$page;	
		else return get_bloginfo('siteurl'). "/index.php?jb_action=jobs_total&job_sort=".$sort."&job_category=".$term."&job_tax=".$taxonomy."&page=".$page."&term_search=".$term_search;
	}
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_rewrite_rules( $wp_rewrite )
{

		$new_rules = array( 
			
		 	'user-profile/([^/]+)/?$' => 'index.php?jb_action=user_profile&username='.$wp_rewrite->preg_index(1),
			'user-profile/([^/]+)/paged/?([0-9]{1,})/?$' => 'index.php?jb_action=user_profile&username='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2),
			'user-profile/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?jb_action=user_profile&username='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2),		
			
			'jobs/([^/]+)/([^/]+)/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?jb_action=jobs_total&job_sort='.$wp_rewrite->preg_index(3)
			.'&job_category='.$wp_rewrite->preg_index(2) .'&job_tax='.$wp_rewrite->preg_index(1) .'&page='.$wp_rewrite->preg_index(4),

			'jobs/([^/]+)/([^/]+)/([^/]+)/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?jb_action=jobs_total&job_sort='.$wp_rewrite->preg_index(3)
			.'&job_category='.$wp_rewrite->preg_index(2) .'&job_tax='.$wp_rewrite->preg_index(1) .'&page='.$wp_rewrite->preg_index(5).'&term_search='.$wp_rewrite->preg_index(4),
			

		);

		$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;

}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_my_jobs_columns($columns) //this function display the columns headings
{
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __("Job Title",'PricerrTheme'),
		"price" => __("Price",'PricerrTheme'),
		"author" => __("Author",'PricerrTheme'),
		"posted" => __("Posted On",'PricerrTheme'),
		"closed" => __("Status",'PricerrTheme'),
		"thumbnail" => __("Thumbnail",'PricerrTheme'),
		"options" => __("Options",'PricerrTheme')
	);
	return $columns;
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_my_custom_columns($column)
{
	global $post;
	if ("ID" == $column) echo $post->ID; //displays title
	elseif ("description" == $column) echo $post->ID; //displays the content excerpt
	elseif ("posted" == $column) echo date('jS \of F, Y \<\b\r\/\>H:i:s',strtotime($post->post_date)); //displays the content excerpt
	elseif ("thumbnail" == $column) 
	{
		echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/post.php?post='.$post->ID.'&action=edit"><img class="image_class" 
	src="'.PricerrTheme_get_first_post_image($post->ID,65,55).'" width="65" height="55" /></a>'; //shows up our post thumbnail that we previously created.
	}
	
	elseif ("price" == $column)
	{
		echo PricerrTheme_get_show_price( get_post_meta($post->ID,'price',true));	
	}
	
	elseif ("author" == $column)
	{
		echo $post->post_author;	
	}
	elseif ("closed" == $column)
	{
		$closed = get_post_meta($post->ID, 'closed', true);	
			
		if($closed == "1") echo __("Closed","PricerrTheme");
		else echo __("Open","PricerrTheme");	
	}
	
	elseif ("options" == $column)
	{
		echo '<div style="padding-top:20px">';
		echo '<a class="awesome" href="'.get_bloginfo('siteurl').'/wp-admin/post.php?post='.$post->ID.'&action=edit">Edit</a> | ';	
		echo '<a class="awesome" href="'.get_permalink($post->ID).'" target="_blank">View</a> | ';
		echo '<a class="trash" href="'.get_delete_post_link($post->ID).'">Trash</a> ';
		echo '</div>';
	}
	
}	


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_save_custom_fields($pid)
{
	
	if(isset($_POST['fromadmin']))
	{	
		$post = get_post($pid);
		
		//------------------------------------------------------------------------
		
		update_post_meta($pid, 'instruction_box', trim($_POST['instruction_box']));
		
		$sts = get_option('PricerrTheme_get_total_extras');
		if(empty($sts)) $sts = 3;
		
		for($k=1;$k<=$sts;$k++)
		{
			$extra_price 	= trim($_POST['extra'.$k.'_price']);
			$extra_content 	= trim($_POST['extra'.$k.'_content']);
			
			
			if(!empty($extra_price) && is_numeric($extra_price) && !empty($extra_content)):
			
				update_post_meta($pid, 'extra'.$k.'_price', 	$extra_price);
				update_post_meta($pid, 'extra'.$k.'_content', 	$extra_content);
			else:
				update_post_meta($pid, 'extra'.$k.'_price', 	'');
				update_post_meta($pid, 'extra'.$k.'_content', 	'');
					
			endif;
		}
		

		//------------------------------------------------------------------------
		
		//$ttl = pricerrTheme_reomve_i_will($post->post_title); 
		$title_variable = get_post_meta($pid, 'title_variable', true);
		
		if(!empty($ttl)) $ttl = $title_variable;
		
		$job_cost = htmlspecialchars($_POST['job_cost']);
		update_post_meta($pid, "title_variable", $ttl);
		
			
		//--------------------------------------------------------------------
		
		$PricerrTheme_enable_dropdown_values 	= get_option('PricerrTheme_enable_dropdown_values');
        $PricerrTheme_enable_free_input_box 	= get_option('PricerrTheme_enable_free_input_box');
		
		if($PricerrTheme_enable_free_input_box == "yes")				
			update_post_meta($pid, "price", $job_cost);
        else if($PricerrTheme_enable_dropdown_values == "yes")                       
        	update_post_meta($pid, "price", $job_cost);
		else
		{
			$prc = get_option('PricerrTheme_job_fixed_amount');
			update_post_meta($pid, "price", $prc);	
		}
			
		//--------------------------------------------------------------------
		
		$ending 	= get_post_meta($pid,"ending",true);
		$views 		= get_post_meta($pid,"views",true);
		$closed 	= get_post_meta($pid,"closed",true);
		update_post_meta($pid, "shipping",  trim($_POST['shipping']));
		

		if(empty($views)) update_post_meta($pid,"views",0);	
		

	
		if($_POST['active'] == '1') 
			update_post_meta($pid,"active",'1');
		else
			update_post_meta($pid,"active",'0');
	
	//--------------------------------------------
		
		if($_POST['featureds'] == '1') 
		update_post_meta($pid,"featured",'1');
		else
		update_post_meta($pid,"featured",'0');
		
		if($_POST['closed'] == '1') 
		{
			update_post_meta($pid,"closed",'1');
		}
		else
		{
			if($closed == "1") 	update_post_meta($pid,"ending",time() + 30*24*3600);		
			update_post_meta($pid,"closed",'0');
			
		}
	
	//---------------
	
	$PricerrTheme_featured_job_listing = get_option('PricerrTheme_featured_job_listing');
	if(empty($PricerrTheme_featured_job_listing)) $PricerrTheme_featured_job_listing = 30;
		
	update_post_meta($pid, 'featured_until', (current_time('timestamp',0) + (3600*24*$PricerrTheme_featured_job_listing) ));
	
	//---------------
	
			if(isset($_POST['youtube_link3']))
			update_post_meta($pid, "youtube_link3", trim(htmlspecialchars($_POST['youtube_link3'])));
			else update_post_meta($pid, "youtube_link3", '');
			
			if(isset($_POST['youtube_link1']))
			update_post_meta($pid, "youtube_link1", trim(htmlspecialchars($_POST['youtube_link1'])));
			else update_post_meta($pid, "youtube_link1", '');
			
			if(isset($_POST['youtube_link2']))
			update_post_meta($pid, "youtube_link2", trim(htmlspecialchars($_POST['youtube_link2'])));
			else update_post_meta($pid, "youtube_link2", '');
			
			$mi_videos = 0;
			
			for($i=1;$i<=3;$i++):
				
				$video_thing = get_post_meta($pid, 'youtube_link'.$i, true);
				if(empty($video_thing)) $mi_videos++;
				
			endfor;
			
			update_post_meta($pid, 'has_videos', '1');
			if($mi_videos == 3) update_post_meta($pid, 'has_videos', '0');
			
	}
}



/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

/*function PricerrTheme_admin_stylesheet()
{
 
	wp_enqueue_script("jquery-ui-widget");
	wp_enqueue_script("jquery-ui-mouse");
	wp_enqueue_script("jquery-ui-tabs");
	wp_enqueue_script("jquery-ui-datepicker");
	
?>	
	
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/tipTip.css" type="text/css" /> 
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/admin.css" type="text/css" />    
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/colorpicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php bloginfo('template_url'); ?>/css/layout.css" />
	<link type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
	
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.tipTip.js"></script>	
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/idtabs.js"></script>	

		
	<script type="text/javascript">
		<?php
			
			$tb = "tabs1";
			if(isset($_GET['active_tab'])) $tb = $_GET['active_tab']; 
		
		?>	
			var $ = jQuery;
		jQuery(document).ready(function() {		
  			jQuery("#usual2 ul").idTabs("<?php echo $tb; ?>");
			jQuery(".tltp_cls").tipTip({maxWidth: "330"}); 
		});
		
		
		
		</script>
	

	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/colorpicker.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/eye.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/utils.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/layout.js?ver=1.0.2"></script>	
    
    <?php	
	
}

function PricerrTheme_custom_css_thing()
{
	if(is_home()):
	
	$opt = get_option('Pricerr_main_how_it_works');
	$asd = get_bloginfo('template_url') .'/images/main_graphic.jpg';
	if(!empty($opt)) $asd = $opt;
	
?>
	<style type="text/css">
		.main-how-it-works { background:url('<?php echo $asd; ?>') }
	</style>


<?php	
	
	endif;
}*/

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_display_post_new_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_post_new\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_post_new_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_post_new\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_display_pay_for_job_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_pay_for_job_page\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_pay_for_job_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_pay_for_job_page\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
*************************************************************
function PricerrTheme_display_blog_posts_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_blog_posts\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_blog_posts_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_blog_posts\](<\/p>)* /", $output, $content );
		
	} 
	else {
		return $content;
	}
}
*/
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_display_my_account_reviews_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_my_account_reviews\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_my_account_reviews_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_my_account_reviews\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_display_my_account_shopping_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_my_account_shopping\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_my_account_shopping_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_my_account_shopping\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_display_my_account_pers_info_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_my_account_personal_info\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_my_account_pers_info_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_my_account_personal_info\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_display_my_account_sales_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_my_account_sales\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_my_account_sales_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_my_account_sales\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}

function PricerrTheme_get_adv_search_pagination_link($pg)
{
 
	$page_id = get_option('PricerrTheme_advanced_search_id');
	
	$using_perm = PricerrTheme_using_permalinks();
	if($using_perm)	$ssk = get_permalink(($page_id)). "?pj=" . $pg ;
	else $ssk = get_bloginfo('siteurl'). "/?page_id=". ($page_id). "&pj=" . $pg ;		
	
	$trif = '';
	foreach($_GET as $key=>$value)
	{
		if($key != "pj" and $key != 'page_id' and $key != "custom_field_id")
		$trif .= '&'.$key."=".$value;
	}
	
	if(is_array($_GET['custom_field_id']))
	foreach($_GET['custom_field_id'] as $values)
	$trif .= "&custom_field_id[]=".$values;
	
	return $ssk.$trif;
 
	
}

function PricerrTheme_is_adv_src_pg()
{
	global $post;
	if($post->ID == get_option('PricerrTheme_advanced_search_id')) return true;
	return false;	
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_display_all_cats_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_all_categories\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_all_cats_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_all_categories\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}

function PricerrTheme_display_adv_src_pg( $content = '' ) 
{
	?>
	<script type='text/javascript'>
		jQuery(document).ready(function(){
			jQuery('#comments').prev().prev().hide();
			jQuery('#comments').hide();
		});
	</script>
	<?php
	if ( preg_match( "/\[pricerr_theme_search_jobs\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_adv_src_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_search_jobs\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}


function PricerrTheme_display_all_locs_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_all_locations\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_all_locs_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_all_locations\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}

function pricerrtheme_get_custom_taxonomy_count($ptype,$pterm) {
	global $wpdb;
	
	$s = "select * from ".$wpdb->prefix."terms where slug='$pterm'";
	$r = $wpdb->get_results($s);
	$r = $r[0];
	
	$term_id = $r->term_id;
	

	
	//--------
	
	$s = "select * from ".$wpdb->prefix."term_taxonomy where term_id='$term_id'";
	$r = $wpdb->get_results($s);
	$r = $r[0];
	
	$term_taxonomy_id = $r->term_taxonomy_id;

	
	//--------
	
	$s = "select distinct posts.ID from ".$wpdb->prefix."term_relationships rel, $wpdb->postmeta wpostmeta, $wpdb->posts posts 
	 where rel.term_taxonomy_id='$term_taxonomy_id' AND rel.object_id = wpostmeta.post_id AND posts.ID = wpostmeta.post_id AND posts.post_status = 'publish' AND posts.post_type = 'job' AND wpostmeta.meta_key = 'closed' AND wpostmeta.meta_value = '0'";
	$r = $wpdb->get_results($s);
	

	
	return count($r);
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_display_my_account_priv_mess_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_my_account_priv_mess\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_my_account_priv_mess_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_my_account_priv_mess\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_display_my_account_payments_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_my_account_payments\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_my_account_payments_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_my_account_payments\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_display_my_account_pg( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_my_account\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_my_account_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_my_account\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_set_metaboxes()
{
		
		add_meta_box( 'job_images', 'Job Images',				'PricerrTheme_theme_job_images', 		'job', 'advanced',	'high' );
		add_meta_box( 'job_extra', 	'Job Additional Services',	'PricerrTheme_theme_job_additional', 	'job', 'advanced',	'high' );
		add_meta_box( 'job_dets', 	'Job Details',				'PricerrTheme_theme_job_dts', 			'job', 'side',		'high' );	
		add_meta_box( 'job_instr', 	'Seller Instructions',				'PricerrTheme_theme_job_instructions', 			'job', 'advanced',		'high' );	
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_theme_job_additional()
{
	global $post;
	$pid = $post->ID;
?>	
				

        <table width="100%">
    	<?php
		
			$sts = get_option('PricerrTheme_get_total_extras');
			if(empty($sts)) $sts = 3;
					
			for($k=1;$k<=$sts;$k++)
			{
						
		
		?>    
   	         <tr><td width="200" >
            <?php _e('For an extra','PricerrTheme'); ?> <input type="text" size="3" name="extra<?php echo $k; ?>_price" 
            value="<?php echo get_post_meta($pid, 'extra'.$k.'_price', true); ?>" /><?php echo PricerrTheme_get_currency(); ?> 
            &nbsp; &nbsp; <?php _e('I will','PricerrTheme'); ?>: </td><td>  <textarea name="extra<?php echo $k; ?>_content" cols="40" rows="2"><?php echo get_post_meta($pid, 'extra'.$k.'_content', true); ?></textarea></td></tr>
         
		 <?php } ?>   
   
        
        </table>

<?php
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_theme_job_instructions()
{
	global $post;
	
	?>	
	
    <textarea cols="60" rows="5" name="instruction_box"><?php echo get_post_meta($post->ID,'instruction_box',true); ?></textarea>
    
    <?php
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_theme_job_dts()
{
	global $post;
	
	$pid 		= $post->ID;
	$price 		= get_post_meta($pid, "price", true);
	$location 	= get_post_meta($pid, "Location", true);
	$f 			= get_post_meta($pid, "featured", true);
	$t 			= get_post_meta($pid, "closed", true);	
	$active 	= get_post_meta($pid, "active", true);
	

	
	?>
    
    <ul id="post-new4"> 
    <input name="fromadmin" type="hidden" value="1" />
  
         <li>
        	<h2><?php echo __('Job Price','PricerrTheme'); ?>:</h2>
        <p>
        
        
         <?php 
                            
							$PricerrTheme_enable_dropdown_values 	= get_option('PricerrTheme_enable_dropdown_values');
                            $PricerrTheme_enable_free_input_box 	= get_option('PricerrTheme_enable_free_input_box');

							
                            if($PricerrTheme_enable_free_input_box == "yes")
                            {
                                
                                if(PricerrTheme_show_price_in_front() == true)
                                echo PricerrTheme_get_currency();
                                    
                                echo ' <input type="text" name="job_cost" class="do_input" value="'.get_post_meta($pid, 'price', true).'" size="5" /> ';
                                
                                if(PricerrTheme_show_price_in_front() == false)
                                echo PricerrTheme_get_currency();
                                
                            }
                            else if($PricerrTheme_enable_dropdown_values == "yes"){
                            	
								echo PricerrTheme_get_variale_cost_dropdown('do_input', get_post_meta($pid,'price',true));
							}
							else		
                            echo PricerrTheme_get_show_price(get_option('PricerrTheme_job_fixed_amount'));
                            
                            
         ?>
        
        </p>
        </li>
        
        <li>
        	<h2><?php echo __('Youtube Video Link #1','PricerrTheme'); ?>:</h2>
        <p><input type="text" size="10" name="youtube_link1" class="do_input" 
        	value="<?php echo get_post_meta($pid, 'youtube_link1', true); ?>" /></p>
        </li>
        
   		
         <li>
        	<h2><?php echo __('Youtube Video Link #2','PricerrTheme'); ?>:</h2>
        <p><input type="text" size="10" name="youtube_link2" class="do_input" 
        	value="<?php echo get_post_meta($pid, 'youtube_link2', true); ?>" /></p>
        </li>
        
        
         <li>
        	<h2><?php echo __('Youtube Video Link #3','PricerrTheme'); ?>:</h2>
        <p><input type="text" size="10" name="youtube_link3" class="do_input" 
        	value="<?php echo get_post_meta($pid, 'youtube_link3', true); ?>" /></p>
        </li>
        
    	
        <?php
							
								$PricerrTheme_enable_shipping = get_option('PricerrTheme_enable_shipping');
								if($PricerrTheme_enable_shipping == "yes"):
								
							?>
                            
                            <li>
                                <h2><?php echo __('Requires shipping?', 'PricerrTheme'); ?>:</h2>
                            <p>
                            <?php if(PricerrTheme_show_price_in_front())
                                echo PricerrTheme_get_currency(); ?>
                            <input type="text" size="5" class="do_input"  name="shipping" value="<?php echo (empty($shipping) ? get_post_meta($pid,'shipping',true) : $shipping ); ?>" />
                            <?php if(!PricerrTheme_show_price_in_front())
                                echo PricerrTheme_get_currency(); ?> </p>
                            </li>
                            
                            <?php endif; ?>
        
    
     	<li>
        <h2><?php _e("Feature this job",'PricerrTheme');?>:</h2>
        <p><input type="checkbox" value="1" name="featureds" <?php if($f == '1') echo ' checked="checked" '; ?> /></p>
        </li>
        
        <li>
        <h2><?php _e("Active Job?",'PricerrTheme');?>:</h2>
        <p><input type="checkbox" value="1" name="active" <?php if($active == '1') echo ' checked="checked" '; ?> /></p>
        </li>
        
        
        <li>
        <h2><?php _e("Closed",'PricerrTheme');?>:</h2>
        <p><input type="checkbox" value="1" name="closed" <?php if($t == '1') echo ' checked="checked" '; ?> /></p>
        </li>
        
 
        
	</ul>    

	
	<?php
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_theme_job_images()
{

	global $current_user;
	get_currentuserinfo();
	$cid = $current_user->ID;
	
	global $post;
	$pid = $post->ID;
	$cwd = str_replace('wp-admin','',getcwd());

	$cwd .= 'wp-content/uploads';

	//echo get_template_directory();
?>



	                           
    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/jquery.uploadify-3.1.js"></script>     
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.css" type="text/css" />
	
    <script type="text/javascript">
	
	function delete_this(id)
	{
		 jQuery.ajax({
						method: 'get',
						url : '<?php echo get_bloginfo('siteurl');?>/index.php/?_ad_delete_pid='+id,
						dataType : 'text',
						success: function (text) {   jQuery('#image_ss'+id).remove();    }
					 });
		  //alert("a");
	
	}

	
	
	jQuery(function() {
		
		jQuery("#fileUpload3").uploadify({
			height        : 30,
			auto:			true,
			swf           : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.swf',
			uploader      : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploady.php',
			width         : 120,
			fileTypeExts  : '*.jpg;*.jpeg;*.gif;*.png',
			formData    : {'ID':<?php echo $pid; ?>,'author':<?php echo $cid; ?>},
			onUploadSuccess : function(file, data, response) {
			
			//alert(data);
			var bar = data.split("|");
			
jQuery('#thumbnails').append('<div class="div_div" id="image_ss'+bar[1]+'" ><img width="70" class="image_class" height="70" src="' + bar[0] + '" /><a href="javascript: void(0)" onclick="delete_this('+ bar[1] +')"><img border="0" src="<?php echo get_bloginfo('template_url'); ?>/images/delete_icon.png" border="0" /></a></div>');
}
	
			
			
    	});
		
		
	});
	
	
	</script>
	
    <style type="text/css">
	.div_div
	{
		margin-left:5px; float:left; 
		width:110px;margin-top:10px;
	}
	
	</style>
    
    <div id="fileUpload3">You have a problem with your javascript</div>
    <div id="thumbnails" style="overflow:hidden;margin-top:20px">
    
    <?php

		$args = array(
		'order'          => 'ASC',
		'orderby'        => 'post_date',
		'post_type'      => 'attachment',
		'post_parent'    => $pid,
		'post_mime_type' => 'image',
		'numberposts'    => -1,
		); $i = 0;
		
		$attachments = get_posts($args);



	if ($attachments) {
	    foreach ($attachments as $attachment) {
		$url = wp_get_attachment_url($attachment->ID);
		
			echo '<div class="div_div"  id="image_ss'.$attachment->ID.'"><img width="70" class="image_class" height="70" src="' .
			PricerrTheme_generate_thumb($url, 70, 70). '" />
			<a href="javascript: void(0)" onclick="delete_this(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>
			</div>';
	  
	}
	}


	?>
    
    </div>




<?php


}



function pricerrtheme_generate_thumb2($img_ID, $width, $height, $cut = true)
{

	return pricerrtheme_wp_get_attachment_image($img_ID, array($width, $height ));
}

function pricerrtheme_generate_thumb3($img_ID, $size_string)
{
	return pricerrtheme_wp_get_attachment_image($img_ID, $size_string);
}

 

function pricerrtheme_wp_get_attachment_image($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {

	$html = '';
	
	$image = wp_get_attachment_image_src($attachment_id, $size, $icon);
	if ( $image ) {
		list($src, $width, $height) = $image;
		$hwstring = image_hwstring($width, $height);
		if ( is_array($size) )
			$size = join('x', $size);
		$attachment =& get_post($attachment_id);
		$default_attr = array(
			'src'	=> $src,
			'class'	=> "attachment-$size",
			'alt'	=> trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )), // Use Alt field first
			'title'	=> trim(strip_tags( $attachment->post_title )),
		);
		if ( empty($default_attr['alt']) )
			$default_attr['alt'] = trim(strip_tags( $attachment->post_excerpt )); // If not, Use the Caption
		if ( empty($default_attr['alt']) )
			$default_attr['alt'] = trim(strip_tags( $attachment->post_title )); // Finally, use the title

		$attr = wp_parse_args($attr, $default_attr);
		$attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment );
		$attr = array_map( 'esc_attr', $attr );
		$html = rtrim("<img $hwstring");
		 
		$html = $attr['src'];
	}

	return $html;
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_create_post_type() {
  
 
  
	global $jobs_url_thing;
  
  $icn = get_bloginfo('template_url')."/images/pricerr.gif";
  register_post_type( 'job',
    array(
      'labels' => array(
        'name' 			=> __( 'Jobs','PricerrTheme' ),
        'singular_name' => __( 'Job','PricerrTheme' ),
		'add_new' 		=> __('Add New Job','PricerrTheme'),
		'new_item' 		=> __('New Job','PricerrTheme'),
		'edit_item'		=> __('Edit Job','PricerrTheme'),
		'add_new_item' 	=> __('Add New Job','PricerrTheme'),
		'search_items' 	=> __('Search Jobs','PricerrTheme') ),
      'public' => true,
	  'menu_position' => 5,
	  'register_meta_box_cb' => 'PricerrTheme_set_metaboxes',
	  'has_archive' => "all-jobs",
    	'rewrite' => array('slug'=> $jobs_url_thing."/%job_cat%",'with_front'=>false),
		 'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
	  '_builtin' => false,
	  'menu_icon' => $icn,
	  'publicly_queryable' => true,
	  'hierarchical' => false 

    )
  );
  

    $icn = get_bloginfo('template_url')."/images/pricerr.gif";
 	 register_post_type( 'request',
    array(
      'labels' => array(
        'name' 			=> __('Requests','PricerrTheme' ),
        'singular_name' => __('Request','PricerrTheme' ),
		'add_new' 		=> __('Add New Request','PricerrTheme'),
		'new_item' 		=> __('New Request','PricerrTheme'),
		'edit_item'		=> __('Edit Request','PricerrTheme'),
		'add_new_item' 	=> __('Add New Request','PricerrTheme'),
		'search_items' 	=> __('Search Requests','PricerrTheme'),	
      ),
      'public' => true,
	  'menu_position' => 5,
	 // 'register_meta_box_cb' => 'PricerrTheme_set_metaboxes',
	  'has_archive' => true,
    	'rewrite' => true, 'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
	  '_builtin' => false,
	  'menu_icon' => $icn,
	  'publicly_queryable' => true,
	  'hierarchical' => false 

    )
  );

	register_taxonomy( 'request_cat', 'request', array( 'hierarchical' => true, 'label' => __('Request Categories','PricerrTheme') ) );
	register_taxonomy( 'job_cat', 'job', array( 'hierarchical' => true, 'label' => __('Job Categories','PricerrTheme') ) );
	register_taxonomy( 'job_location', 'job', array( 'hierarchical' => true, 'label' => __('Job Locations','PricerrTheme') ) );
	//register_taxonomy( 'job_location', 'job', array( 'hierarchical' => true, 'label' => __('Locations') ) );
	add_post_type_support( 'job', 'author' );
	//  add_post_type_support( 'job', 'custom-fields' );
	register_taxonomy_for_object_type('post_tag', 'job');
	
	flush_rewrite_rules();

}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_insert_pages($page_ids, $page_title, $page_tag, $parent_pg = 0 )
{
	
		$opt = get_option($page_ids);			
		if(!PricerrTheme_check_if_page_existed($opt))
		{
			
			$post = array(
			'post_title' 	=> $page_title, 
			'post_content' 	=> $page_tag, 
			'post_status' 	=> 'publish', 
			'post_type' 	=> 'page',
			'post_author' 	=> 1,
			'ping_status' 	=> 'closed', 
			'post_parent' 	=> $parent_pg);
			
			$post_id = wp_insert_post($post);
				
			update_post_meta($post_id, '_wp_page_template', 'pricerr-special-page-template.php');
			update_option($page_ids, $post_id);
		
		}
				
	
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_check_if_page_existed($pid)
{
	global $wpdb;
	$s = "select * from ".$wpdb->prefix."posts where post_type='page' AND post_status='publish' AND ID='$pid'";
	$r = $wpdb->get_results($s);
	
	if(count($r) > 0) return true;
	return false;	
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_post_new_link()
{
	return get_permalink(get_option('PricerrTheme_post_new_page_id'));	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_blog_link()
{
	return get_permalink(get_option('PricerrTheme_blog_home_id'));	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_my_account_link()
{
	return get_permalink(get_option('PricerrTheme_my_account_page_id'));	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

add_filter('upload_mimes', 'PricerrTheme_custom_upload_mimes');

function PricerrTheme_custom_upload_mimes ( $existing_mimes=array() ) {
 

$existing_mimes['zip'] = 'application/zip'; 

return $existing_mimes;

 
}

add_action('PricerrTheme_get_post','PricerrTheme_get_post_fnc');
add_action('PricerrTheme_get_post_thumbs','PricerrTheme_get_post_thumbs_fnc');

function PricerrTheme_get_post()
{
	do_action('PricerrTheme_get_post');
}


function PricerrTheme_get_post_thumbs()
{
	do_action('PricerrTheme_get_post_thumbs');
}

function pricerrtheme_show_rating_star_user($uid)
{
	$concat = '';
	$nr_ratings = 0;
	
	global $wpdb;
	$s = "select count(grade) cnt, sum(grade) smm from ".$wpdb->prefix."job_ratings where uid='$uid' and awarded='1'";
	$r = $wpdb->get_results($s);
	
 
	
	if(count($r) > 0)
	{
		$nr_ratings = $r[0]->cnt;
		$sum 		= $r[0]->smm;
		
		if($sum > 0)
		$sdd = ceil($sum/$nr_ratings);
		else $sdd = 1;
		
		for($i=1;$i<=$sdd;$i++)
		{
			$concat .= ' <img src="'.get_bloginfo('template_url').'/images/star_full.png" width="15" style="float:left;"/>';	
		}
		
		for($i=$sdd;$i<=5;$i++)
		{
			$concat .= ' <img src="'.get_bloginfo('template_url').'/images/star_empty.png" width="15" style="float:left;"/>';	
		}	
	
	}
	else
	{
		for($i=1;$i<=5;$i++)
		{
			$concat .= ' <img src="'.get_bloginfo('template_url').'/images/star_empty.png" width="15" style="float:left;"/>';	
		}	
		
	}
	
	return $concat." (".$nr_ratings.")";	
}

function PricerrTheme_get_post_thumbs_fnc()
{
	$pic_id 	= PricerrTheme_get_first_post_image_ID(get_the_ID());
	
	if($pic_id != false) $img 		= pricerrtheme_generate_thumb3($pic_id, 'thumb_picture_size');
	else $img = get_bloginfo('template_url').'/images/nopic.jpg';
	
	global $post;
	
	$prc 		= pricerrtheme_get_show_price(get_post_meta(get_the_ID(), 'price', true));
	$usr 		= get_userdata($post->post_author);
	$flag 		= strtoupper(PricerrTheme_get_user_country($post->post_author)). " ".PricerrTheme_get_user_flag($post->post_author);  
	$userdata 	= get_userdata($post->post_author);
	$featured 	= get_post_meta(get_the_ID(), 'featured', true);
	
	?>	
	<div class="recenr_categories_box">
    	<div class="recenr_categories_boxInner">
           <a href="<?php the_permalink() ?>"><img class="my_image" src="<?php echo $img ?>" width="115" height="115" alt="<?php the_title() ?>" /></a>
        	<!-- <img src="<?php echo $imgurl; ?>" alt="" /> -->
        </div>
        <div class="recenr_categories_content">
        	<p>
        	<?php 
				echo '<a href="'.get_permalink().'">'.$string_title = ucfirst(substr(get_the_title(), 0, 80)).'</a>';
			?>
			</p>
            <span>
            	<?php 
					$link_user = PricerrTheme_get_user_profile_link($userdata->user_login);
					echo sprintf(__('by <a href="%s">%s</a>','PricerrTheme'), $link_user, $userdata->user_login); ?>
               		&nbsp; &nbsp;  
               		<?php echo $flag ?>
            </span>
            <!-- <a href="#"><img src="<?php echo get_template_directory_uri().'/images/star.png'; ?>" alt="" /></a> -->
            <?php echo pricerrtheme_show_rating_star_user($post->post_author) ?>
        </div>
        
    </div>
    
    <?php
   
}

function pricerrtheme_get_current_view_grid_list()
{	
		if(	$_SESSION['view_tp'] == "list") return "list"; else return "grid";	
}

function pricerrtheme_get_current_order_by_thing()
{	
		if(	empty($_SESSION['current_order']) == "auto") return "auto"; else return $_SESSION['current_order'];	
}

function pricerrtheme_filter_switch_link_from_home_page($tp)
{
	return get_bloginfo('siteurl')."?switch_filter=".$tp."&get_urls=" . urlencode(pricerrtheme_curPageURL());
}

function pricerrtheme_switch_link_from_home_page($tp)
{
	return get_bloginfo('siteurl')."?switch_grd=".$tp."&get_urls=" . urlencode(pricerrtheme_curPageURL());
}

function pricerrtheme_curPageURL_me() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
}
/*****************************************************************************
*
*	Function - pricerrtheme -
*
*****************************************************************************/
function pricerrtheme_curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function PricerrTheme_get_post_fnc()
{


			if($arr[0] == "winner") $pay_this_me = 1;
			if($arr[0] == "unpaid") $unpaid = 1;

			$ending = get_post_meta(get_the_ID(), 'ending', true);
			$sec 	= $ending - time();
	
			$closed = get_post_meta(get_the_ID(), 'closed', true);
			$post = get_post(get_the_ID());
			$featured = get_post_meta(get_the_ID(), 'featured', true);

			$img_class = "image_class_pst";
			
			global $current_user;
			$post = get_post(get_the_ID());
			get_currentuserinfo();
			$uid = $current_user->ID;
			$prc = pricerrtheme_get_show_price2(get_post_meta(get_the_ID(), 'price', true), 2);
			
?>
	<div class="clients_inner_bottom1">
		<div class="clients_inner_bottom1-part" id="post-<?php the_ID(); ?>">
			<?php if($featured == "1"): ?>
				<div class="featured"></div>
			<?php endif; ?>
              
          	<div class="blog-img">
                <!-- <a href="<?php the_permalink(); ?>"> -->
        			<img class="<?php echo $img_class; ?>" src="<?php echo PricerrTheme_get_first_post_image(get_the_ID(),102,72); ?>" />
                <!-- </a> -->
        	</div>

            <div class="blog-details-part">
                <p class="blog-head">
                	<?php
						$days_needed 	= get_post_meta(get_the_ID(),'max_days',true);
						$instant 		= get_post_meta(get_the_ID(),'instant',true);
						if($instant 	== 1) echo '<span class="instant_job_spn">'.__('Instant Delivery','PricerrTheme').'</span>';
						else if($days_needed == 1) echo '<span class="express_job_spn">'.__('Express Job','PricerrTheme').'</span>'; 
					?>
                    <!-- <a class="title_of_job" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"> -->
                    	<?php 
                   			echo ucfirst(strtolower($post->post_title));                     
                    	?>
                    <!-- </a>  -->
                </p>
                <br>
                <p class="read-more">
                	<a href="#" class="more">Express Job</a> &nbsp; &nbsp; &nbsp; 
                	<a href="<?php the_permalink() ?>" class="more">View Details</a>
                    <br clear="all">
                </p>
                <p class="read-more">
					<?php
						$usr 	= get_userdata($post->post_author);
						$flag 	= strtoupper(PricerrTheme_get_user_country($post->post_author)). " ".PricerrTheme_get_user_flag($post->post_author);  
						
						//----------------------------
						
						$reg 	= $usr->user_registered;
						$joined = PricerrTheme_prepare_seconds_to_words(time() - strtotime($reg));
						
						//----------------------------
							
						$max_days   = get_post_meta(get_the_ID(), "max_days", true);
						$instant = get_post_meta(get_the_ID(),'instant',true);
						
						if($instant == "1")  
							$del = __("Instant","PricerrTheme");
						else
						{
							if($max_days == 1)  
								$del = __("24Hrs","PricerrTheme"); 
							else
								$del = sprintf(__("%s days","PricerrTheme"), $max_days); 
						}
					?> 
					<?php echo sprintf(__("<span class='by-long'>by <a href='%s' class='title_of_job2'>%s</a></span>",'PricerrTheme'), PricerrTheme_get_user_profile_link($usr->user_login), $usr->user_login); ?> &nbsp; &nbsp;    
					<?php echo sprintf(__('<span class="from-joined">From: %s','PricerrTheme'), $flag); ?> &nbsp; &nbsp; 	
                    <?php echo sprintf(__('Joined: %s </span>','PricerrTheme'), $joined); ?> &nbsp; &nbsp; 	 
					<?php echo sprintf(__('<span class="delivery">Delivery: %s </span>','PricerrTheme'), $del); ?>
                    <br clear="all">
                </p>
                <p class="read-more">
                	<a href="<?php echo get_permalink($pid); ?>" class="order">
                		<?php echo sprintf(__('Order Now %s','PricerrTheme'), $prc); ?>
                	</a>
                    <br clear="all">
                </p>
                <br clear="all">
            </div>
           	<br clear="all"/> 
        </div> 
    </div>
                   
<?php
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_option_drop_down($arr, $name)
{
	$opts = get_option($name);
	$r = '<select name="'.$name.'">';
	foreach ($arr as $key => $value)
	{
		$r .= '<option value="'.$key.'" '.($opts == $key ? ' selected="selected" ' : "" ).'>'.$value.'</option>';		
		
	}
    return $r.'</select>'; 
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_currency()
{
	$c = trim(get_option('PricerrTheme_currency_symbol'));
	if(empty($c)) return get_option('PricerrTheme_currency');
	return $c;	
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_show_price($price, $cents = 2)
{	
	$PricerrTheme_currency_position = get_option('PricerrTheme_currency_position');	
	if($PricerrTheme_currency_position == "front") return PricerrTheme_get_currency()."".PricerrTheme_formats($price, $cents);	
	return PricerrTheme_formats($price,$cents)."".PricerrTheme_get_currency();	
		
}

function PricerrTheme_get_show_price2($price, $cents = 2)
{	
	$PricerrTheme_currency_position = get_option('PricerrTheme_currency_position');	
	if($PricerrTheme_currency_position == "front") return PricerrTheme_get_currency()."".PricerrTheme_formats_mm($price, $cents);	
	return PricerrTheme_formats_mm($price,$cents)."".PricerrTheme_get_currency();	
		
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_formats_mm($number, $cents = 1) 
{
	if(is_float($number)) return PricerrTheme_formats($number, $cents);
	return $number;
}

function PricerrTheme_formats($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always
  
  $dec_sep = get_option('PricerrTheme_decimal_sum_separator');
  if(empty($dec_sep)) $dec_sep = '.';
  
  $tho_sep = get_option('PricerrTheme_thousands_sum_separator');
  if(empty($tho_sep)) $tho_sep = ',';
  
  //dec,thou
  
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0'.$dec_sep.'00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0), $dec_sep, $tho_sep ); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2), $dec_sep, $tho_sep ); // format
      } // integer or decimal
    } // value
    return $money;
  } // numeric
} // formatMoney

 

function PricerrTheme_formats_special($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always
  
	$dec_sep = '.';
	$tho_sep = ',';
  
  //dec,thou
  
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0'.$dec_sep.'00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0), $dec_sep, '' ); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2), $dec_sep, '' ); // format
      } // integer or decimal
    } // value
    return $money;
  } // numeric
} // formatMoney

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

add_action('wp_ajax_update_users_balance', 		'PricerrTheme_update_users_balance');
add_action('wp_ajax_update_badge_user', 		'PricerrTheme_update_badge_user');
add_action('wp_ajax_update_level_user', 		'PricerrTheme_update_level_user');

function PricerrTheme_update_badge_user()
{
	if(current_user_can( 'manage_options' ))	
	if($_POST['action'] == "update_badge_user")
	{
		$uid = $_POST['uid']; 
		
		$level0 = $_POST['level0'];
		$level1 = $_POST['level1'];
		$level2 = $_POST['level2'];
		
		if($level1 == "1") update_user_meta($uid, 'user_badge', "1");
		if($level2 == "1") update_user_meta($uid, 'user_badge', "2");
		if($level0 == "1") update_user_meta($uid, 'user_badge', "0");
 
	}
	 
}

function PricerrTheme_update_level_user()
{
	if(current_user_can( 'manage_options' ))	
	if($_POST['action'] == "update_level_user")
	{
		$uid = $_POST['uid']; 
		
		
		$level1 = $_POST['level1'];
		$level2 = $_POST['level2'];
		$level3 = $_POST['level3'];
		
		if($level1 == "1") update_user_meta($uid, 'user_level', "1");
		if($level2 == "1") update_user_meta($uid, 'user_level', "2");
		if($level3 == "1") update_user_meta($uid, 'user_level', "3");
 		
		 
	}
	 
}


function PricerrTheme_update_users_balance()
{
	if(current_user_can( 'manage_options' ))	
	if($_POST['action'] == "update_users_balance")
	{
		$uid = $_POST['uid']; 
		if(!empty($_POST['increase_credits']))
		{
			if($_POST['increase_credits'] > 0)
			if(is_numeric($_POST['increase_credits']))
			{
				$cr = PricerrTheme_get_credits($uid);
				PricerrTheme_update_credits($uid, $cr + $_POST['increase_credits']);
				
				$reason = __('Payment received from Site Admin','PricerrTheme');
				PricerrTheme_add_history_log('1', $reason, $_POST['increase_credits'], $uid);
				
			}
		}
		else
		{
			if($_POST['decrease_credits'] > 0)
			if(is_numeric($_POST['decrease_credits']))
			{
				$cr = PricerrTheme_get_credits($uid);
				PricerrTheme_update_credits($uid, $cr - $_POST['decrease_credits']);
				
				$reason = __('Payment taken from Site Admin','PricerrTheme');
				PricerrTheme_add_history_log('0', $reason, $_POST['decrease_credits'], $uid);
			}
		
		}	
		//echo auctionTheme_get_credits($uid);
		echo $sign.PricerrTheme_get_show_price(PricerrTheme_get_credits($uid));
		
		
	}
	
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_credits($uid)
{
	$c = get_user_meta($uid,'credits',true);
	if(empty($c))
	{
		update_user_meta($uid,'credits',"0");	
		return 0;
	}
	
	return $c;
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_update_credits($uid,$am)
{
	update_user_meta($uid,'credits',$am);	
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_add_history_log($tp, $reason, $amount, $uid, $uid2 = '')
{
	$tm = current_time('timestamp',0); 
	global $wpdb;
	
	$s = "insert into ".$wpdb->prefix."job_payment_transactions (tp, reason, amount, uid, datemade, uid2)
	values('$tp','$reason','$amount','$uid','$tm','$uid2')";	
	$wpdb->query($s);
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/


function PricerrTheme_mail_from($old) {
	
	$PricerrTheme_email_addr_from = get_option('PricerrTheme_email_addr_from');
	$PricerrTheme_email_addr_from  = trim($PricerrTheme_email_addr_from );
	
	if(empty($PricerrTheme_email_addr_from)) return $PricerrTheme_email_addr_from ;
	return $old;
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_mail_from_name($old) {
 	
	$PricerrTheme_email_name_from = get_option('PricerrTheme_email_name_from');
	$PricerrTheme_email_name_from  = trim($PricerrTheme_email_name_from );
	
	if(empty($PricerrTheme_email_name_from )) return $PricerrTheme_email_name_from ;
	return $old;
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_browse_pm_link($pg)
{
		global $wpdb,$wp_rewrite,$wp_query;
		$third_page = $_GET['priv_act'];
		
		$using_perm = PricerrTheme_using_permalinks();
	
		if($using_perm)	$privurl_m = get_permalink(get_option('PricerrTheme_my_account_priv_mess_page_id')). "?priv_act=inbox&pj=".$pg;
		else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('PricerrTheme_my_account_priv_mess_page_id'). "&priv_act=inbox&pj=".$pg;		
		return $privurl_m;
}


function PricerrTheme_get_browse_pm_link2($pg)
{
		global $wpdb,$wp_rewrite,$wp_query;
		$third_page = $_GET['priv_act'];
		
		$using_perm = PricerrTheme_using_permalinks();
	
		if($using_perm)	$privurl_m = get_permalink(get_option('PricerrTheme_my_account_priv_mess_page_id')). "?priv_act=sent-items&pj=".$pg;
		else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('PricerrTheme_my_account_priv_mess_page_id'). "&priv_act=sent-items&pj=".$pg;		
		return $privurl_m;
}

function PricerrTheme_send_email($recipients, $subject = '', $message = '') {
		
	$PricerrTheme_email_addr_from 	= get_option('PricerrTheme_email_addr_from');	
	$PricerrTheme_email_name_from  	= get_option('PricerrTheme_email_name_from');
	
	if(empty($PricerrTheme_email_name_from)) $PricerrTheme_email_name_from  = "Pricerr Theme";
	if(empty($PricerrTheme_email_addr_from)) $PricerrTheme_email_addr_from  = "pricerrTheme@wordpress.org";
		
	$headers = 'From: '. $PricerrTheme_email_name_from .' <'. $PricerrTheme_email_addr_from .'>' . PHP_EOL;
	$PricerrTheme_allow_html_emails = get_option('PricerrTheme_allow_html_emails');
	if($PricerrTheme_allow_html_emails != "yes") $html = false;
	else $html = true;

	
	if ($html) {
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-Type: " . get_bloginfo('html_type') . "; charset=\"". get_bloginfo('charset') . "\"\n";
		$mailtext = "<html><head><title>" . $subject . "</title></head><body>" . nl2br($message) . "</body></html>";
		return wp_mail($recipients, $subject, $mailtext, $headers);
		
	} else {
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-Type: text/plain; charset=\"". get_bloginfo('charset') . "\"\n";
		$message = preg_replace('|&[^a][^m][^p].{0,3};|', '', $message);
		$message = preg_replace('|&amp;|', '&', $message);
		$mailtext = wordwrap(strip_tags($message), 80, "\n");
		return wp_mail($recipients, $subject, $mailtext, $headers);
	}



}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_create_auto_draft($uid)
{
		$my_post = array();
		$my_post['post_title'] 		= 'Auto Draft';
		$my_post['post_type'] 		= 'job';
		$my_post['post_status'] 	= 'auto-draft';
		$my_post['post_author'] 	= $uid;
		return wp_insert_post( $my_post, true );
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
	
function PricerrTheme_get_auto_draft($uid)
{
	global $wpdb;	
	$querystr = "
		SELECT distinct wposts.* 
		FROM $wpdb->posts wposts where 
		wposts.post_author = '$uid' AND wposts.post_status = 'auto-draft' 
		AND wposts.post_type = 'job' 
		ORDER BY wposts.ID DESC LIMIT 1 ";
				
	$row = $wpdb->get_results($querystr, OBJECT);
	if(count($row) > 0)
	{
		$row = $row[0];
		return $row->ID;
	}
	
	return PricerrTheme_create_auto_draft($uid);	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_using_permalinks()
{
	global $wp_rewrite;
	if($wp_rewrite->using_permalinks()) return true; 
	else return false; 	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_post_new_with_pid_stuff_thg($pid)
{
	$using_perm = PricerrTheme_using_permalinks();
	if($using_perm)	return get_permalink(get_option('PricerrTheme_post_new_page_id')). "?jobid=" . $pid;
			else return get_bloginfo('siteurl'). "/?page_id=". get_option('PricerrTheme_post_new_page_id'). "&jobid=" . $pid;	
}

function PricerrTheme_get_user_flag($uid)
{
	$opt = get_option('PricerrTheme_en_country_flags');
	
	
	if($opt == 'yes')
	{
		$code = 'us';
		
		$ip = get_user_meta($uid, 'ip_reg', true);
		
		$code = PricerrTheme_get_country_code_of_ip($ip);
		$code = strtolower($code);
		
		if(empty($code)) $code = 'us';
		
		$code = apply_filters('PricerrTheme_code_country_ip', $code);
		
		return '<img src="'.get_bloginfo('template_url').'/images/flags/'.$code.'.png" />';	
	
	}
}

function PricerrTheme_get_user_country($uid)
{
	$opt = get_option('PricerrTheme_en_country_flags');
	
	
	if($opt == 'yes')
	{
		$code = 'us';
		
		$ip = get_user_meta($uid, 'ip_reg', true);
		
		$code = PricerrTheme_get_country_code_of_ip($ip);
		$code = strtolower($code);
		
		if(empty($code)) $code = 'us';
		
		$code = apply_filters('PricerrTheme_code_country_ip', $code);
		
		return $code;	
	
	}
}

/*function Pricerr_sitemile_filter_ttl($title){	global $skm_ttl; return "asd". $skm_ttl;}
function PricerrTheme_template_redirect()
{

	//---------
 
	global $wp;
	global $wp_query, $wp_rewrite, $post;
	$paagee 	=  $wp_query->query_vars['my_custom_page_type'];
	$jb_action 	=  $wp_query->query_vars['jb_action'];
	
	$post_parent = $post->post_parent;
	
	$my_pid = $post->ID;
	$PricerrTheme_post_new_page_id 						= get_option('PricerrTheme_post_new_page_id');
	$PricerrTheme_my_account_page_id					= get_option('PricerrTheme_my_account_page_id');
	$PricerrTheme_my_account_priv_mess_page_id			= get_option('PricerrTheme_my_account_priv_mess_page_id');
	$PricerrTheme_my_account_reviews_page_id			= get_option('PricerrTheme_my_account_reviews_page_id');
	$PricerrTheme_my_account_sales_page_id				= get_option('PricerrTheme_my_account_sales_page_id');
	$PricerrTheme_my_account_shopping_page_id				= get_option('PricerrTheme_my_account_shopping_page_id');
	$PricerrTheme_my_account_payments_page_id			= get_option('PricerrTheme_my_account_payments_page_id');
	$PricerrTheme_my_account_personal_info_page_id		= get_option('PricerrTheme_my_account_personal_info_page_id');
	
	$PricerrTheme_pay_for_posting_job_page_id = get_option('PricerrTheme_pay_for_posting_job_page_id');
	
	global $wp_rewrite;
	
	
	
	
	if($my_pid == $PricerrTheme_my_account_page_id or $post_parent == $PricerrTheme_my_account_page_id or  $PricerrTheme_pay_for_posting_job_page_id == $my_pid)
	{
		if(!is_user_logged_in())	{ wp_redirect(PricerrTheme_login_url()); exit; }	
	}
	
	if(isset($_GET['switch_grd']))
	{
		 
		$_SESSION['view_tp'] = $_GET['switch_grd'];
		wp_redirect($_GET['get_urls']);
		die();
		
	}
	
	if(isset($_GET['switch_filter']))
	{
		 
		$_SESSION['current_order'] = $_GET['switch_filter'];
		wp_redirect($_GET['get_urls']);
		die();
		
	}
	

	//-----------------------------------------------------------------------------------
	if(isset($_GET['posting_new']))
	{
		
		$_SESSION['i_will'] 		= $_POST['i_will'];
		$_SESSION['job_cost'] 		= $_POST['job_cost'];
		
		wp_redirect(get_permalink(get_option('PricerrTheme_post_new_page_id')));
		die();	
	}
	
	
	if ($jb_action == "cancel_job_request")
	{		
		include('lib/cancel_job_request.php');
	    die();	
	}
	
	if ($jb_action == "pay_featured")
	{
		$method = $wp_query->query_vars['method'];
		
		include('lib/gateways/pay_listing_'.$method.'.php');
	    die();	
	}
	
	
	
	if ($jb_action == "user_profile")
	{
		include('lib/user_profile.php');
	    die();	
	}
	
	if ($jb_action == "purchase_this")
	{
		include('lib/purchase-this.php');
	    die();	
	}
	
	
	if ($jb_action == "close_job")
	{
		include('lib/close-job.php');
	    die();	
	}
	
	
	if ($jb_action == "edit_job")
	{
		include('lib/edit_job.php');
	    die();	
	}
	
	
	if ($jb_action == "mark_delivered")
	{
		include('lib/mark_delivered.php');
	    die();	
	}
	
	if ($jb_action == "mark_completed")
	{
		include('lib/mark_completed.php');
	    die();	
	}
	
	
	if ($jb_action == "submit_request")
	{
		include('lib/submit_request.php');
	    die();	
	}
	
	if ($jb_action == "deactivate_job")
	{
		include('lib/deactivate_job.php');
	    die();	
	}
	
	if ($jb_action == "activate_job")
	{
		include('lib/activate_job.php');
	    die();	
	}
	
	if ($jb_action == "chat_box")
	{
		include('lib/chat_box.php');
	    die();	
	}
	
	if ($jb_action == "delete_job")
	{
		include('lib/delete_job.php');
	    die();	
	}
	
	if(!empty($_GET['payment_response_listing']))
	{
		$sk = $_GET['payment_response_listing'];
		include('lib/gateways/listing_response_'.$sk.'.php');
	    die();	
	}
	 
	
	if($jb_action == 'pay_featured_credits' )
	{
		include('lib/gateways/pay_featured_listing_credits.php');
	    die();	
	}
	
	
	
	if (!empty($_GET['payment_response']))
	{
		$sk = $_GET['payment_response'];
		include('lib/gateways/'.$sk.'.php');
	    die();	
	}
	
	if (!empty($_GET['pay_for_item']))
	{
		$sk = $_GET['pay_for_item'];
		include('lib/gateways/'.$sk.'.php');
	    die();	
	}
	
	// check if logged in when access the post new page
	if($my_pid == $PricerrTheme_post_new_page_id)
	{
		if(!is_user_logged_in())	{ wp_redirect(PricerrTheme_login_url()); exit; }
		
		if(!isset($_GET['jobid'])) $set_ad = 1; else $set_ad = 0;
		global $current_user;
		get_currentuserinfo();
		
		if($set_ad == 1)
		{
			$pid 		= PricerrTheme_get_auto_draft($current_user->ID);
			wp_redirect(PricerrTheme_post_new_with_pid_stuff_thg($pid));
		}
		
		include 'lib/post_new_post.php';		
	}
	
	// check if logged in when accessing the my account page
	if($my_pid == $PricerrTheme_my_account_page_id)
	{
		if(!is_user_logged_in())	{ wp_redirect(PricerrTheme_login_url()); exit; }	
	}
	
	
	if ($wp->query_vars["post_type"] == "job")
	{
	     if(is_archive())
		 {
			 include 'archive-job.php';
			 die();
		 }		    
	     elseif (have_posts())
	     {
	         include('job.php');
	         die();
		 }
	     
	 }		

}*/


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_login_url()
{
	return get_bloginfo('siteurl') . "/wp-login.php";
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_variale_cost_dropdown($c = '', $pr = '')
{
	global $wpdb;
	
	$ss = "select * from ".$wpdb->prefix."job_var_costs order by cost asc";
	$r = $wpdb->get_results($ss);
	$c = '<select name="job_cost" class="'.$c.'">';
	
	foreach($r as $row)
	{
		$selected = "";		
		if($row->cost == $pr) $selected = "selected='selected'";
		$c.= '<option value="'.$row->cost.'" '.$selected.'>'.PricerrTheme_get_show_price($row->cost).'</option>';
	}
	
	return $c.'</select>';
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_categories_slug($taxo, $selected = "", $include_empty_option = "", $ccc = "")
{
	$args = "orderby=name&order=ASC&hide_empty=0&parent=0";
	$terms = get_terms( $taxo, $args );
	
	$ret = '<select name="'.$taxo.'_cat" class="'.$ccc.'" id="'.$ccc.'">';
	if(!empty($include_empty_option)){
		
		if($include_empty_option == "1") $include_empty_option = "Select";
	 	$ret .= "<option value=''>".$include_empty_option."</option>";
	 }
	
	if(empty($selected)) $selected = -1;
	
	foreach ( $terms as $term )
	{
		$id = $term->slug;
		$ide = $term->term_id;
		
		$ret .= '<option '.($selected == $id ? "selected='selected'" : " " ).' value="'.$id.'">'.$term->name.'</option>';
		
		$args = "orderby=name&order=ASC&hide_empty=0&parent=".$ide;
		$sub_terms = get_terms( $taxo, $args );	
		
		foreach ( $sub_terms as $sub_term )
		{
			$sub_id = $sub_term->slug; 
			$ret .= '<option '.($selected == $sub_id ? "selected='selected'" : " " ).' value="'.$sub_id.'">&nbsp; &nbsp;|&nbsp;  '.$sub_term->name.'</option>';
			
			$args2 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_id;
			$sub_terms2 = get_terms( $taxo, $args2 );	
			
			foreach ( $sub_terms2 as $sub_term2 )
			{
				$sub_id2 = $sub_term2->term_id; 
				$ret .= '<option '.($selected == $sub_id2 ? "selected='selected'" : " " ).' value="'.$sub_id2.'">&nbsp; &nbsp; &nbsp; &nbsp;|&nbsp;  
				'.$sub_term2->name.'</option>';
			
			}
			
		}
		
	}
	
	$ret .= '</select>';
	
	return $ret;
	
}


function PricerrTheme_get_categories_slug_2_top_header($taxo, $selected = "", $include_empty_option = "", $ccc = "")
{
	$args = "orderby=name&order=ASC&hide_empty=0&parent=0";
	$terms = get_terms( $taxo, $args );
	
	$ret = '<select name="'.$taxo.'_cat" class="'.$ccc.' selectbox" id="'.$ccc.'">';
	if(!empty($include_empty_option)){
		
		if($include_empty_option == "1") $include_empty_option = "Select";
	 	$ret .= "<option value=''>".$include_empty_option."</option>";
	 }
	
	if(empty($selected)) $selected = -1;
	
	foreach ( $terms as $term )
	{
		$id = $term->slug;
		$ide = $term->term_id;
		$term_link = get_term_link( $term, $taxo );

		$ret .= '<option '.($selected == $id ? "selected='selected'" : " " ).' value="'.$id.'" openlink="'.$term_link.'">'.$term->name.'</option>';
		
		$args = "orderby=name&order=ASC&hide_empty=0&parent=".$ide;
		$sub_terms = get_terms( $taxo, $args );	
		
		foreach ( $sub_terms as $sub_term )
		{
			$sub_term_link = get_term_link( $sub_term, $taxo );

			$sub_id = $sub_term->slug; 
			$ret .= '<option '.($selected == $sub_id ? "selected='selected'" : " " ).' value="'.$sub_id.'" openlink="'.$sub_term_link.'">&nbsp; &nbsp;|&nbsp;  '.$sub_term->name.'</option>';
			
			$args2 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_id;
			$sub_terms2 = get_terms( $taxo, $args2 );	
			
			foreach ( $sub_terms2 as $sub_term2 )
			{
				$sub_id2 = $sub_term2->term_id; 
				$ret .= '<option '.($selected == $sub_id2 ? "selected='selected'" : " " ).' value="'.$sub_id2.'" openlink="'.$sub_term_link.'">&nbsp; &nbsp; &nbsp; &nbsp;|&nbsp;  
				'.$sub_term2->name.'</option>';
			
			}
			
		}
		
	}
	
	$ret .= '</select>';
	
	return $ret;
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_show_price_in_front()
{
	$opt = get_option('PricerrTheme_currency_position');	
	if($opt == "front") return true;
	return false;
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_categories($taxo, $selected = "", $include_empty_option = "", $ccc = "")
{
	$args = "orderby=name&order=ASC&hide_empty=0&parent=0";
	$terms = get_terms( $taxo, $args );
	
	$ret = '<select name="'.$taxo.'_cat" class="'.$ccc.'" id="'.$ccc.'">';
	if(!empty($include_empty_option)) $ret .= "<option value=''>".$include_empty_option."</option>";
	
	if(empty($selected)) $selected = -1;
	
	foreach ( $terms as $term )
	{
		$id = $term->term_id;
		
		$ret .= '<option '.($selected == $id ? "selected='selected'" : " " ).' value="'.$id.'">'.$term->name.'</option>';
		
		$args = "orderby=name&order=ASC&hide_empty=0&parent=".$id;
		$sub_terms = get_terms( $taxo, $args );	
		
		foreach ( $sub_terms as $sub_term )
		{
			$sub_id = $sub_term->term_id; 
			$ret .= '<option '.($selected == $sub_id ? "selected='selected'" : " " ).' value="'.$sub_id.'">&nbsp; &nbsp;|&nbsp;  '.$sub_term->name.'</option>';
			
			$args2 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_id;
			$sub_terms2 = get_terms( $taxo, $args2 );	
			
			foreach ( $sub_terms2 as $sub_term2 )
			{
				$sub_id2 = $sub_term2->term_id; 
				$ret .= '<option '.($selected == $sub_id2 ? "selected='selected'" : " " ).' value="'.$sub_id2.'">&nbsp; &nbsp; &nbsp; &nbsp;|&nbsp; 
				 '.$sub_term2->name.'</option>';
			
			}
		}
		
	}
	
	$ret .= '</select>';
	
	return $ret;
	
}



/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_framework_init_widgets()
{
	
	register_sidebar( array(
		'name' => __( 'PricerrTheme - Stretch Wide MainPage Sidebar', 'PricerrTheme' ),
		'id' => 'main-stretch-area',
		'description' => __( 'This sidebar is site wide stretched in home page, just under the main menu area.', 'PricerrTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	register_sidebar( array(
		'name' => __( 'PricerrTheme - Footer Stretch Sidebar', 'PricerrTheme' ),
		'id' => 'footer-stretch-area',
		'description' => __( 'This sidebar is site wide stretched sidebar, just above the footer area.', 'PricerrTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
	register_sidebar( array(
		'name' => __( 'Single Page Sidebar', 'PricerrTheme' ),
		'id' => 'single-widget-area',
		'description' => __( 'The sidebar area of the single blog post', 'PricerrTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
		register_sidebar( array(
		'name' => __( 'Other Page Sidebar', 'PricerrTheme' ),
		'id' => 'other-page-area',
		'description' => __( 'The sidebar area of any other page than the defined ones', 'PricerrTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
	
	register_sidebar( array(
		'name' => __( 'Home Page Sidebar - Right', 'PricerrTheme' ),
		'id' => 'home-right-widget-area',
		'description' => __( 'The right sidebar area of the homepage', 'PricerrTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
	
	register_sidebar( array(
		'name' => __( 'Home Page Sidebar - Left', 'PricerrTheme' ),
		'id' => 'home-left-widget-area',
		'description' => __( 'The left sidebar area of the homepage', 'PricerrTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'PricerrTheme' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'PricerrTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'PricerrTheme' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'PricerrTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'PricerrTheme' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'PricerrTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'PricerrTheme' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'PricerrTheme' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	

		
			register_sidebar( array(
			'name' => __( 'PricerrTheme - Job Single Sidebar', 'PricerrTheme' ),
			'id' => 'job-widget-area',
			'description' => __( 'The sidebar of the single auction page', 'PricerrTheme' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		
			register_sidebar( array(
			'name' => __( 'PricerrTheme - HomePage Area','PricerrTheme' ),
			'id' => 'main-page-widget-area',
			'description' => __( 'The sidebar for the main page, just under the slider.', 'PricerrTheme' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		

	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_i_will_strg()
{
	$opt = get_option('PricerrTheme_i_will_strg');
	if(empty($opt)) return __("I will","PricerrTheme");
	
	return $opt;
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_for_strg()
{
	$opt = get_option('PricerrTheme_for_strg');
	if(empty($opt)) return __("for","PricerrTheme");
	
	return $opt;	
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_admin_notices()
{
    
	if(!function_exists('wp_pagenavi')) {
		echo '<div class="updated">
		   <p>For the <strong>Pricerr Theme</strong> you need to install the wp pagenavi plugin. 
		   Install it from <a href="http://wordpress.org/extend/plugins/wp-pagenavi"><strong>here</strong></a>.</p>
		</div>';
								}
								
	if(!function_exists('bcn_display')) {
		echo '<div class="updated">
		   <p>For the <strong>Pricerr Theme</strong> you need to install the Breadcrumb NavXT plugin. 
		   Install it from <a href="http://wordpress.org/extend/plugins/breadcrumb-navxt/"><strong>here</strong></a>.</p>
		</div>';
								}							
								
								
}
	
	

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_when_job_purchased_4_buyer($oid, $pid, $receiver, $sender = '')
{
	$enable 	= get_option('PricerrTheme_buyer_purchase_job_email_enable');
	$subject 	= get_option('PricerrTheme_buyer_purchase_job_email_subject');
	$message 	= get_option('PricerrTheme_buyer_purchase_job_email_message');	
	
	if($enable != "no"):

		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$receiver 	= get_userdata($receiver);
		$sender 	= get_userdata($sender);
		$cnv_lnk	= get_bloginfo('siteurl') . "/?jb_action=chat_box&oid=" . $oid ;
		
		$post 		= get_post($pid);
		$job_name 	= PricerrTheme_wrap_the_title($post->post_title, $pid);
		$job_link 	= get_permalink($pid);
		
		$find 		= array('##receiver_username##', '##sender_username##', '##conversation_page_link##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , 
		'##my_account_url##', '##job_link##', '##job_name##');
   		$replace 	= array($receiver->user_login, $sender->user_login,  $cnv_lnk, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $job_link, $job_name);
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $receiver->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_when_job_purchased_4_seller($oid, $pid, $receiver, $sender = '')
{
	$enable 	= get_option('PricerrTheme_seller_purchase_job_email_enable');
	$subject 	= get_option('PricerrTheme_seller_purchase_job_email_subject');
	$message 	= get_option('PricerrTheme_seller_purchase_job_email_message');	
	
	if($enable != "no"):

		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$receiver 	= get_userdata($receiver);
		$sender 	= get_userdata($sender);
		$cnv_lnk	= get_bloginfo('siteurl') . "/?jb_action=chat_box&oid=" . $oid ;
		
		$post 		= get_post($pid);
		$job_name 	= PricerrTheme_wrap_the_title($post->post_title, $pid);
		$job_link 	= get_permalink($pid);
		
		$find 		= array('##receiver_username##', '##sender_username##', '##conversation_page_link##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , 
		'##my_account_url##', '##job_link##', '##job_name##');
   		$replace 	= array($receiver->user_login, $sender->user_login,  $cnv_lnk, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $job_link, $job_name);
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $receiver->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_when_buyer_closes_the_job($oid, $pid, $receiver, $sender = '')
{
	$enable 	= get_option('PricerrTheme_order_closed_by_seller_email_enable');
	$subject 	= get_option('PricerrTheme_order_closed_by_seller_email_subject');
	$message 	= get_option('PricerrTheme_order_closed_by_seller_email_message');	
	
	if($enable != "no"):

		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$receiver 	= get_userdata($receiver);
		$sender 	= get_userdata($sender);
		$cnv_lnk	= get_bloginfo('siteurl') . "/?jb_action=chat_box&oid=" . $oid ;
		
		$post 		= get_post($pid);
		$job_name 	= PricerrTheme_wrap_the_title($post->post_title, $pid);
		$job_link 	= get_permalink($pid);
		
		$find 		= array('##receiver_username##', '##sender_username##', '##conversation_page_link##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , 
		'##my_account_url##', '##job_link##', '##job_name##');
   		$replace 	= array($receiver->user_login, $sender->user_login,  $cnv_lnk, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $job_link, $job_name);
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $receiver->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_when_withdraw_requested($receiver, $method, $amount)
{
	$enable 	= get_option('PricerrTheme_withdraw_request_email_enable');
	$subject 	= get_option('PricerrTheme_withdraw_request_email_subject');
	$message 	= get_option('PricerrTheme_withdraw_request_email_message');	
	
	if($enable != "no"):

		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$receiver 	= get_userdata($receiver);

		
		$find 		= array('##username##', '##conversation_page_link##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , 
		'##my_account_url##', '##amount_withdrawn##', '##withdraw_method##');
   		$replace 	= array($receiver->user_login,  $cnv_lnk, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $amount, $method);
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $receiver->user_email; 
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_when_withdraw_completed($receiver, $method, $amount)
{
	$enable 	= get_option('PricerrTheme_withdraw_released_email_enable');
	$subject 	= get_option('PricerrTheme_withdraw_released_email_subject');
	$message 	= get_option('PricerrTheme_withdraw_released_email_message');	
	
	if($enable != "no"):

		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$receiver 	= get_userdata($receiver);


		
		$find 		= array('##username##', '##conversation_page_link##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , 
		'##my_account_url##', '##amount_withdrawn##', '##withdraw_method##');
   		$replace 	= array($receiver->user_login,  $cnv_lnk, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $amount, $method);
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $receiver->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_when_withdraw_rejected($receiver, $method, $amount)
{
	$enable 	= get_option('PricerrTheme_withdraw_rejected_email_enable');
	$subject 	= get_option('PricerrTheme_withdraw_rejected_email_subject');
	$message 	= get_option('PricerrTheme_withdraw_rejected_email_message');	
	
	if($enable != "no"):

		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$receiver 	= get_userdata($receiver);

		
		$find 		= array('##username##', '##conversation_page_link##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , 
		'##my_account_url##', '##amount_withdrawn##', '##withdraw_method##');
   		$replace 	= array($receiver->user_login,  $cnv_lnk, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $amount, $method);
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $receiver->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_send_email_posted_job_not_approved($pid)
{
	$enable 	= get_option('PricerrTheme_new_job_email_not_approved_enable');
	$subject 	= get_option('PricerrTheme_new_job_email_not_approved_subject');
	$message 	= get_option('PricerrTheme_new_job_email_not_approved_message');	
	
	if($enable != "no"):
	
		$post 			= get_post($pid);
		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		$job_name 	= PricerrTheme_wrap_the_title($post->post_title, $pid);

		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##job_name##', '##job_link##');
   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $job_name, get_permalink($pid));
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $user->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
	
	endif;		
	
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_posted_job_approved($pid)
{
	$enable 	= get_option('PricerrTheme_new_job_email_approved_enable');
	$subject 	= get_option('PricerrTheme_new_job_email_approved_subject');
	$message 	= get_option('PricerrTheme_new_job_email_approved_message');	
	
	if($enable != "no"):
	
		$post 			= get_post($pid);
		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$post 		= get_post($pid);
		$job_name 	= PricerrTheme_wrap_the_title($post->post_title, $pid);
		$job_link 	= get_permalink($pid);

		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##job_name##', '##job_link##');
   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $job_name, $job_link);
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $user->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_when_job_completed($oid, $pid, $receiver, $sender = '')
{
	$enable 	= get_option('PricerrTheme_job_completed_email_enable');
	$subject 	= get_option('PricerrTheme_job_completed_email_subject');
	$message 	= get_option('PricerrTheme_job_completed_email_message');	
	
	if($enable != "no"):

		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$receiver 	= get_userdata($receiver);
		$cnv_lnk	= get_bloginfo('siteurl') . "/?jb_action=chat_box&oid=" . $oid ;
		
		$post 		= get_post($pid);
		$job_name 	= PricerrTheme_wrap_the_title($post->post_title, $pid);
		$job_link 	= get_permalink($pid);
		
		$find 		= array('##receiver_username##', '##conversation_page_link##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , 
		'##my_account_url##', '##job_link##', '##job_name##');
   		$replace 	= array($receiver->user_login,  $cnv_lnk, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $job_link, $job_name);
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $receiver->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_when_job_delivered($oid, $pid, $receiver, $sender = '')
{
	$enable 	= get_option('PricerrTheme_job_finished_email_enable');
	$subject 	= get_option('PricerrTheme_job_finished_email_subject');
	$message 	= get_option('PricerrTheme_job_finished_email_message');	
	
	if($enable != "no"):

		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$receiver 	= get_userdata($receiver);
		$cnv_lnk	= get_bloginfo('siteurl') . "/?jb_action=chat_box&oid=" . $oid ;
		
		$post 		= get_post($pid);
		$job_name 	= PricerrTheme_wrap_the_title($post->post_title, $pid);
		$job_link 	= get_permalink($pid);
		
		$find 		= array('##receiver_username##', '##conversation_page_link##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , 
		'##my_account_url##', '##job_link##', '##job_name##');
   		$replace 	= array($receiver->user_login,  $cnv_lnk, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $job_link, $job_name);
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $receiver->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_when_new_PM($sender, $receiver, $subject2 = '', $message = '')
{
	$enable 	= get_option('PricerrTheme_private_message_email_enable');
	$subject 	= get_option('PricerrTheme_private_message_email_subject');
	$message 	= get_option('PricerrTheme_private_message_email_message');	
	
	if($enable != "no"):

		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$receiver 	= get_userdata($receiver);
		$sender 	= get_userdata($sender);
		$cnv_lnk	= get_permalink(get_option('PricerrTheme_my_account_priv_mess_page_id'));

		
		$find 		= array('##receiver_username##', '##sender_username##', '##private_mess_page_link##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , 
		'##my_account_url##', '##subject_of_message##', '##message##');
   		$replace 	= array($receiver->user_login, $sender->user_login, $cnv_lnk, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $subject2, $message);
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $receiver->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_when_feedback_left($pid, $sender, $receiver)
{
	$enable 	= get_option('PricerrTheme_feedback_received_seller_email_enable');
	$subject 	= get_option('PricerrTheme_feedback_received_seller_email_subject');
	$message 	= get_option('PricerrTheme_feedback_received_seller_email_message');	
	
	if($enable != "no"):

		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$receiver 	= get_userdata($receiver);
		$sender 	= get_userdata($sender);
		$cnv_lnk	= get_permalink(get_option('PricerrTheme_my_account_priv_mess_page_id'));
		
		$post 		= get_post($pid);
		$job_name 	= PricerrTheme_wrap_the_title($post->post_title, $pid);
		$job_link 	= get_permalink($pid);
		
		$find 		= array('##receiver_username##', '##sender_username##', '##private_mess_page_link##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , 
		'##my_account_url##', '##job_link##', '##job_name##');
   		$replace 	= array($receiver->user_login, $sender->user_login, $cnv_lnk, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $job_link, $job_name);
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $receiver->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_when_new_chat($pid, $oid, $sender, $receiver, $message = '')
{
	$enable 	= get_option('PricerrTheme_chat_order_email_enable');
	$subject 	= get_option('PricerrTheme_chat_order_email_subject');
	$message 	= get_option('PricerrTheme_chat_order_email_message');	
	
	if($enable != "no"):
	
		$post 			= get_post($pid);
		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		
		$receiver 	= get_userdata($receiver);
		$sender 	= get_userdata($sender);
		$cnv_lnk	= get_bloginfo('siteurl') . "/?jb_action=chat_box&oid=" . $oid ;
		
		$postttl = PricerrTheme_wrap_the_title($post->post_title, $pid);
		
		$find 		= array('##receiver_username##', '##sender_username##', '##conversation_page_link##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##job_name##', '##job_link##');
   		$replace 	= array($receiver->user_login, $sender->user_login, $cnv_lnk, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $postttl, get_permalink($pid));
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = $receiver->user_email;
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
		
	endif;		
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_posted_job_not_approved_admin($pid)
{
	$enable 	= get_option('PricerrTheme_new_job_email_not_approve_admin_enable');
	$subject 	= get_option('PricerrTheme_new_job_email_not_approve_admin_subject');
	$message 	= get_option('PricerrTheme_new_job_email_not_approve_admin_message');	
	
	if($enable != "no"):
	
		$post 			= get_post($pid);
		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		

		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##job_name##', '##job_link##');
   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = get_bloginfo('admin_email');
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
	
	endif;	
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_send_email_posted_job_approved_admin($pid)
{
	$enable 	= get_option('PricerrTheme_new_job_email_approve_admin_enable');
	$subject 	= get_option('PricerrTheme_new_job_email_approve_admin_subject');
	$message 	= get_option('PricerrTheme_new_job_email_approve_admin_message');	
	
	if($enable != "no"):
	
		$post 			= get_post($pid);
		$user 			= get_userdata($post->post_author);
		$site_login_url = PricerrTheme_login_url();
		$site_name 		= get_bloginfo('name');
		$account_url 	= get_permalink(get_option('PricerrTheme_my_account_page_id'));
		

		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##job_name##', '##job_link##');
   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
		$message 	= PricerrTheme_replace_stuff_for_me($find, $replace, $message);
		$subject 	= PricerrTheme_replace_stuff_for_me($find, $replace, $subject);
		
		//---------------------------------------------
		
		$email = get_bloginfo('admin_email');
		PricerrTheme_send_email($email, stripslashes($subject), stripslashes($message));
	
	endif;
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function  PricerrTheme_replace_stuff_for_me($find, $replace, $subject)
{
	$i = 0;
	foreach($find as $item)
	{
		$replace_with = $replace[$i];
		$subject = str_replace($item, $replace_with, $subject);	
		$i++;
	}
	
	return $subject;
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_users_links()
{
	
	global $wpdb, $post, $wp_rewrite, $wp_query, $current_user;
	$current_page = $wp_query->query_vars['my_second_page'];
	
	get_currentuserinfo();
		
	$my_pid = $post->ID;
	$payments_id 	= get_option('PricerrTheme_my_account_payments_page_id');
	$account_id 	= get_option('PricerrTheme_my_account_page_id');
	$shopping_id 	= get_option('PricerrTheme_my_account_shopping_page_id');
	$sales_id 		= get_option('PricerrTheme_my_account_sales_page_id');
	$priv_mess_id	= get_option('PricerrTheme_my_account_priv_mess_page_id');
	$pers_id		= get_option('PricerrTheme_my_account_personal_info_page_id');
	$rev_id			= get_option('PricerrTheme_my_account_reviews_page_id');
	
	if(empty($current_page)) $current_page = 'home';
	
	 
	$uid = $current_user->ID;
									$pricerrTheme_get_unread_number_messages = pricerrTheme_get_unread_number_messages($uid);
									
									if($pricerrTheme_get_unread_number_messages > 0) $sk = ' <span class="the_one_mess">'.$pricerrTheme_get_unread_number_messages.'</span>';
									else $sk = '';
	
?>
	
    	<div id="right-sidebar">
		<ul class="xoxo">
		<li class="widget-container widget_text" id="my-account-menu">
        			
          
          <ul id="my-account-admin-menu">
         
              <li><a href="<?php echo get_permalink($account_id); ?>" <?php	if($account_id == $my_pid) echo "class='active_link'"; ?>><?php _e("My Jobs",'PricerrTheme');?></a></li>
              <li><a href="<?php echo get_permalink($payments_id); ?>" <?php	if($payments_id == $my_pid) echo "class='active_link'"; ?>><?php _e("Payments",'PricerrTheme');?></a></li>                    
              <li><a href="<?php echo get_permalink($shopping_id); ?>" <?php	if($shopping_id == $my_pid) echo "class='active_link'"; ?>><?php  _e("Shopping",'PricerrTheme');?></a></li>
              <li><a href="<?php echo get_permalink($sales_id); ?>" <?php	if($sales_id == $my_pid) echo "class='active_link'"; ?>><?php _e("Manage Sales",'PricerrTheme');?></a></li>                  
              <li><a href="<?php echo get_permalink($priv_mess_id); ?>" <?php	if($priv_mess_id == $my_pid) echo "class='active_link'"; ?>><?php printf(__("Private Messages %s",'PricerrTheme'), $sk);?></a></li>          
              <li><a href="<?php echo get_permalink($pers_id); ?>" <?php	if($pers_id == $my_pid) echo "class='active_link'"; ?>><?php _e("Personal Info",'PricerrTheme');?></a></li>
              <li><a href="<?php echo get_permalink($rev_id); ?>" <?php	if($rev_id == $my_pid) echo "class='active_link'"; ?>><?php _e("Reviews/Feedback",'PricerrTheme');?></a></li>
          	  <?php  do_action('PricerrTheme_my_account_main_menu');  ?>
             
          </ul>
           
		
        </li>
            
     <?php dynamic_sidebar( 'other-page-area' ); ?>
            
        </ul>
		</div>
		

<?php
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function pricerrTheme_nr_active_jobs($uid)
{	
	$meta = array(
		'key' => 'active',
		'value' => "1",
		//'type' => 'numeric',
		'compare' => '='
	);

	$args = array( 'posts_per_page' =>'-1', 'post_type' => 'job',  'author' => $uid , 'meta_query' => array($meta));
	$q = new WP_Query( $args );
	
	return $q->post_count;
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function pricerrTheme_nr_inactive_jobs($uid)
{
	$meta = array(
			'key' => 'active',
			'value' => "0",
			//'type' => 'numeric',
			'compare' => '='
		);
	
	$args = array( 'posts_per_page' =>'-1', 'post_status'=> array('draft','publish'), 'post_type' => 'job', 'author' => $uid, 'meta_query' => array($meta));
	$q = new WP_Query( $args );
	
	return $q->post_count;
	
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function pricerrTheme_nr_in_review_jobs($uid)
{
	$meta = array(
			'key' => 'under_review',
			'value' => "1",
			//'type' => 'numeric',
			'compare' => '='
		);
	
	$args = array( 'posts_per_page' =>'-1', 'post_status'=>'draft', 'post_type' => 'job', 'author' => $uid, 'meta_query' => array($meta));
	$q = new WP_Query( $args );
	
	return $q->post_count;
	
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_post_small( $arr = '')
{

			if($arr[0] == "winner") $pay_this_me = 1;
			if($arr[0] == "unpaid") $unpaid = 1;

			$ending 		= get_post_meta(get_the_ID(), 'ending', true);
			$sec 			= $ending - time();	
			$closed 		= get_post_meta(get_the_ID(), 'closed', true);
			$active 		= get_post_meta(get_the_ID(), 'active', true);
			
			$featured 		= get_post_meta(get_the_ID(), 'featured', true);
			$paid	 		= get_post_meta(get_the_ID(), 'paid', true);
			
			$post 			= get_post(get_the_ID());
			$featured 		= get_post_meta(get_the_ID(), 'featured', true);			
			$under_review 	= get_post_meta(get_the_ID(), "under_review", true);

			$img_class = "image_class";
			$post = get_post(get_the_ID());
			
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			
			
?>
				<div class="post" id="post-<?php the_ID(); ?>">
                
                 <?php if($featured == "1"): ?>
                <div class="featured-four"></div>
                <?php endif; ?>
                
                <div class="padd10_only">
                <div class="image_holder3">
                <a href="<?php the_permalink(); ?>"><img width="65" height="50" class="<?php echo $img_class; ?>" 
                src="<?php echo PricerrTheme_get_first_post_image(get_the_ID(),65,50); ?>" /></a>
                </div>
                <div  class="title_holder3" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php the_title(); ?></a></h2><br/>
                        
                   <?php if($under_review == "1"): ?><span class="pending_review"><?php _e('Pending Review','PricerrTheme'); ?></span><?php endif; ?> 
                   
                   
                    <?php 
					
					$PricerrTheme_new_job_listing_fee 	= get_option('PricerrTheme_new_job_listing_fee'); 
					
					if($PricerrTheme_new_job_listing_fee > 0 and $paid == "0"): ?><span class="pending_review"><?php _e('Listing fee not paid','PricerrTheme'); ?></span><?php endif; ?> 
                   
                    <a href="<?php bloginfo('siteurl'); ?>/?jb_action=delete_job&jobid=<?php the_ID(); ?>" class="del_job"><?php _e('Delete Job','PricerrTheme'); ?></a> 
                    <a href="<?php bloginfo('siteurl'); ?>/?jb_action=edit_job&jobid=<?php the_ID(); ?>" class="edit_job"><?php _e('Edit Job','PricerrTheme'); ?></a> 
                    
                  <?php
				  if($active == "1"):
				  ?>  
                 <a href="<?php bloginfo('siteurl'); ?>/?jb_action=deactivate_job&jobid=<?php the_ID(); ?>" class="deactivate_job"><?php _e('Deactivate Job','PricerrTheme'); ?></a> 
                  <?php else: ?>
                 
                 <a href="<?php bloginfo('siteurl'); ?>/?jb_action=activate_job&jobid=<?php the_ID(); ?>" class="deactivate_job"><?php _e('Activate Job','PricerrTheme'); ?></a>  
                  
                  <?php endif; ?>  
                    <?php //<a href="#" class="show_status"><?php _e('Show Status','PricerrTheme'); 
					//</a> -->
					?>
          <?php
		  
		  $using_permalinks = PricerrTheme_using_permalinks();
				
			if($using_permalinks) $rdrlnk = get_permalink(get_option('PricerrTheme_pay_for_posting_job_page_id'))."?jobid=".get_the_ID();
			else $rdrlnk = get_bloginfo('siteurl')."/?page_id=".get_option('PricerrTheme_pay_for_posting_job_page_id')."&jobid=".get_the_ID();
		  
		  if($post->post_status == "draft" && $featured == "1" && $paid == "0") 
		  echo '<div class="not-published-yet">'.sprintf(__('Your job is not published yet. Please <b><a href="%s">pay the featured fee</a></b> to publish.','PricerrTheme'), $rdrlnk).'</div>';
		  
		  
		  ?>
                  </div></div></div>
<?php
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_small_post()
{
			$ending = get_post_meta(get_the_ID(), 'ending', true);
			$sec 	= $ending - time();
			$location 	= get_post_meta(get_the_ID(), 'Location', true);
			$featured 	= get_post_meta(get_the_ID(), 'featured', true);
			

			$price = get_post_meta(get_the_ID(), 'price', true);			
			$closed = get_post_meta(get_the_ID(), 'closed', true);
			
?>
				<div class="post" id="post-<?php the_ID(); ?>">
                <div class="image_holder2">
                
				<?php if($featured == "1"): ?>
                <div class="featured-three"></div>
                <?php endif; ?>
                
                <a href="<?php the_permalink(); ?>"><img width="62" height="50" class="image_class" 
                src="<?php echo PricerrTheme_get_first_post_image2(get_the_ID(), 'my_small_thumbnail_pricerr'); ?>" /></a>
                </div>
                <div  class="title_holder2" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php the_title(); ?></a></h2>
                        
                        <p class="mypostedon2">
                        <?php _e("Posted in",'PricerrTheme');?> <?php echo get_the_term_list( get_the_ID(), 'job_cat', '', ', ', '' ); ?></p>
                       
                     
                
                     
                     </div></div> <?php	
}	
	

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_first_post_image($pid, $w = 100, $h = 100)
{
	
	//---------------------
	// build the exclude list
	$exclude = array();
	
	$args = array(
	'order'          => 'ASC',
	'post_type'      => 'attachment',
	'post_parent'    => get_the_ID(),
	'meta_key'		 => 'another_reserved1',
	'meta_value'	 => '1',
	'numberposts'    => -1,
	'post_status'    => null,
	);
	$attachments = get_posts($args);
	if ($attachments) {
	    foreach ($attachments as $attachment) {
		$url = $attachment->ID;
		array_push($exclude, $url);
	}
	}
	
	//-----------------

	$args = array(
	'order'          => 'ASC',
	'orderby'        => 'post_date',
	'post_type'      => 'attachment',
	'post_parent'    => $pid,
	'exclude'    		=> $exclude,
	'post_mime_type' => 'image',
	'post_status'    => null,
	'numberposts'    => 1,
	);
	$attachments = get_posts($args);
	if ($attachments) {
	    foreach ($attachments as $attachment) 
	    {
			$url = wp_get_attachment_url($attachment->ID);
			return PricerrTheme_generate_thumb($url, $w, $h);	  
		}
	}
	else	return get_bloginfo('template_url').'/images/nopic.jpg';

}


function PricerrTheme_get_first_post_image2($pid, $image_string_name)
{
	
	//---------------------
	// build the exclude list
	$exclude = array();
	
	$args = array(
	'order'          => 'ASC',
	'post_type'      => 'attachment',
	'post_parent'    => get_the_ID(),
	'meta_key'		 => 'another_reserved1',
	'meta_value'	 => '1',
	'numberposts'    => -1,
	'post_status'    => null,
	);
	$attachments = get_posts($args);
	if ($attachments) {
	    foreach ($attachments as $attachment) {
		$url = $attachment->ID;
		array_push($exclude, $url);
	}
	}
	
	//-----------------

	$args = array(
	'order'          => 'ASC',
	'orderby'        => 'post_date',
	'post_type'      => 'attachment',
	'post_parent'    => $pid,
	'exclude'    		=> $exclude,
	'post_mime_type' => 'image',
	'post_status'    => null,
	'numberposts'    => 1,
	);
	$attachments = get_posts($args);
	if ($attachments) {
	    foreach ($attachments as $attachment) 
	    {
			$url = wp_get_attachment_url($attachment->ID);
			return pricerrtheme_generate_thumb3($attachment->ID, $image_string_name);	  
		}
	}
	else	return get_bloginfo('template_url').'/images/nopic.jpg';

}



function PricerrTheme_get_first_post_image_ID($pid)
{
	
	//---------------------
	// build the exclude list
	$exclude = array();
	
	$args = array(
	'order'          => 'ASC',
	'post_type'      => 'attachment',
	'post_parent'    => get_the_ID(),
	'meta_key'		 => 'another_reserved1',
	'meta_value'	 => '1',
	'numberposts'    => -1,
	'post_status'    => null,
	);
	$attachments = get_posts($args);
	if ($attachments) {
	    foreach ($attachments as $attachment) {
		$url = $attachment->ID;
		array_push($exclude, $url);
	}
	}
	
	//-----------------

	$args = array(
	'order'          => 'ASC',
	'orderby'        => 'post_date',
	'post_type'      => 'attachment',
	'post_parent'    => $pid,
	'exclude'    		=> $exclude,
	'post_mime_type' => 'image',
	'post_status'    => null,
	'numberposts'    => 1,
	);
	$attachments = get_posts($args);
	if ($attachments) {
	    foreach ($attachments as $attachment) 
	    {
			return $attachment->ID;	  
		}
	}
	else	return false;

}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_generate_thumb($img_url, $width, $height, $cut = true)
{

	
	require_once(ABSPATH . '/wp-admin/includes/image.php');
	$uploads = wp_upload_dir();
	$basedir = $uploads['basedir'].'/';
	$exp = explode('/',$img_url);
	
	$nr = count($exp);
	$pic = $exp[$nr-1];
	$year = $exp[$nr-3];
	$month = $exp[$nr-2];

	if($uploads['basedir'] == $uploads['path'])
	{
		$img_url = $basedir.'/'.$pic;
		$ba = $basedir.'/';
		$iii = $uploads['url'];
	}
	else
	{
		$img_url = $basedir.$year.'/'.$month.'/'.$pic;
		$ba = $basedir.$year.'/'.$month.'/';
		$iii = $uploads['baseurl']."/".$year."/".$month;
	}
	list($width1, $height1, $type1, $attr1) = getimagesize($img_url);
	
	//return $height;
	$a = false;
	if($width == -1)
	{
		$a = true;
	
	}


	if($width > $width1) $width = $width1-1;
	if($height > $height1) $height = $height1-1;

	if($a == true)
	{
		$prop = $width1 / $height1;
		$width = round($prop * $height);
	}
	
		$width = $width-1;
	$height = $height-1;
	
	
	$xxo = "-".$width."x".$height;
	$exp = explode(".", $pic);
	$new_name = $exp[0].$xxo.".".$exp[1];
	
	$tgh = str_replace("//","/",$ba.$new_name);

	if(file_exists($tgh)) return $iii."/".$new_name;	



	$thumb = image_resize($img_url,$width,$height,$cut);
	
	if(is_wp_error($thumb)) return "is-wp-error";
	
	$exp = explode($basedir, $thumb);	
    return $uploads['baseurl']."/".$exp[1]; 
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_show_bought($row)
{

			
			$pid 			= $row->pid;
			$post 			= get_post($row->pid);
			$max_days 		= get_post_meta($row->pid, 'max_days', true);
			$date_made 		= $row->date_made;
			$bought 		= date_i18n("D jS \of F Y", $date_made);
			$expected 		= date_i18n("D jS \of F Y", $date_made + (24*3600 * $max_days) );
			$done_seller 	= $row->done_seller;
			$closed 		= $row->closed;
			
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			$user = $row->uid;
			$user = get_userdata($user);
			
			$completed = 0;
			if($row->done_buyer == 1) $completed = 1;
			$id = $row->id;
			
			$delivered = 0;
			if($row->done_seller == 1) $delivered = 1;
			
			$can_be_closed = 0;
			
			if($uid == $row->uid)
			{
				$date_made 	= $row->date_made;
				$max_days	= get_post_meta($row->pid, 'max_days', true) * 3600 * 24;
				$now 		= current_time('timestamp',0);
				
				if($date_made + $max_days < $now)				
				$can_be_closed = 1;
			}
				
			
				if($row->closed == 1) $can_be_closed = 0;
				if($row->completed == 1) $can_be_closed = 0;
?>
				<div class="post" id="post-<?php the_ID(); ?>">
                <div class="padd10_only">
                <div class="image_holder3">
                <a href="<?php echo get_permalink($pid); ?>"><img width="65" height="50" class="<?php echo $img_class; ?>" 
                src="<?php echo PricerrTheme_get_first_post_image($pid,65,50); ?>" /></a>
                </div>
                <div  class="title_holder3" > 
                     <h2><a href="<?php echo get_permalink($pid); ?>" rel="bookmark" title="">
                        <?php 
                        
                        echo PricerrTheme_wrap_the_title($post->post_title, $pid);
                        
                        ?></a>
                         <?php
						
							
						$days_needed 	= get_post_meta($pid,'max_days',true);
						$instant 		= get_post_meta($pid,'instant',true);
						
						
						if($instant 	== 1) echo '<span class="instant_job_spn">'.__('Instant Delivery','PricerrTheme').'</span>';
						else if($days_needed == 1) echo '<span class="express_job_spn">'.__('Express Job','PricerrTheme').'</span>'; 
						
						?>
                        
                        
                        </h2>
                        <div class="sold_on"><?php echo sprintf(__("Purchased on %s","PricerrTheme"), $bought); ?>
                        &diams; <?php echo sprintf(__("Expected Delivery: %s","PricerrTheme"), $expected); ?> &diams; <?php echo sprintf(__("Order ID: #%s","PricerrTheme"), $row->id); ?> </div>
                     
                     
                     <?php if($completed == 0 && $done_seller == 1 && $closed != 1): ?>
                   		<a href="<?php echo get_bloginfo('siteurl'); ?>/?jb_action=mark_completed&oid=<?php echo $row->id; ?>" 
                        class="show_status"><?php _e("Mark Completed","PricerrTheme"); ?></a>
                     <?php elseif($delivered != 1 && $closed != 1): ?>
                     
                    <span style="font-size:10px;"><em> <?php _e('Waiting for the seller to deliver.','PricerrTheme'); ?>   </em></span>
                        
                     <?php endif; ?>  
                     
                     <?php if($can_be_closed == 1): ?>
                   		<a href="<?php echo get_bloginfo('siteurl'); ?>/?jb_action=close_job&orderid=<?php echo $row->id; ?>" 
                        class="show_status"><?php _e("Cancel Job","PricerrTheme"); ?></a>
                     <?php endif; ?>  
                     <?php
					 
					$using_perm = PricerrTheme_using_permalinks();
	
					if($using_perm)	$privurl_m = get_permalink(get_option('PricerrTheme_my_account_priv_mess_page_id')). "/?";
					else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('PricerrTheme_my_account_priv_mess_page_id'). "&";	
					 
					 
					 ?>
                      
                   <a href="<?php echo $privurl_m; ?>priv_act=send&pid=<?php echo $row->pid; ?>&uid=<?php echo $post->post_author; ?>" 	class="show_status"><?php _e("Contact Seller","PricerrTheme"); ?></a>
                      
                        <a href="<?php bloginfo('siteurl'); ?>/?jb_action=chat_box&oid=<?php echo $row->id; ?>" class="show_buyer_notes" rel="<?php echo $id; ?>"><?php _e("Conversation Page","PricerrTheme"); ?></a>
                        
          				<br/><br/>
                       <?php
					   
					   	$instruction_box = get_post_meta($pid, 'instruction_box', true);
						if(!empty($instruction_box))
						{
							echo ' '.sprintf(__('Instructions for the buyer: %s','PricerrTheme'), 	$instruction_box). " <br/>";	
							
						}
						
						$instant = get_post_meta($pid, 'instant', true);
						if($instant == "1")
						{
							$args = array(
										'order'          => 'ASC',
										'orderby'        => 'post_date',
										'post_type'      => 'attachment',
										'post_parent'    => $pid,
										'post_mime_type' => 'application/zip',
										'numberposts'    => -1,
										); $i = 0;
										
										$attachments = get_posts($args);
										
										if ($attachments) {
											foreach ($attachments as $attachment) {
												$url = wp_get_attachment_url($attachment->ID);
												$dnls = "<a href='".$url."' target='_blank'>".$attachment->post_title."</a>";
											}}
							
							echo ' '.sprintf(__('Download File: <b>%s</b>','PricerrTheme'), 	$dnls). " <br/>";	
							
						}
						
					   	
						if($row->extra1 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra1_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra1_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra2 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra2_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra2_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra3 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra3_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra3_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra4 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra4_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra4_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra5 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra5_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra5_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra6 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra6_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra6_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra7 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra7_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra7_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra8 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra8_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra8_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra9 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra9_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra9_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra10 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra10_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra10_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						
						
						
						
					   ?> 
          
                  </div></div></div>
<?php

}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_shooping_active_nr($uid)
{
	global $wpdb; $prefix = $wpdb->prefix;
	$s = "select id from ".$prefix."job_orders where uid='$uid' AND done_seller='0' AND done_buyer='0' AND date_finished='0' AND closed='0'";
			
	$r = $wpdb->get_results($s);	
	return count($r);
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_shooping_review_nr($uid)
{
	global $wpdb; $prefix = $wpdb->prefix;
	$s = "select id from ".$prefix."job_orders where uid='$uid' AND done_seller='1' AND done_buyer='0' AND closed='0'";
			
	$r = $wpdb->get_results($s);	
	return count($r);
	
	
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_shooping_cancelled_nr($uid)
{
	
	global $wpdb; $prefix = $wpdb->prefix;
	$s = "select id from ".$prefix."job_orders where uid='$uid' AND closed='1' order by id desc";
			
	$r = $wpdb->get_results($s);	
	return count($r);
	
	
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_shooping_completed_nr($uid)
{
	global $wpdb; $prefix = $wpdb->prefix;
	$s = "select id from ".$prefix."job_orders where uid='$uid' AND completed='1' order by id desc";
			
	$r = $wpdb->get_results($s);	
	return count($r);
	
	
	
}



/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_show_sale($row)
{

			$pid 		= $row->pid;
			$post 		= get_post($row->pid);
			$max_days 	= get_post_meta($pid, 'max_days', true);
			$date_made 	= $row->date_made;
			$sold 		= date("D jS \of F Y", $date_made);
			$expected 	= date("D jS \of F Y", $date_made + (24*3600 * $max_days) );
			
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			$delivered = 0;
			if($row->done_seller == 1) $delivered = 1;
			$id = $row->id;
			
			$closed = $row->closed;
	 		
			$completed = 0;
			if($row->done_buyer == 1) $completed = 1;
			
			//---------------------------------
			
			
?>
				<div class="post" id="post-<?php echo $id; ?>">
                <div class="padd10_only">
                <div class="image_holder3">
                <a href="<?php the_permalink(); ?>"><img width="65" height="50" class="<?php echo $img_class; ?>" 
                src="<?php echo PricerrTheme_get_first_post_image($pid,65,50); ?>" /></a>
                </div>
                <div  class="title_holder3" > 
                     <h2>
                     
                       <?php
						
							
						$days_needed 	= get_post_meta($pid,'max_days',true);
						$instant 		= get_post_meta($pid,'instant',true);
						
						if($days_needed == 1) echo '<span class="express_job_spn">'.__('Express Job','PricerrTheme').'</span>'; 
						if($instant 	== 1) echo '<span class="instant_job_spn">'.__('Instant Delivery','PricerrTheme').'</span>';
						
						
						?>
                     
                     <a href="<?php echo get_permalink($pid); ?>" rel="bookmark" title="">
                        <?php 
                        
                        echo PricerrTheme_wrap_the_title($post->post_title, $pid);
                        
                        ?></a> 
                        
                      
                        
                        </h2>
                        <div class="sold_on"><?php echo sprintf(__("Sold on: %s","PricerrTheme"), $sold); ?> &diams; 
						<?php echo sprintf(__(" Expected Delivery: %s","PricerrTheme"), $expected); ?> &diams; <?php echo sprintf(__("Order ID: #%s","PricerrTheme"), $row->id); ?>
                         </div>
                     
                     	<?php if($delivered == 0 && $closed != 1): ?>
                        <a href="<?php echo get_bloginfo('siteurl'); ?>/?jb_action=mark_delivered&oid=<?php echo $row->id; ?>" 
                        class="show_status"><?php _e("Mark as Delivered","PricerrTheme"); ?></a>
                        
                        
                        <a href="#" class="show_status cancel_order" rel="<?php echo $row->id; ?>"><?php _e("Cancel Order","PricerrTheme"); ?></a>
                        
                        <?php elseif($completed != 1 && $closed != 1): ?>
                        
                        <span style="font-size:10px;"><em> <?php _e('Waiting for the buyer to confirm.','PricerrTheme'); ?>   </em></span>
                        
                        <?php endif; ?>
                        
                        <a href="<?php echo get_permalink(get_option('PricerrTheme_my_account_priv_mess_page_id')); ?>?priv_act=send&pid=<?php echo $row->pid; ?>&uid=<?php echo $row->uid; ?>" 
                        class="show_status"><?php _e("Contact Buyer","PricerrTheme"); ?></a> 
                        
                        <a href="<?php bloginfo('siteurl'); ?>?jb_action=chat_box&oid=<?php echo $row->id; ?>" class="show_buyer_notes" rel="<?php echo $id; ?>"><?php _e("Conversation Page","PricerrTheme"); ?></a>
                        
          			<br/><br/>
                       <?php
					   
					   	$instruction_box = get_post_meta($pid, 'instruction_box', true);
						if(!empty($instruction_box))
						{
							echo '<br/><br/>'.sprintf(__('Instructions for the buyer: %s','PricerrTheme'), 	$instruction_box);	
							
						}
						
						$instant = get_post_meta($pid, 'instant', true);
						if($instant == "1")
						{
							$args = array(
										'order'          => 'ASC',
										'orderby'        => 'post_date',
										'post_type'      => 'attachment',
										'post_parent'    => $pid,
										'post_mime_type' => 'application/zip',
										'numberposts'    => -1,
										); $i = 0;
										
										$attachments = get_posts($args);
										
										if ($attachments) {
											foreach ($attachments as $attachment) {
												$url = wp_get_attachment_url($attachment->ID);
												$dnls = "<a href='".$url."' target='_blank'>".$attachment->post_title."</a>";
											}}
							
							echo ' '.sprintf(__('Download File: <b>%s</b>','PricerrTheme'), 	$dnls). " <br/>";	
							
						}
					   	
						if($row->extra1 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra1_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra1_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra2 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra2_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra2_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra3 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra3_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra3_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra4 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra4_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra4_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra5 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra5_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra5_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra6 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra6_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra6_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra7 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra7_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra7_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra8 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra8_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra8_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra9 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra9_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra9_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
						if($row->extra10 == 1)
						{
							$extra_price 	= get_post_meta($pid, 'extra10_price', 		true);
							$extra_content 	= get_post_meta($pid, 'extra10_content', 	true);	
							
							echo '<span class="my_extr_sh">'.$extra_content." - ".PricerrTheme_get_show_price($extra_price). "</span><br/>";					
						}
						
					   ?> 
                
                  </div></div>
                  
                  	<div class="close_order_div" id="cancel_order_div_id_<?php echo $row->id; ?>"><div class="padd10">
                  		
                       <!-- <div class="box_title_special"><?php _e('Request Cancellation','PricerrTheme'); ?></div>
                        <form method="post"  action="<?php bloginfo('siteurl'); ?>/?jb_action=cancel_job_request">
                        <input type="hidden" value="<?php echo $row->id; ?>" name="orderid" />
                            <table>
                            <tr><td colspan="2"><?php
                            
                            _e('By using this option you are asking the buyer to cancel the order. If he agrees with this, and cancels the order, the money gets refunded into his account and
                            you will not get a bad review over it.','PricerrTheme');
                            
                            ?></td></tr>
                            
                            <tr>
                            <td valign="top" width="120"><?php _e('Message for Buyer','PricerrTheme'); ?>:</td>
                            <td><textarea rows="3" cols="50" name="message_to_buyer" ></textarea></td>
                            </tr>
                            
                            <tr>
                            <td valign="top" width="120">&nbsp;</td>
                            <td><input type="submit" name="request_cancellation" value="<?php _e('Submit','PricerrTheme'); ?>" /></td>
                            </tr>
                            
                            </table>
                        </form> -->
                        
                        <div class="clear10"></div>
                        
                        <div class="box_title_special"><?php _e('Force Cancellation','PricerrTheme'); ?></div>
                        <form method="post" action="<?php bloginfo('siteurl'); ?>/?jb_action=cancel_job_request">
                        <input type="hidden" value="<?php echo $row->id; ?>" name="orderid" />
                            <table>
                            <tr><td colspan="2"><?php
                            
                            _e("By using this option you are forcing cancelling this order. The money gets refunded into the buyer's account, and you will get a bad review over the job.",'PricerrTheme');
                            
                            ?></td></tr>
                            
                         
                            
                            <tr>
                            <td valign="top" width="120">&nbsp;</td>
                            <td><input type="submit" name="force_cancellation" value="<?php _e('Submit','PricerrTheme'); ?>" /></td>
                            </tr>
                            
                            </table>
                        </form>
                        
                  	</div></div>
                  
                  </div>
<?php

}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_number_of_active_jobs($uid)
{
	global $wpdb; $prefix = $wpdb->prefix;
	$s = "select distinct orders.id from ".$prefix."job_orders orders, ".$prefix."posts posts
			 where posts.post_author='$uid' AND posts.ID=orders.pid AND orders.done_seller='0' AND 
			 orders.done_buyer='0' AND orders.date_finished='0' AND orders.closed='0' order by orders.id desc";	
	
	$r = $wpdb->get_results($s);
	return count($r);
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_number_of_cencelled_jobs($uid)
{
	global $wpdb; $prefix = $wpdb->prefix;
	$s = "select distinct * from ".$prefix."job_orders orders, ".$prefix."posts posts
			 where posts.post_author='$uid' AND posts.ID=orders.pid AND orders.closed='1' order by orders.id desc";
			 
	
	$r = $wpdb->get_results($s);
	return count($r);
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/


function PricerrTheme_get_number_of_completed_jobs($uid)
{
	global $wpdb; $prefix = $wpdb->prefix;
	$s = "select distinct * from ".$prefix."job_orders orders, ".$prefix."posts posts
			 where posts.post_author='$uid' AND posts.ID=orders.pid AND orders.done_seller='1' AND 
			 orders.done_buyer='1' AND orders.closed='0' order by orders.id desc";
			 
	
	$r = $wpdb->get_results($s);
	return count($r);
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_number_of_delivered_jobs($uid)
{
	global $wpdb; $prefix = $wpdb->prefix;
	$s = "select distinct orders.id from ".$prefix."job_orders orders, ".$prefix."posts posts
			 where posts.post_author='$uid' AND posts.ID=orders.pid AND orders.done_seller='1' AND 
			 orders.done_buyer='0' AND orders.closed='0' order by orders.id desc";
			 
	
	$r = $wpdb->get_results($s);
	return count($r);
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function pricerrTheme_reomve_i_will($title, $price)
{
	$title = str_replace(__("I will","PricerrTheme"),"",$title);
	$title = str_replace(__("for","PricerrTheme")." ".get_option('pricerrTheme_currency_symbol').$price,"",$title);
	$title = str_replace(__("for","PricerrTheme")." ".$price.get_option('pricerrTheme_currency_symbol'),"",$title);
	
	$title = str_replace(__("for","PricerrTheme")." ".get_option('PricerrTheme_currency_symbol').$price,"",$title);
	$title = str_replace(__("for","PricerrTheme")." ".$price.get_option('PricerrTheme_currency_symbol'),"",$title);
	
	return trim($title);
}

 

function PricerrTheme_get_post_by_title($page_title, $output = OBJECT) {
    global $wpdb;
        $post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s", $page_title ));
        if ( $post )
            return get_post($post, $output);

    return false;
}


function PricerrTheme_add_wrap_the_title($title, $pid)
{
	$post = get_post($pid);
	//$post = PricerrTheme_get_post_by_title($title);
	
	
	if($post != false) {
		if($post->post_type == "job")
		{
		
			$data = PricerrTheme_wrap_the_title($title, $post->ID);
			return $data;
	
		}
	}
	
	return $title;


}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_wrap_the_title($title, $pid)
{
 
	return $title;
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
add_filter('post_type_link', 'PricerrTheme_post_type_link_filter_function', 1, 3);

function PricerrTheme_post_type_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {
	 
	global $category_url_link;
	 
    if ( strpos('%job_cat%', $post_link) === 'FALSE' ) {
      return $post_link;
    }
    $post = get_post($id);
    if ( !is_object($post) || $post->post_type != 'job' ) {
      return str_replace("job_cat", $category_url_link ,$post_link);
    }
    $terms = wp_get_object_terms($post->ID, 'job_cat');
    if ( !$terms ) {
      return str_replace('%job_cat%', 'uncategorized', $post_link);
    }
    return str_replace('%job_cat%', $terms[0]->slug, $post_link);
  }
	

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function pricerrTheme_get_avatar($uid, $w = 25, $h = 25)
{
	$av = get_user_meta($uid, 'avatar', true);
	if(empty($av)) return get_bloginfo('template_url')."/images/noav.jpg";
	else return PricerrTheme_generate_thumb($av, $w, $h);
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_prepare_seconds_to_words($seconds)
	{
		$res = PricerrTheme_seconds_to_words_new($seconds); 
		if($res == "Expired") return __('Expired','PricerrTheme');	
		
		if($res[0] == 0) return sprintf(__("%s hours, %s min, %s sec",'PricerrTheme'), $res[1], $res[2], $res[3]);
		if($res[0] == 1){
			
			$plural = $res[1] > 1 ? __('days','PricerrTheme') : __('day','PricerrTheme');
			return sprintf(__("%s %s, %s hours, %s min",'PricerrTheme'), $res[1], $plural , $res[2], $res[3]);
		}
	}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_seconds_to_words_new($seconds)
{
		if($seconds < 0 ) return 'Expired';
			
        /*** number of days ***/
        $days=(int)($seconds/86400); 
        /*** if more than one day ***/
        $plural = $days > 1 ? 'days' : 'day';
        /*** number of hours ***/
        $hours = (int)(($seconds-($days*86400))/3600);
        /*** number of mins ***/
        $mins = (int)(($seconds-$days*86400-$hours*3600)/60);
        /*** number of seconds ***/
        $secs = (int)($seconds - ($days*86400)-($hours*3600)-($mins*60));
        /*** return the string ***/
                if($days == 0 || $days < 0)
				{
					$arr[0] = 0;
					$arr[1] = $hours;
					$arr[2] = $mins;
					$arr[3] = $secs;
					return $arr;//sprintf("%d hours, %d min, %d sec", $hours, $mins, $secs);
				}
				else
				{
					$arr[0] = 1;
					$arr[1] = $days;
					$arr[2] = $hours;
					$arr[3] = $mins;
					
					return $arr; //sprintf("%d $plural, %d hours, %d min", $days, $hours, $mins);
        		}			
	
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function pricerrTheme_get_job_rating($pid)
{
	global $wpdb;
					$query = "select distinct ratings.grade, ratings.id ratid from ".$wpdb->prefix."job_ratings ratings, ".$wpdb->prefix."job_orders orders, 
					".$wpdb->prefix."posts posts where posts.ID=orders.pid AND 
					 ratings.awarded='1' AND orders.id=ratings.orderid AND posts.ID='$pid' ";
					$r = $wpdb->get_results($query);

	$total = count($r);
	$good = 0;
	
	foreach($r as $row)
	{
		$good+=$row->grade;
	}
	
	if($total == 0) return 0;
	
	$prc = round($good/$total, 2);
	$xx = round((100*$prc)/5);
	
	return $xx;		
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function pricerrTheme_orders_in_queue($uid)
	{
		global $wpdb; $pref = $wpdb->prefix;
		$s = "select posts.ID from ".$pref."posts posts, ".$pref."job_orders orders where posts.post_author='$uid' 
		AND posts.ID=orders.pid AND orders.date_finished='0' and request_cancellation='0' AND force_cancellation='0' AND accept_cancellation_request='0'";
		
		$r = $wpdb->get_results($s);
		return count($r);
			
	}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function pricerrTheme_get_seller_rating($uid)
{
	global $wpdb;
					$query = "select distinct ratings.grade, ratings.id ratid from ".$wpdb->prefix."job_ratings ratings, ".$wpdb->prefix."job_orders orders, 
					".$wpdb->prefix."posts posts where posts.ID=orders.pid AND 
					 ratings.awarded='1' AND orders.id=ratings.orderid AND posts.post_author='$uid' ";
					$r = $wpdb->get_results($query);

	$total = count($r);
	$good = 0;
	
	foreach($r as $row)
	{
		$good+=$row->grade;
	}
	
	if($total == 0) return 0;
	
	$prc = round($good/$total, 2);
	$xx = round((100*$prc)/5);
	
	return $xx;	
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_likes_nr($pid)
{
	global $wpdb;
	$s = "select * from ".$wpdb->prefix."job_likes where pid='$pid'";
	$r = $wpdb->get_results($s);
	
	return count($r);

}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_post_images($pid, $limit = -1)
{
	
		//---------------------
		// build the exclude list
		$exclude = array();
		
		$args = array(
		'order'          => 'ASC',
		'post_type'      => 'attachment',
		'post_parent'    => get_the_ID(),
		'meta_key'		 => 'another_reserved1',
		'meta_value'	 => '1',
		'numberposts'    => -1,
		'post_status'    => null,
		);
		$attachments = get_posts($args);
		if ($attachments) {
			foreach ($attachments as $attachment) {
			$url = $attachment->ID;
			array_push($exclude, $url);
		}
		}
		
		//-----------------
	
	
		$arr = array();
		
		$args = array(
		'order'          => 'ASC',
		'orderby'        => 'post_date',
		'post_type'      => 'attachment',
		'post_parent'    => $pid,
		'exclude'    		=> $exclude,
		'post_mime_type' => 'image',
		'numberposts'    => $limit,
		); $i = 0;
		
		$attachments = get_posts($args); 
		if ($attachments) {
		
			foreach ($attachments as $attachment) {
						
				$url = wp_get_attachment_url($attachment->ID);
				array_push($arr, $url);
			  
		}
			return $arr;
		}
		return false;
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_allow_me_ext($ext)
	{
		global $allowed_files_in_conversation;
		
		foreach($allowed_files_in_conversation as $r)
		if($ext == $r) { return true; }
		return false;
	}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_unread_number_messages($uid)
{
	global $wpdb;
	$s = "select * from ".$wpdb->prefix."job_pm where user='$uid' and show_to_destination='1' and rd='0'";
				$r = $wpdb->get_results($s);	
				return count($r);
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_get_userid_from_username($user)
{
	$user = get_userdatabylogin($user);
	
	if(empty($user->ID)) return false;
	
	return $user->ID;	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/
function PricerrTheme_isValidEmail($email)
{
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}
/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_order_row_obj($oid)
{
	global $wpdb;
	$s 				= "select distinct * from ".$wpdb->prefix."job_orders where id='$oid'";
	$r = $wpdb->get_results($s);
	
	return $r[0];
		
}

function PricerrTheme_mark_completed($orderid, $ok_without_uid = '')
{
 
	global $current_user, $wpdb;
	get_currentuserinfo;
		
	$s 				= "select distinct * from ".$wpdb->prefix."job_orders where id='$orderid'";
	$r 				= $wpdb->get_results($s);
	$row 			= $r[0];
	$post 			= get_post($row->pid);
	$pid_d 			= $row->pid;
	$tm 			= current_time('timestamp',0);
	
	do_action('PricerrTheme_do_when_completed', $row);
	
	if($ok_without_uid == 1) $ok_gen = 1;
	else {
			if($row->uid == $current_user->ID) $ok_gen = 1;
			else $ok_gen = 0;
	}
	
	if($ok_gen == 1) // && $row->completed == "0")
	{
		$tm = current_time('timestamp',0);
		$s = "update ".$wpdb->prefix."job_orders set done_buyer='1', completed='1', date_completed='$tm' where id='$orderid' ";
		$wpdb->query($s);
		
		//------------------
		
		PricerrTheme_send_email_when_job_completed($orderid, $pid_d, $post->post_author);
		
		//------------------
		
			$raw_amount 	= $row->mc_gross;
			$percent_taken 	= get_option('PricerrTheme_percent_fee_taken'); 
			
			$percent_taken = apply_filters('PricerrTheme_apply_filters_here_mark_compl',$percent_taken, $pid_d);
			
			if(empty($percent_taken)) $amount_fee = round(get_option('PricerrTheme_solid_fee_taken'),2);
			else $amount_fee 	= round(($percent_taken * $raw_amount) / 100, 2);
			
			
			
			$current_cash = PricerrTheme_get_credits($post->post_author);
			PricerrTheme_update_credits($post->post_author, $current_cash + $raw_amount - $amount_fee);
			
			$reason = sprintf(__('Payment received for job: <a href="%s">%s</a>','PricerrTheme'), get_permalink($post->ID), $post->post_title);
			PricerrTheme_add_history_log('1', $reason, $raw_amount, $post->post_author);
			
			$reason = sprintf(__('Fee taken for job: <a href="%s">%s</a>','PricerrTheme'), get_permalink($post->ID), $post->post_title);
			PricerrTheme_add_history_log('0', $reason, $amount_fee, $post->post_author);
		
			$s = "update ".$wpdb->prefix."job_orders set admin_fee='$amount_fee' where id='$orderid' ";
			$wpdb->query($s);
		
			//---------------
		
			$g2 = "insert into ".$wpdb->prefix."job_admin_earnings (orderid, pid, admin_fee, datemade) values('$orderid','$pid_d','$amount_fee','$tm')";
			$wpdb->query($g2);
		
			//emails
		
		//------------------
		
			$g1 = "insert into ".$wpdb->prefix."job_chatbox (datemade, uid, oid, content) values('$tm','-2','$orderid','$ccc')";
			$wpdb->query($g1);
			return 1;
	}
	return 0;
	
}

/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

function PricerrTheme_get_post_blog()
{
			
						 $arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . get_the_ID());
						 
						 if($arrImages) 
						 {
							$arrKeys 	= array_keys($arrImages);
							$iNum 		= $arrKeys[0];
					        $sThumbUrl 	= wp_get_attachment_thumb_url($iNum);
					        $sImgString = '<a href="' . get_permalink() . '">' .
	                          '<img class="image_class" src="' . $sThumbUrl . '" width="100" height="100" />' .
                      		'</a>';
							 							 
						 }
						 else
						 {
								$sImgString = '<a href="' . get_permalink() . '">' .
	                          '<img class="image_class" src="' . get_bloginfo('template_url') . '/images/nopic.jpg" width="100" height="100" />' .
                      			'</a>'; 
							 
						 }
					
			
?>

                <div class="clients_inner_bottom1">
			    	<div class="clients_inner_bottom1-part">
			    		<div class="blog-img">
				        	<!-- <img src="images/blog-img.jpg"/> -->
				        	<?php echo $sImgString; ?>
			        	</div>
				        <div class="blog-details-part">
							<p class="blog-head"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
		                        <?php the_title(); ?></a></p>
				        	<!-- <p class="blog-head">Tips for finding genuine automotive jobs</p> -->
				            <br>
				            <p class="blog-date">Posted on <?php the_time('F jS, Y') ?>  by <?php the_author() ?></p>
				            <br>
				            <hr>
				            <br>
				            <p class="blog-contain">
				            	<?php the_excerpt(); ?>
				            </p>
				            <p class="read-more">
				            	<a href="<?php the_permalink() ?>" class="more">Read more</a> &nbsp; &nbsp; &nbsp; <img src="images/all-social.jpg"/>
				            </p>
				            
				        </div>          
				        <br clear="all"/>      
			        </div>
			    </div>

<?php
}


/*************************************************************
*
*	PricerrTheme (c) sitemile.com - function
*
**************************************************************/

if(isset($_POST['rate_me']))
{
	global $wpdb; $tm = current_time('timestamp',0);
	$reason = addslashes($_POST['reason']);
	
	if(!is_user_logged_in()) exit;
			
	
 
	
	if(isset($_POST['uprating']))
	{
		$grade 	= $_POST['uprating'];
		$id 	= $_POST['ids'];
		
		$s = "update ".$wpdb->prefix."job_ratings set grade='$grade', reason='$reason', awarded='1' ,datemade='$tm' where id='$id'";
		$wpdb->query($s);
		
		
		$s_sql = "select * from ".$wpdb->prefix."job_ratings ratings, ".$wpdb->prefix."job_orders orders  where ratings.id='$id' AND orders.id=ratings.orderid";
		$r_sql = $wpdb->get_results($s_sql);
		$r_sql = $r_sql[0];
		
		$rating = get_post_meta($r_sql->pid,'rating',true);
		if(empty($rating)) $rating = 0;
		
		$rating = $rating + 1;	
		update_post_meta($r_sql->pid,'rating', $rating);
		
		global $current_user;
		get_currentuserinfo();
		$uid = $current_user->ID;
		$post1 = get_post($r_sql->pid);
		
		
		$s = "update ".$wpdb->prefix."job_ratings set uid='".$post1->post_author."', pid='".$r_sql->pid."' where id='$id'";
		$wpdb->query($s);
		
		
		PricerrTheme_send_email_when_feedback_left($r_sql->pid, $uid, $post->post_author);
		
	}
	
	
	
	
	exit;
}

// =========================================================
global $wpdb;

if(isset($_POST['unlike_this_job']))
{
	if(!is_user_logged_in()) exit;
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	$tm = time();
	$pid = $_POST['unlike_this_job'];
	
	
		$likes = get_post_meta($pid,'likes',true);
		if(empty($likes)) $likes = 0; else $likes = $likes - 1;
		
		update_post_meta($pid,'likes', $likes);
	
	
	global $wpdb;
	$s = "delete from ".$wpdb->prefix."job_likes where pid='$pid' AND uid='$uid'";
	$wpdb->query($s);
	
	exit;
}


if(isset($_POST['like_this_job']))
{
	if(!is_user_logged_in()) exit;
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	$tm = time();
	$pid = $_POST['like_this_job'];
	
		$likes = get_post_meta($pid,'likes',true);
		if(empty($likes)) $likes = 1; else $likes = $likes + 1;
		
		update_post_meta($pid,'likes', $likes);
	
	global $wpdb;
	$s = "insert into ".$wpdb->prefix."job_likes (pid,uid,date_made) values('$pid','$uid','$tm')";
	$wpdb->query($s);
	
	exit;
}



//============================================================

if(isset($_POST['submit_prepare_continue']))
{
	$i_will = trim(htmlspecialchars($_POST['i_will']));
	
	if(isset($_POST['job_cost'])):
		$job_cost   				= trim(htmlspecialchars($_POST['job_cost']));
		$_SESSION['job_cost'] 		= $job_cost;
	endif;

	
	$_SESSION['i_will'] = $i_will;
	wp_redirect(get_permalink(get_option('PricerrTheme_post_new_page_id')));
	exit;

}

//------------------------------------------------------------

if(isset($_GET['_ad_delete_pid']))
	{
		if(is_user_logged_in())
		{
			$pid	= $_GET['_ad_delete_pid'];
			$pstpst = get_post($pid);
			global $current_user;
			get_currentuserinfo();
			
			if($pstpst->post_author == $current_user->ID)
			{
				wp_delete_post($_GET['_ad_delete_pid']);	
				echo "done";
			}
		}
		exit;	
	}

//-=================== delete PMs ============================
		
		global $wpdb;
		
		if(isset($_GET['confirm_message_deletion']))
		{
			$return 	= $_GET['return'];
			$messid 	= $_GET['id'];	
			
			global $wpdb, $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			
			$s = "select * from ".$wpdb->prefix."job_pm where id='$messid' AND (user='$uid' OR initiator='$uid')";
			$r = $wpdb->get_results($s);	
			
			if(count($r) > 0)
			{
				$row = $r[0];
				
				if($row->initiator == $uid)
				{
					$s = "update ".$wpdb->prefix."job_pm set show_to_source='0' where id='$messid'";
					$wpdb->query($s);	
					
				}
				else
				{
					$s = "update ".$wpdb->prefix."job_pm set show_to_destination='0' where id='$messid'";
					$wpdb->query($s);						
				}
				
				$using_perm = PricerrTheme_using_permalinks();
	
				if($using_perm)	$privurl_m = get_permalink(get_option('PricerrTheme_my_account_priv_mess_page_id')). "/?";
				else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('PricerrTheme_my_account_priv_mess_page_id'). "&";	
					 
				
				if($return == "inbox") wp_redirect($privurl_m . "priv_act=inbox");
				else if($return == "outbox") wp_redirect($privurl_m . "priv_act=sent-items");
				else if($return == "home") wp_redirect($privurl_m);
				else wp_redirect(get_permalink(get_option('PricerrTheme_my_account_page_id')));
				
			}
			else wp_redirect(get_permalink(get_option('PricerrTheme_my_account_page_id')));
			
		}
		
	
    function arphabet_widgets_init() {

	register_sidebar( array(
		'name' => 'Test right sidebar',
		'id' => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );


add_shortcode('show-register','show_register');

function show_register()
{
   include dirname(__FILE__).'/customTemplate/tpl-register.php';
}

add_shortcode('show-blog','show_blog');

function show_blog()
{
   include dirname(__FILE__).'/customTemplate/tpl-blog.php';
}

add_shortcode('email-activate','email_activate');	

function email_activate()
{
   include dirname(__FILE__).'/customTemplate/tpl-email_activate.php';
}
	
	
add_action( 'user_register', 'myplugin_registration_save', 10, 1 );

function myplugin_registration_save( $user_id ) {

    $random_number=rand();
    $hash = md5( $random_number );
	add_user_meta( $user_id, 'hash_verify', $hash );
	$user_info = get_userdata($user_id);
	$to = $user_info->user_email; 
    $login=	$user_info->user_login; 
	$subject = 'Member Verification'; 
	$message = 'Hello '.$login.',';
	$message .= "\n\n";
	$message .= 'Welcome...';
	$message .= "\n\n";
	//$message .= 'Username: '.$un;
	//$message .= "\n";
	//$message .= 'Password: '.$pw;
	//$message .= "\n\n";
	$message .= 'Please click this link to activate your account:';
	$message .= home_url('/').'activate?id='.$user_id.'&key='.$hash;
	$headers = 'From: wordpress@oz-dropship.com' . "\r\n";  
    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);	
	wp_mail($to, sprintf(__('[%s] New User Verification'), $blogname), $message, $headers); 

}


add_action('admin_menu','wphidenag');

function wphidenag() {

remove_action( 'admin_notices', 'update_nag', 3 );

}
	
	
if ( is_user_logged_in() && !is_admin() ) {
     add_filter('show_admin_bar', '__return_false');
}	

function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
	
add_shortcode('user-profile','user_profile');

function user_profile()
{   
   include dirname(__FILE__).'/customTemplate/tpl-profile.php';
}



	
function remove_the_dashboard () {
	if (current_user_can('level_10')) {
		return;
	} else {
 
global $menu, $submenu, $user_ID;
        $the_user = new WP_User($user_ID);
        reset($menu); $page = key($menu);
        while ((__('Dashboard') != $menu[$page][0]) && next($menu))
                $page = key($menu);
        if (__('Dashboard') == $menu[$page][0]) unset($menu[$page]);
        reset($menu); $page = key($menu);
        while (!$the_user->has_cap($menu[$page][1]) && next($menu))
                $page = key($menu);
        if (preg_match('#wp-admin/?(index.php)?$#',$_SERVER['REQUEST_URI']) && ('index.php' != $menu[$page][2]))
                wp_redirect(get_option('siteurl'));
}
}
add_action('admin_menu', 'remove_the_dashboard');
		
		
		
?>