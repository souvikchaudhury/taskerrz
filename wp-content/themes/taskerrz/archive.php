<?php
/**
 * The template for displaying Archive pages
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

<script type='text/javascript'>
jQuery(document).ready(function(){
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
                
                    /*$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $argss = array( 
                        'post_type' => 'post', 
                        'post_status' => 'publish', 
                        'posts_per_page' => 5,         
                        'order' => 'DESC',    
                        'orderby' => 'date',
                        'paged' => $paged
                        );

                    $the_query = new WP_Query( $argss );*/

                    if ( have_posts() ) : ?>

                        <?php 
                            while ( have_posts() ) : the_post();  
                                get_template_part( 'content', get_post_format() );
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
            <hr class="light">
    </div>  
    <div class="sdow1"></div>
        
<!-- Recent Comments -->

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

<!-- -Recent Comments -->        
        
</div>
<!--blog end-->
<?php
get_footer();
