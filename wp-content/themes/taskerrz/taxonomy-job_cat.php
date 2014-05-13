<?php
/**
 * The template for displaying Taxonomy Job pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Taskerrz
 * @since Taskerrz 1.0
 */

get_header(); ?>
<!--blog start-->
 	<div class="clients">
    	<div class="container">
        	<div class="clients_inner listining">
                <div class="clients_inner_bottom1 about_us">
                	<?php
                    if ( have_posts() ) : 
                    	$catId = $wp_query->get_queried_object_id();
                    	$term = get_term( $catId, 'job_cat' );
                    ?>
                	<div class="clients_inner_bottom1-part">
	                    <div class="blog-details-part heading-listing">
	                    	<h4 align="center">Latest Posted Jobs in</h4>
	                        <br>
	                        <h3 align="center"><?php echo $term->name; ?></h3>
	                         <br>
	                    </div>          
	                    <br clear="all"/>      
                    </div>
                    <br>
                    
	                     <?php 
	                            while ( have_posts() ) : the_post();  
	                                //get_template_part( 'content', get_post_format() );
	                            	?>
	                            		<div class="clients_inner_bottom1">
					                		<div class="clients_inner_bottom1-part">
					                			<div class="blog-img">
					                    			<?php
						                    			$pic_id = PricerrTheme_get_first_post_image_ID(get_the_ID());
	
														if($pic_id != false) $img = pricerrtheme_generate_thumb3($pic_id, 'thumb_picture_size');
														else $img = get_bloginfo('template_url').'/images/nopic.jpg';
					                    			?>
					                    			<img src="<?php echo $img ?>" alt="<?php the_title() ?>" />
					                    		</div>
					                    		<div class="blog-details-part">
					                    			<p class="blog-head"><?php the_title(); ?></p>
					                        		<br>
					                        		<p class="read-more">
					                        			<a href="#" class="more">Express Job</a> &nbsp; &nbsp; &nbsp; 
					                        			<a href="<?php the_permalink();?>" class="more">View Details</a><br clear="all">
					                        		</p>                        
					                        		<p class="read-more">
					                        			<span class="by-long">By longsolution</span>  
					                        			<span class="from-joined">From: Joined: 127 days, 6 hours, 34 min </span>  
					                        			<span class="delivery">Delivery: 24Hrs</span>
					                            		<br clear="all">
					                        		</p>
					                        		<p class="read-more">
					                        			<a href="#" class="order">Order now $5.00</a>
					                            		<br clear="all">
					                        		</p>
					                        		<br clear="all">
					                    		</div>          
					                    		<br clear="all"/>      
					                    	</div>
					                	</div>
	                            	<?php
	                            endwhile; 
	                        ?>

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
            </div>
    	</div>	
    	<div class="sdow1"></div>
		<!--Recent Comments-->
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
	<!--blog end-->
<?php
get_footer();