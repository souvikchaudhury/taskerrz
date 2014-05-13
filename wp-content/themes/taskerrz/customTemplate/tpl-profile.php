<!--blog start-->
<?php
  global $wpdb;
  $user_id=get_current_user_id();
?>
 <div class="clients">
    	<div class="container">
        
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
<div class="clients_inner">
        
        <div class="clients_inner_top btm-bdr no-padding">
            <div class="recent-comment">
        <div class="container innermenu">

            <ul class="archive">
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Blog</a>
                </li>
                <li>
                    <a href="#">Post New</a>
                </li>
                <li>
                    <a href="#">My Account</a>
                </li>
                <li>
                    <a href="#">Pay for your job</a>
                </li>
                <li>
                    <a href="#">Site</a>
                </li>
            </ul>
            <?php
            $u_id=get_current_user_id();
        	   $user=get_userdata($u_id);
        	   $fname=get_user_meta($u_id,'first_name',true);
        	   $lname=get_user_meta($u_id,'last_name',true);
        							   ?>
            <ul class="archive1">
                <li>
                    <a class="user-name" href="#"><?php echo $fname; ?> <?php echo $lname; ?></a>
                    
                    <ul class="about-user">
                        <li>
                            <div class="user-img">
                                <img src="images/user-img.png">
                            </div>
                            <div class="user-details">
                                <p class="u-name"><?php echo $fname; ?> <?php echo $lname; ?></p>
                                <p class="u-profile"><a href="#">My profile</a> &nbsp; <a href="#">Edit profile</a></p>
                                <p class="u-log"><a href="javascript:void(0)" onclick='logging_out()'>Log out</a></p>
                            </div>
                        </li>
                    </ul>
                    
                </li>
                <li>
                    <a class="log-out" href="javascript:void(0)" onclick='logging_out()' >Log Out</a>
                </li>
            </ul>
                       
            <br clear="all">
        </div>
