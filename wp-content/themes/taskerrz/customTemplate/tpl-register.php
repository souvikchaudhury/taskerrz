<?php
  //get_header();
?>
<script type='text/javascript'>
jQuery(document).ready(function(){

jQuery('.hupso-share-buttons').hide();
jQuery('#comments').hide();

})
</script>
<!--blog start-->
 <div class="clients sigin-part">
    	<div class="container">
        	<div class="clients_inner">
            	                
                <?php
				   extract($_POST);
				   wp_create_user($username,'abc123',$email);
				   wp_mail($email,'User Registration Successful','User Successfully registered');
				   echo 'User Registration Successful';
                ?>
                
                 <div class="clients_inner_bottom1 full-width">
                 	<div class="clients_inner_top no-bdr">
                		<h3>Register - Online</h3>
                        <span>Job | Employment | Online Work | Freelance Job | Freelance</span>
                	<div align="center" class="sml-txt other-font">
                    	Please fill up this form
                    </div>
                    
                    <div class="form-blog">
                      <form action='' method='post' id='reg_frm'>	
                        <div align="left">
                        	<input type="text" class="txt" placeholder="Username*" value="" id='username' name='username'> &nbsp; <input type="text" class="txt" placeholder="Email*" value="" id='email' name='email'> 6 x&nbsp;<input type="text" class="txt1" id='capt'>&nbsp; = &nbsp; 18
                        </div>
                        <div align="center" class="sml-txt a-link">
                            <label>*A password will be emailed to you.</label> &nbsp;&nbsp; <a href="#">Home</a>&nbsp;<a href="#">Login</a>&nbsp;<a href="#">Lost Your Password?</a>
                        </div>
                        <div class="btn-post" align="center">
						<h6>Sign up to our newsletter <input type='checkbox' checked /></h6>
                        	<input type="submit" name='submit' value="Sign UP">
                        </div>
						</form>
						
						<script type='text/javascript'>
						/*jQuery(document).ready(function(){
						   jQuery('#reg_frm').submit(function(e){
						     e.preventDefault();
							 console.log('hellloo');
							 var username=jQuery('#username').val();
							 var email=jQuery('#email').val();
							 //var capt = jQuery('#capt').val();
							 //console.log(capt);
							 //capt = parseInt(capt);
							 var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
							 if((username != '') && (email != '') && (pattern.test(email)))
							   {
							     $(this).unbind('submit').submit();
							   }
							 if(!(pattern.test(email)))
							   {
							     alert('Email Address is not valid!');
							   }  
                            							   
						   });
						})*/
						</script>
                    </div>
                    
                    
                    </div>
                    
                
                 </div>
                	
            </div>
           
        </div>	
        <div class="sdow1"></div>
        

    </div>
<!--blog end-->

<?php
  // get_footer();
?>


