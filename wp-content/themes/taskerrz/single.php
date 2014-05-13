<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Taskerrz
 * @since Taskerrz 1.0
 */

get_header(); ?>

<?php

	function taskerrz_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>
		<!-- <div class="clients_inner_bottom1 blog-btn-div">
	        <div class="old"><?php next_posts_link( 'Older posts', $the_query->max_num_pages ); ?></div>
	        <div class="new"><?php previous_posts_link( 'Newer posts' ); ?></div>
	    </div> -->
		<div class="clients_inner_bottom1 blog-btn-div">
				<?php
				if ( is_attachment() ) :
					?>
					<div class="old">
						<?php previous_post_link( '%link', __( 'Older posts', 'Taskerrz' ) ); ?>
					</div>
					<?php
				else :
					?>
					<div class="old">
						<?php previous_post_link( '%link', __( 'Older posts', 'Taskerrz' ) ); ?>
					</div>
					<?php
					?>
					<div class="new">
						<?php next_post_link( '%link', __( 'Newer posts', 'Taskerrz' ) ); ?>
					</div>
					<?php
				endif;
				?>
		</div>
		<?php
	}

?>

	<!--blog start-->
 <div class="clients">
    	<div class="container">
        	<div class="clients_inner">
            	<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();
				?>               
                <div class="clients_inner_bottom1">
                	<div class="clients_inner_bottom1-part">
                		<div class="blog-img">
                			<?php
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
								
								echo $sImgString; 
							?>
                   		</div>
	                    <div class="blog-details-part">
	                    	<p class="blog-head"><?php the_title(); ?></p>
	                        <br>
	                        <p class="blog-date">Posted on <?php the_time('F jS, Y') ?>  by <?php the_author() ?></p>
	                        <br><hr><br>
	                        <p class="blog-contain">
	                        	<?php the_content(); ?>
	                        </p>
	                        <!-- <p class="read-more">
	                        	<a href="#" class="more">Read more</a> &nbsp; &nbsp; &nbsp; <img src="images/all-social.jpg"/>
	                        </p> -->
	                        
	                    </div>          
                    	<br clear="all"/>      
                    </div>
                </div>
                
                 <div class="clients_inner_bottom1">
                 	<div class="clients_inner_top">
                		<h3>Leave your comment</h3>
	                	<div align="center" class="sml-txt">
	                    	Your email address will not be published. Required fields are marked *
	                    </div>
	                    
	                    <div class="form-blog">
	                    	<div align="left">
	                        	<input type="text" class="txt" onfocus="if(this.value=='Name*') this.value = ''" onblur="if(this.value=='') this.value = 'Name*'" value="Name*"> <input type="text" class="txt" onfocus="if(this.value=='Email*') this.value = ''" onblur="if(this.value=='') this.value = 'Email*'" value="Email*">
	                        </div>
	                        <div align="left">
	                        	<input type="text" class="txt" onfocus="if(this.value=='Website*') this.value = ''" onblur="if(this.value=='') this.value = 'Website*'" value="Website*"> 6 x&nbsp;<input type="text" class="txt1">&nbsp; = &nbsp; 18
	                        </div>
	                        <div align="left">
	                        	<textarea rows = "8" cols = "18" name ="details" placeholder="Add text"></textarea>
	                        </div>
	                        <div class="btn-post" align="center">
	                        	<input type="submit" value="Post comment">
	                        </div>
	                    </div>
                    </div>
                 </div>
                
                <?php
                taskerrz_post_nav();
                /*if ( comments_open() || get_comments_number() ) {
						comments_template();
				}*/
				endwhile;
			?>      	
            </div>
            <hr class="light">
        </div>	
        <div class="sdow1"></div>
        
<!--Recent Comments-->

	<div class="recent-comment">
    <div class="container">
    		<h5 align="center">Recent Comments</h5>
            <ul class="recent">
            	<?php 
                    $commentarg = array('status'=>'approve','number'=>'3',
                                        'orderby'=>'date','post_status'=>'publish',
                                        'order'=>'DESC');

                    $comments = get_comments($commentarg);
                    foreach($comments as $comment) :
                            ?>
                                <li>
                                    <span class="r-img">
                                        <?php echo get_avatar( $comment->comment_author_email,64 ); ?>
                                    </span>
                                    <span class="r-con">
                                        <?php echo $comment->comment_content; ?>
                                        <br><br> 
                                        <?php echo $comment->comment_author; ?>
                                    </span>
                                </li>
                            <?php
                    endforeach;
                ?>
            </ul>
            <br clear="all">
        </div>
    </div>
       
    <div class="recent-comment">
    <div class="container monthwisecat">
    	<hr class="light">
    
    		<h5 align="center">Select blog according to archives</h5>
            <ul class="archive">
            	<?php get_archives('monthly', '', 'html', '', '', FALSE); ?>
            </ul>
            <br clear="all">
        </div>
    </div>
    
    <div class="recent-comment">
    	<div class="container jobcategorylis">
    		<hr class="light">
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
<?php get_footer(); ?>