</div>
        </div>
                
    </div>
        
           <?php
              if(isset($_POST['submitter']))
			  {
			     //echo 'helloo';
				 if($_FILES['file']['name'] != '')
				 {
				 if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
						$uploadedfile = $_FILES['file'];
						$upload_overrides = array( 'test_form' => false );
						$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
						$icon_url = $movefile['url'];
						$get_icon=get_user_meta($user_id,'user_icon',true);					 
						if($get_icon != '')
						 {
							update_user_meta($user_id,'user_icon',$icon_url);	
						 }
						 else
							 {
								add_user_meta($user_id,'user_icon',$icon_url);
							 } 	
				 }
                 $fn=$_POST['fn'];
                 $ln=$_POST['ln'];
                 $loc=$_POST['location'];	
                 $paypal_email=$_POST['paypal_email'];
                 $pass = $_POST['pass'];
				 $message=$_POST['message'];
                 if($pass != '')
                 {
                    $plaintext_pass = $pass;
					$hash = wp_hash_password( $plaintext_pass );
					$pass_sql="update {$wpdb->prefix}users set user_pass='$hash' where ID=$user_id";
					$wpdb->query($pass_sql);
                 }
                 update_user_meta($user_id,'first_name',$fn);
                 update_user_meta($user_id,'last_name',$ln);
                 $get_loc=get_user_meta($user_id,'user_location',true);
				 if($get_loc != '')
				 {
				    update_user_meta($user_id,'user_location',$loc);	
				 }
				 else
                     {
                        add_user_meta($user_id,'user_location',$loc);
                     }
                $get_paypal=get_user_meta($user_id,'user_paypal',true);					 
                if($get_paypal != '')
				 {
				    update_user_meta($user_id,'user_paypal',$paypal_email);	
				 }
				 else
                     {
                        add_user_meta($user_id,'user_paypal',$paypal_email);
                     } 
                $get_message=get_user_meta($user_id,'user_message',true);					 
                if($get_paypal != '')
				 {
				    update_user_meta($user_id,'user_message',$message);	
				 }
				 else
                     {
                        add_user_meta($user_id,'user_message',$message);
                     } 	
                echo 'User Profile Updated Successfully'; 					 
			  }
           ?>		   
        	<div class="clients_inner listining freelance">
                
                
                <div class="clients_inner_bottom1 about_us">
                	
                		
                    <div class="blog-details-part my-pay">
                    	
                        <h3 align="left" class="my-head">Personal Info</h3>
                         <br/>
                         <hr/>
                         <br/>
                         
                         <div class="my-pay-inner ratting">
                         	
                            <!--=====================tab========================-->
                            
                            <div id="tabs" class="ratting-tab presonal_info">
                            
                            <div id="tabs-2" class="ratting-inner-tab">
                            
                            <div class="frm">
                            <br clear="all">
                            <form action="" name="form1" id='upd_prof' method="post" enctype='multipart/form-data'>
                            <input type="text" class="txt" value="<?php echo $fname; ?>" name='fn' placeholder="First Name">
                            <input value="<?php echo $lname; ?>" class="txt" type="text" name='ln' placeholder="Last Name">
                            <br>
                            <!--<select class="location">
                            	<option>Your Location</option>
                                <option>Option1</option>
                                <option>Option2</option>
                                <option>Option3</option>
                                <option>Option4</option>
                            </select>-->
							<input value="" class="txt" type="text" placeholder="Location" name='location'>
                            <input value="" class="txt" type="text" placeholder="PayPal Email" name='paypal_email' id='paypal_email'>
                            <br>
                            <input type="password" class="txt" value="" placeholder="New Password" name='pass' id='pass'>
                            <input value="" class="txt" type="password" placeholder="Repeat Password" name='cpass' id='cpass'>
                            <textarea placeholder="Message" name='message'></textarea>
                            <div class="personal-image">
                            	<span>
                                <img src="images/profile.png">
                                </span>
                                <p class="img"><!--<img src="images/browse.png">-->
                                <input type="file" name='file' id='ff' onchange='validateFileExtension(this)'>
                                <br clear="all">
                                max file size: 2mb. Formats: jpeg, jpg, png, gif 
                                </p>
                            <br clear="all">
                            </div>
                            <br clear="all">
							<input type='hidden' name='submitter' value='1' />
                            <input type="submit" value="Profile Description" id='clicker' name='prof'>
                            </form>
                            <br clear="all">
                            </div>
                            <br><br>
                            </div>
                            
                            </div>
                            
                            <!--=====================tab========================-->
                            <script type='text/javascript'>
                            function validateFileExtension(fieldObj)
									{
										var FileName  = fieldObj.value;
										var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
										var FileSize = fieldObj.files[0].size;
										var FileSizeMB = (FileSize/2097152).toFixed(2);

										if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize > 2097152)
										{
											var error = "File type : "+ FileExt+"\n\n";
											error += "Size: " + FileSizeMB + " MB \n\n";
											error += "Please make sure your file is in jpeg or jpg or png or gif format and less than or equal to 2 MB.\n\n";
											alert(error);
											jQuery('#ff').val('');
											return false;
										}
										return true;
									}
						     			
							</script>
							
							<script type='text/javascript'>
							jQuery('#clicker').click(function(e){
							  
							  e.preventDefault();
							  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
							  var pass = jQuery('#pass').val();
							  var cass = jQuery('#cpass').val();
                              var email = jQuery('#paypal_email').val();
							  console.log('pass',pass);
                              if((pass == '') || (cpass == ''))
							  {
							      console.log('hi');
								  if(email != '')
								  {
								    if(re.test(email))
                                      {
								         jQuery('#upd_prof').submit();
									  }
									else{
                                          alert('Paypal email is not valid');  }									
							      }	
                                 else
                                     {
                                         jQuery('#upd_prof').submit();
                                     }									 
							  }
                              else
							      {
								     if(pass != cpass)
								     {
									     alert('Password and Confirm Password must match');
									 }
									 if(!re.test(email))
								     {
									     alert('Paypal email is not valid');
									 }
								  }
							});
							</script>
                            <br/>
                            
                                                        
                         </div>
                         <br clear="all">
                         <div align="left" class="social-icon1">
                    		<img src="images/all-social.jpg">
                    	 </div>
                    </div>
                    
                    <?php
                       get_sidebar('job');
                    ?>					
                     <br clear="all"/>                
                    
                
                    
                    
                </div>

            </div>
            
        </div>	
        <div class="sdow1"></div>
        
<!----------------------Recent Comments---------------------->

	
    
    <div class="recent-comment">
    <div class="container jobcategorylis">
    	
    		<h5 align="center">Job Categories</h5>
            <?php
                $jobcatargs = array(
                            'type'                     => 'job',
                            'orderby'                  => 'name',
                            'order'                    => 'ASC',
                            'taxonomy'                 => 'job_cat'
                        ); 
                $categories = get_categories( $jobcatargs );
                $jobcatflag = 1;
                foreach ($categories as $jobcategory) {
                    if($jobcatflag == 1){
                        echo '<ul class="archive">';
                    }
                    $term_link = get_term_link( $jobcategory, 'job_cat' );
                    echo '<li><a href="'.esc_url( $term_link ).'">'.$jobcategory->name.'('.$jobcategory->count.')'.'</a></li>';
                    $jobcatflag++;
                    if($jobcatflag == 7){
                        echo '</ul>';
                        $jobcatflag = 1;
                    }
                }
            ?>
            <br clear="all">
        </div>
    </div>

<!--Recent Comments-->        
        
    </div>
	<script type='text/javascript'>
jQuery(document).ready(function(){

jQuery('.hupso-share-buttons').hide();
jQuery('#comments').hide();
jQuery('.hupso-share-buttons').next().find('h3').hide();
jQuery('#respond').hide();
jQuery('.sdow1').removeClass('sdow1');
})
</script>
<!--blog end-->