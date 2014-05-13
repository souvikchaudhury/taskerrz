<script type='text/javascript'>
jQuery(document).ready(function(){

jQuery('#comments').prev().prev().hide();
jQuery('#comments').hide();

jQuery('.blog-details-part').each(function(){
    readmoreHtm = jQuery(this).find('.read-more').html();
    jQuery(this).find('.hupso-share-buttons').prepend('<p class="read-more">'+readmoreHtm+'</p>');
});

})
</script>
<!--blog start-->

 <div class="clients">
    	<div class="container">
        	<div class="clients_inner">
            	<div class="clients_inner_top">
                	<h2>Latest blog postings</h2>
                    <span>Nulla sit amet ipsum in lacus interdum auctor donec </span>
                </div>
                <?php
                
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $argss = array( 
                        'post_type' => 'post', 
                        'post_status' => 'publish', 
                        'posts_per_page' => 5,         
                        'order' => 'DESC',    
                        'orderby' => 'date',
                        'paged' => $paged
                        );

                    $the_query = new WP_Query( $argss );

                    if ( $the_query->have_posts() ) : ?>

                        <?php while ( $the_query->have_posts() ) : $the_query->the_post();  

                        $arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . get_the_ID());
                                                     
                                if($arrImages) 
                                 {
                                    $arrKeys    = array_keys($arrImages);
                                    $iNum       = $arrKeys[0];
                                    $sThumbUrl  = wp_get_attachment_thumb_url($iNum);
                                    $sImgString = '<a href="'.get_permalink().'">'.'<img class="image_class" src="'.$sThumbUrl.'" width="100" height="100" />'.'</a>';
                                 }
                                else
                                 $sImgString = '<a href="'.get_permalink().'">'.'<img class="image_class" src="'.get_bloginfo('template_url').'/images/nopic.jpg" width="100" height="100" />'.'</a>';
                        ?>
                        <div class="clients_inner_bottom1">
                            <div class="clients_inner_bottom1-part">
                                <div class="blog-img">
                                    <?php echo $sImgString; ?>
                                </div>
                                <div class="blog-details-part">
                                    <p class="blog-head">
                                        <?php the_title(); ?>
                                    </p>
                                    <br>
                                    <p class="blog-date">Posted on <?php the_time('F jS, Y') ?>  by <?php the_author() ?></p>
                                    <br>
                                    <hr>
                                    <br>
                                    <p class="blog-contain">
                                        <?php the_excerpt(); ?>
                                    </p>
                                    <p class="read-more" style="display:none;">
                                        <a href="<?php the_permalink() ?>" class="more">Read more</a>
                                    </p>
                                </div>          
                                <br clear="all"/> 
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <div class="clients_inner_bottom1 blog-btn-div">
                        <div class="old"><?php next_posts_link( 'Older posts', $the_query->max_num_pages ); ?></div>
                        <div class="new"><?php previous_posts_link( 'Newer posts' ); ?></div>
                    </div>
                    <?php 
                    // clean up after our query
                    wp_reset_postdata(); 
                    ?>

                <?php else:  ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                <?php endif; 
                ?>
            </div>
            <hr class="light">
        </div>	
        <div class="sdow1"></div>
        
<!-- Recent Comments -->

	<div class="recent-comment">
    <div class="container">
    		<h5 align="center">Recent Comments</h5>
            <ul class="recent">
                <?php 
                    $comments = get_comments($argss);
                    /*echo '<pre>';
                    print_r($comments);
                    echo '</pre>';*/
                    foreach($comments as $comment) :
                        if($i<3){
                            // echo $comment->comment_ID.'<br>';
                            ?>
                                <li>
                                    <span class="r-img">
                                        <!-- <img src="images/r1.jpg"> -->
                                        <?php echo get_avatar( $comment->comment_author_email,64 ); ?>
                                    </span>
                                    <span class="r-con">
                                        <?php echo $comment->comment_content; ?>
                                        <br><br> 
                                        <?php echo $comment->comment_author; ?>
                                    </span>
                                </li>
                            <?php
                            $i++;
                        }
                        // echo($comment->comment_author . '<br />' . $comment->comment_content);
                    endforeach;
                ?>
            	<!--  -->
                
            </ul>
            <br clear="all">
        </div>
    </div>
       
    <div class="recent-comment">
    <div class="container">
    	<hr class="light">
            
    		<h5 align="center">Select blog according to archives</h5>
            <ul class="archive">
            	<?php get_archives('monthly', '', 'html', '', '', FALSE); ?>
            </ul>
            <br clear="all">
        </div>
    </div>
    
    <div class="recent-comment">
    <div class="container category">
    	<hr class="light">
    
    		<h5 align="center">Blog Categories</h5>
            <ul class="archive">
            	<li>
                	<a href="#">Administrative & VA(2) </a>
                </li>
                <li>
                	<a href="#">Article Marketing(5) </a>
                </li>
                <li>
                	<a href="#">Gifts(1)</a>
                </li>
                <li>
                	<a href="#"> Music & Audio(0) </a>
                </li>
                <li>
                	<a href="#">SEO(45)</a>
                </li>
                <li>
                	<a href="#">Video & Animation(7) </a>
                </li>
                <li>
                	<a href="#">Adsense(1)</a>
                </li>
             </ul>
             <ul class="archive">
                <li>
                	<a href="#">Business(17)  </a>
                </li>
                <li>
                	<a href="#">Graphic & Design(8)  </a>
                </li>
                <li>
                	<a href="#">Online Marketing(10)  </a>
                </li>
                <li>
                	<a href="#">Task Runner(0)</a>
                </li>
                <li>
                	<a href="#"> Writing & Translation(7) </a>
                </li>
                <li>
                	<a href="#">Advertising(18)</a>
                </li>
              </ul>
              <ul class="archive">  
                <li>
                	<a href="#">Customer Support(0)  </a>
                </li>
                <li>
                	<a href="#">Internet Marketing(13)  </a>
                </li>
                <li>
                	<a href="#">Other(10)    </a>
                </li>
                <li>
                	<a href="#">Technology(8) </a>
                </li>
                <li>
                	<a href="#">Affiliate Marketing(3) </a>
                </li>
                <li>
                	<a href="#">Fun & Bizarre(2)   </a>
                </li>
              </ul>
              <ul class="archive">
                <li>
                	<a href="#">Lifestyle(2)   </a>
                </li>
                <li>
                	<a href="#">Programming(11) </a>
                </li>
                <li>
                	<a href="#">Travel(0)  </a>
                </li>
            </ul>
            <br clear="all">
        </div>
    </div>

<!-- -Recent Comments -->        
        
    </div>
<!--blog end-->
<?php
   // get_footer();
?>