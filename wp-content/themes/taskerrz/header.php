<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Taskerrz
 * @since Taskerrz 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<link href="<?php echo get_template_directory_uri().'/style.css'; ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri().'/css/media.css'; ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri().'/css/jsCarousel-2.0.0.css'; ?>" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister' rel='stylesheet' type='text/css'>
<!--[if IE]>
<link href="<?php echo get_template_directory_uri().'/css/ie.css'; ?>" rel="stylesheet" type="text/css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri().'/css/elastislide.css'; ?>" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri().'/js/modernizr.custom.17475.js'; ?>"></script>

<link href="<?php echo get_template_directory_uri().'/css/jquery.bxslider.css'; ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo get_template_directory_uri().'/js/jquery.bxslider.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/jquery.elastislide.js'; ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		// hello test
		$('.getstartedsubmit').click(function(){
			usr = jQuery('.chkvalidateusr').val();
			eml = jQuery('.chkvalidateemail').val();
			if((usr == null || usr == '' )&&(eml == null || eml == '')){
				alert('Please fill up atleast one field to be started');
			}
			else{
				jQuery('.submitbtnbox').trigger( "click" );
			}
		});
		$(window).resize(function () {
		   winWidth = $(window).width();
		   console.log(winWidth);
		   if(winWidth<=755)
		   		$('.googleaddshome').fadeOut();
		   else
		   		$('.googleaddshome').fadeIn();
		});
		$('.headerselectbox').change(function(){
			var option = $('option:selected', this).attr('openlink');
			window.location.href = option;
		});
	});
	function suggest(inputString){
		if(inputString.length == 0) {
			jQuery('#suggestions').fadeOut();
		} else {
			jQuery('#big-search').addClass('load');
			jQuery.post("<?php bloginfo('siteurl'); ?>/wp-admin/admin-ajax.php?action=autosuggest_it", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					var stringa = data.charAt(data.length-1);
					if(stringa == '0') data = data.slice(0, -1);
					else data = data.slice(0, -2);
					jQuery('#suggestions').fadeIn();
					jQuery('#suggestionsList').html(data);
					jQuery('#big-search').removeClass('load');
				}
			});
		}
	}
	function fill(thisValue) {
		jQuery('#big-search').val(thisValue);
		setTimeout("jQuery('#suggestions').fadeOut();", 600);
	}
