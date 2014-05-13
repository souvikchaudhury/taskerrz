<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Taskerrz
 * @since Taskerrz 1.0
 */
?>
	<!--footer start-->

<div class="footer">
    	<div class="container">
        	<div class="footer_inner">
            	<div class="footer_part1">
                	<h4>Useful links</h4>
                    <ul>
                        <?php wp_nav_menu( array( 'theme_location' => 'taskerrz_footer', 'menu_class' => 'nav-menu' ) ); ?>
                    </ul>
                    <ul>
                        <?php wp_nav_menu( array( 'theme_location' => 'taskerrz_footer1', 'menu_class' => 'nav-menu' ) ); ?>
                    </ul>
                    <ul>
                        <?php wp_nav_menu( array( 'theme_location' => 'taskerrz_footer2', 'menu_class' => 'nav-menu' ) ); ?>
                    </ul>
                </div>
                
                <!-- <div class="footer_part2">
                	<div class="footer_part2_top"><h4>Get updated</h4>
                    	<p>Get the latest news every month</p>
                    </div>
                    <form>
                        <input type="text" value="Username" class="footer_textbox" onfocus="if(this.value=='Username') this.value = ''" onblur="if(this.value=='') this.value = 'Username'" value="Username" />
                        <input type="text" value="Email" class="footer_textbox" onfocus="if(this.value=='Email') this.value = ''" onblur="if(this.value=='') this.value = 'Email'" value="Email" />
                        <input type="Submit" value="Submit" class="footer_submitbox"/>
               		 </form> 
                </div> -->
                
                <div class="footer_part3">
                	<ul>
                    	<li class="footer_facebook"><a href="#">facebook</a></li>
                        <li class="footer_twiter"><a href="#">twiter</a></li>
                        <li class="footer_google"><a href="#">google</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
            	<p>Copyright (c) Taskerrz.com</p>
            </div>
        </div>
    </div>

<!--footer end-->

</div>
<!--main wrapper end-->


<?php

    $PricerrTheme_enable_google_analytics = get_option('PricerrTheme_enable_google_analytics');
    if($PricerrTheme_enable_google_analytics == "yes"):     
        echo stripslashes(get_option('PricerrTheme_analytics_code'));   
    endif;
    
    //----------------
    
    $PricerrTheme_enable_other_tracking = get_option('PricerrTheme_enable_other_tracking');
    if($PricerrTheme_enable_other_tracking == "yes"):       
        echo stripslashes(get_option('PricerrTheme_other_tracking_code'));  
    endif;


?>


<script type="text/javascript">
	
	$( '#carousel' ).elastislide();
	
</script>


<script>
$(document).ready(function(){
  $('.slider1').bxSlider({
    slideWidth: 300,
    minSlides: 2,
    maxSlides: 3,
    moveSlides: 1,
    slideMargin: 10
  });
});
</script>
<script>
$(document).ready(function(){
  $('.slider0').bxSlider({
    slideWidth: 300,
    minSlides: 2,
    maxSlides: 3,
    moveSlides: 1,
    slideMargin: 10
  });
});
</script>

<?php wp_footer(); ?>
</body>
</html>