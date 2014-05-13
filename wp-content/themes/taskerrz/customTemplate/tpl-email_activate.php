<?php
global $wpdb;
$user_id = $_GET['id'];
$verify_key=$_GET['key'];
$meta_val=get_user_meta($user_id,'hash_verify',true);
$user = get_userdata($user_id);
if($meta_val == $verify_key)
{
    $plaintext_pass = rand();
	$hash = wp_hash_password( $plaintext_pass );
	$pass_sql="update {$wpdb->prefix}users set user_pass='$hash' where ID=$user_id";
	$wpdb->query($pass_sql);
	
	$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
    $message  = sprintf(__('Username: %s'), $user->user_login) . "\r\n";
	$message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n";
	$message .= wp_login_url() . "\r\n";

	wp_mail($user->user_email, sprintf(__('[%s] Your username and password'), $blogname), $message);
    header('Location:'.trailingslashit(site_url()).'wp-login.php');
}

?>