</script>
<?php
if(!is_home()){
?>
	<style>
		.topPannel{background:none !important; min-height:200px !important;}
		.topPannel_top{background:#00938b;}
	</style>
<?php
}
?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
   if(isset($_POST['loggin_out']))
   {
      wp_logout();
	  header('Location:'.trailingslashit(site_url()));
   }
?>
<form action='' id='logger' method='post'>
				<input type='hidden' name='loggin_out' value='1' />
				</form>
				<script type='text/javascript'>
				 function logging_out()
				 {
				     jQuery('#logger').submit();
				 }
				</script>
<!--main wrapper start-->
<div class="wrapper">

<!--topPannel start-->
	<div class="topPannel">
 <!--topPannel_top start-->   
	    <div class="topPannel_top">
	    <!--top nav start-->
	        <div class="topnavigation">
	            <div class="container">
	                <div class="navigation">
	                    <ul>
	                    	<?php wp_nav_menu( array( 'theme_location' => 'taskerrz_header', 'menu_class' => 'nav-menu' ) ); ?>
	                        <!-- <li><a href="#" class="active">Home</a></li>
	                        <li><a href="#">Post a job</a></li>
	                        <li><a href="#">Collections</a></li>
	                        <li><a href="#">Blog</a></li>
	                        <li><a href="#">Freelancers</a></li>
	                        <li><a href="#">How it works</a></li> -->
	                    </ul>
	                </div>
	                <div class="header_social">
	                    <div class="header_social_Part1">
	                        <p>Find our social connection</p>
	                    </div>
	                    <div class="header_social_Part2">
	                        <ul>
	                            <li class="facebook"><a href="#">Facebook</a></li>
	                            <li class="twiter"><a href="#">Twiter</a></li>
	                            <li class="googleplus"><a href="#">Google plus</a></li>
	                        </ul>
	                    </div>
	                <br clear="all"/>
	                </div>
	                <br clear="all"/>
	            </div>
	        </div>
	    <!--top nav end-->
		 <!--top nav start-->
	    	<div class="header header-first">
	            <div class="container">
	              <div class="header_inner">
	               	<div class="postjob_part">
	                        <a href="#">
	                            <h3>Post a job</h3>
	                            <p>Know how can you post ? Click here</p>
	                        </a>
	                </div>
	                <div class="logo">
	                	<a href="<?php echo site_url();?>"><img src="<?php echo get_template_directory_uri().'/images/logo.png'; ?>" alt="" /></a>
	                </div>
					<?php
					  if(!is_user_logged_in())
					    {
					?>
	                <div class="login_part">
	                	
						
						<div class="register_box">
	                        <a href="<?php echo site_url().'/wp-login.php?action=register';?>">
	                            <h5>Register</h5>
	                            <p>Don’t worry ! It’s free</p>
	                        </a>
	                    </div>
	                    
	                   <!-- <div class="login_box">
	                   		 <h5>Log In</h5>
	                    </div>-->
	                    <input type="button" value="Log in" class="login_box" onclick='window.location.href="<?php echo site_url().'/wp-admin';?>"'>
	                </div>
					<?php
					    }
						else
						    {
							   if(!is_page('profile'))
							   {
							   $u_id=get_current_user_id();
							   $user=get_userdata($u_id);
							   $fname=get_user_meta($u_id,'first_name',true);
							   $lname=get_user_meta($u_id,'last_name',true);
					?>
					<div class="login_part index-signin">
                	<ul class="signin-user">
                    <li>
                    <a href="#" class="user-name-si"><?php echo $fname; ?> <?php echo $lname; ?></a>
                    <ul class="about-user">
                    	<li>
                        	<div class="user-img">
                            	<?php echo get_avatar( $u_id ); ?> 
                            </div>
                            <div class="user-details">
                            	<p class="u-name"><?php echo $fname; ?> <?php echo $lname; ?></p>
                                <p class="u-profile"><a href="<?php echo site_url().'/profile';?>">My profile</a> &nbsp; <a href="<?php echo site_url().'/profile';?>">Edit profile</a> <br clear="all"></p>
                                <p class="u-log"><a href="javascript:void(0)" onclick='logging_out()'>Log out</a></p>
                            </div>
                        </li>
                    </ul>
                    </li>
                    <li>
                    <input class="user-name-si-btn" type="button" value="Log out" onclick='logging_out()'>
                    </li>
                    </ul>
                </div>
				
				<?php
                            }
							else
							    {
			    ?>
				<div class="login_part"></div>
				<?php
								}
						  }
                ?>				
	               <!-- <div class="left_glow"> </div>
	                <div class="middle_glow"> </div>
	                <div class="right_glow"></div>-->
	                
	                <br clear="all"/>
	              </div>
	            </div>
	        </div>
	     <!--top nav start-->
	     
	     <!--top nav1 start-->
	    	<div class="header header-second">
	            <div class="container">
	              <div class="header_inner">
	              	<div>
	                	<div class="logo">
	                	<a href="#"><img src="<?php echo get_template_directory_uri().'/images/logo.png'; ?>" alt="" /></a>
	                </div>
	                </div>
	                <div>
	                    <div class="postjob_part">
	                            <a href="#">
	                                <h3>Post a job</h3>
	                                <p>Know how can you post ? Click here</p>
	                            </a>
	                    </div>
	                    <div class="login_part">
	                        <div class="register_box">
	                            <a href="<?php echo site_url().'/wp-login.php?action=register';?>">
	                                <h5>Register</h5>
	                                <p>Don’t worry ! It’s free</p>
	                            </a>
	                        </div>
	                        
	                       <!-- <div class="login_box">
	                             <h5>Log In</h5>
	                        </div>-->
	                        <input type="button" value="Log in" class="login_box">
	                    </div>
	                    <br clear="all"/>
	                </div>
	                <!--<div class="left_glow"> </div>
	                <div class="middle_glow"> </div>
	                <div class="right_glow"></div>-->
	                
	                <br clear="all"/>
	              </div>
	            </div>
	        </div>
	     <!--top nav1 start-->
	     
	     <!--top nav2 start-->
	    	<div class="header header-third">
	            <div class="container">
	              <div class="header_inner">
	              	<div>
	                	<div class="logo">
	                	<a href="#"><img src="<?php echo get_template_directory_uri().'/images/logo.png'; ?>" alt="" /></a>
	                </div>
	                </div>
	                <div>
	                    <div class="postjob_part">
	                            <a href="#">
	                                <h3>Post a job</h3>
	                                <p>Know how can you post ? Click here</p>
	                            </a>
	                    </div>
	                <br clear="all"/>
	                </div>
	                <div>
	                    <div class="login_part">
	                        <div class="register_box">
	                            <a href="<?php echo site_url().'/wp-login.php?action=register';?>">
	                                <h5>Register</h5>
	                                <p>Don’t worry ! It’s free</p>
	                            </a>
	                        </div>
	                        
	                       <!-- <div class="login_box">
	                             <h5>Log In</h5>
	                        </div>-->
	                        <input type="button" value="Log in" class="login_box">
	                    </div>
	                    <br clear="all"/>
	                </div>
	                <!--<div class="left_glow"> </div>
	                <div class="middle_glow"> </div>
	                <div class="right_glow"></div>-->
	                
	                <br clear="all"/>
	              </div>
	            </div>
	           <br clear="all"/> 
	        </div>
	     <!--top nav2 start-->
	     <div class="sdow"></div>
	     <br clear="all"/>
	    </div>
	 <!--topPannel_top end-->  

	    <div class="middle_glow"> </div>
	    <?php if(is_home()){ ?>
	 <!--topPannel_bottom start-->    
	      <div class="topPannel_bottom">  
	        <div class="container">
	            <div class="topPannel_bottomInner">
	            	<h3>Catch the freelancers easily, <span>only by a click</span></h3>
	                <form action="<?php echo site_url().'/wp-login.php?action=register';?>" method="post">
	                	<input type="text" placeholder="Username" name='username' class="textbox chkvalidateusr" />
	                    <input type="text" placeholder="Email" name='email' class="textbox chkvalidateemail" />
	                    <input type="button" value="Get Started" class="submitbox getstartedsubmit" />
	                    <input type="Submit" value="Get Started" name="home_sub" class="submitbtnbox" style="display:none;"/>
	                </form> 
	            </div>
	        </div>
	      </div>
	 <!--topPannel_bottom end--> 
	 <?php } ?>
  </div>  
<!--topPannel end-->
