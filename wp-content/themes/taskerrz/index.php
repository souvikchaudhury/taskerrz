<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Taskerrz
 * @since Taskerrz 1.0
 */

get_header(); ?>

<!--yellowpart start-->
    <div class="yellowpart">
    	<div class="container">
        <div class="yellowpart_inner">
                <div class="yellowpart_part1">
                    <h1>How </h1>
                    <h2>it works</h2>
                    <p>Nam id diam nisi. Ut velit velit, condimentum nec eleifend in, fringilla in </p>
                </div>
            
                <div class="yellowpart_part2">
                	<img src="<?php echo get_template_directory_uri().'/images/post.png'; ?>" alt="" />
                    <h3>Post</h3>
                    <h5>your Job</h5>
                    <p>It’s free</p>
                 </div>
                 
                <div class="yellowpart_part3">
                	<img src="<?php echo get_template_directory_uri().'/images/receive.png'; ?>" alt="" />
                    <h3>Receive</h3>
                    <h5>Proposals</h5>
                    <p>Matter of a few times</p>
                 </div>
                 
                <div class="yellowpart_part4">
                	<img src="<?php echo get_template_directory_uri().'/images/post.png'; ?>" alt="" />
                    <h3>Slect</h3>
                    <h5>Freelancers</h5>
                    <p>Begin your journey</p>
                 </div>
          </div>
        </div>
    </div>
<!--yellowpart end-->

<!--categories start-->
    <div class="categories">
    	<div class="container">
        	<div class="categories_inner">
            	<div class="categories_top">
                	<h2>Get to know about categories</h2>
                    <span>Nulla sit amet ipsum in lacus interdum auctor donec et est sed tortor sagittis </span>
                </div>
                
                <div class="categories_middle">
                    <div id="suggest" >
                        <form method="get" action="<?php echo get_permalink(get_option('PricerrTheme_advanced_search_id')); ?>">  
                            <div class="search_left">
                                <input type="text" onfocus="this.value=''" class="textbox" id="big-search" name="term1" autocomplete="off" onkeyup="suggest(this.value);"   value="<?php if(!empty($term_search)) echo htmlspecialchars($term_search); else echo $default_search; ?>" />
                            </div>
                            <div class="search_left">
                                <?php echo PricerrTheme_get_categories_slug_2_top_header('job_cat', $selected, __("Everywhere",'PricerrTheme'), "my_select_header  headerselectbox") ?>
                            </div>
                            <div class="search_left">           
                                <!-- <input type="image" width="32" id="big-search-submit" name="search_me" src="<?php bloginfo('template_url') ?>/images/search_icn.png" /> -->
                                <input type="Submit" value="Search" id="big-search-submit" name="search_me" class="submitbox"/>
                            </div>
                        </form>
                        <div class="suggestionsBox" id="suggestions" style="z-index:999;display: none;"> <img src="<?php echo get_bloginfo('template_url');?>/images/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                            <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
                        </div>
                    </div>

                	<!-- <form>
                        <input type="text" placeholder="Begin to search by typing here..." class="textbox" />
                        <select class="selectbox" >
                        	<option>Everywhere</option>
                        </select>
                        <input type="Submit" value="Search" class="submitbox"/>
               		</form>  -->
                </div>
                <div class="categories_bottom slider0">
                    <?php
                        $args = array(
                                    'type'                     => 'job',
                                    'orderby'                  => 'name',
                                    'order'                    => 'ASC',
                                    'taxonomy'                 => 'job_cat',
                                ); 
                        $categories = get_categories( $args );
                        $i = 1;
                        /*echo '<pre>';
                        print_r($categories);
                        echo '</pre>';*/
                        foreach($categories as $category) { 
                            echo $i==1 ?  '<div class="slide">' : '<br>';
                            
                            $acfFieldName = 'job_cat_'.$category->term_id;
                            $cat_image =get_field('jobs_category_image', $acfFieldName);
                            $i++;
                            $term_link = get_term_link( $category, 'job_cat' );
                            ?>
                                <div class="categories_box">
                                	<div class="categories_boxInner">
                                    	<img src="<?php echo $cat_image; ?>" alt="" />
                                    </div>
                                    <div class="categories_box_hover">
                                    	<ul>
                                    		<li><a href="<?php echo esc_url( $term_link );?>"><?php echo $category->name; ?></a></li>
                                        	<li><a href="<?php echo esc_url( $term_link );?>" class="morebtnbox">More</a></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php
                            if($i == 3){
                                echo '</div>';
                                $i=1;
                            }
                        }
                    ?>
                </div>
                
                
            </div>
        </div>	
    </div>
<!--categories end-->

<!--recenr_categories start-->
    <div class="recenr_categories">
    	<div class="container">
        	<div class="recenr_categories_inner">
            	<div class="recenr_categories_top">
                	<h2>Recent Job postings</h2>
                    <span>Nulla sit amet ipsum in lacus interdum auctor donec et est sed tortor </span>
                </div>
                 
                <div class="recenr_categories_bottom slider1">
                    <?php

                        $pargs = array(
                            'posts_per_page'   => -1,
                            'orderby'          => 'post_date',
                            'order'            => 'DESC',
                            'post_type'        => 'job',
                            'post_status'      => 'publish'
                            );
                        
                        $posts_array = get_posts( $pargs );
                        $j = 1;
                        /*echo '<pre>';
                        print_r($posts_array);
                        echo '</pre>';*/
                        foreach($posts_array as $post) { 
                            echo $j==1 ?  '<div class="slide">' : '<br>';
                            /*$imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                            $author_id=$post->post_author;*/
                            $j++;
                            PricerrTheme_get_post_thumbs();
                            if($j == 3){
                                echo '</div>';
                                $j=1;
                            }
                        }
                    ?>
                </div>
            </div>
        </div>	
    </div>
</div>
<!--recenr_categories end-->

<!--clients start-->
 <div class="clients">
    	<div class="container">
        	<div class="clients_inner googleaddshome">
                <?php
                if(is_home()):
                    $PricerrTheme_adv_code_home_below_content = stripslashes(get_option('PricerrTheme_adv_code_home_below_content'));
                    if(!empty($PricerrTheme_adv_code_home_below_content)):
                        // echo '<div class="full_width_a_div">';
                        echo $PricerrTheme_adv_code_home_below_content;
                        // echo '</div>';
                    endif;
                endif;
                ?>
            	<!-- <div class="clients_inner_top">
                	<h2>Our clients</h2>
                    <span>Nulla sit amet ipsum in lacus interdum auctor donec </span>
                </div>
                <div class="clients_inner_bottom">
                    
                 <ul id="carousel" class="elastislide-list">
					<li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint1.png'; ?>" alt="image01" /></a></li>
					<li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint2.png'; ?>" alt="image02" /></a></li>
					<li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint3.png'; ?>" alt="image03" /></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint4.png'; ?>" alt="image03" /></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint1.png'; ?>" alt="image01" /></a></li>
					<li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint2.png'; ?>" alt="image02" /></a></li>
					<li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint3.png'; ?>" alt="image03" /></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint4.png'; ?>" alt="image03" /></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint1.png'; ?>" alt="image01" /></a></li>
					<li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint2.png'; ?>" alt="image02" /></a></li>
					<li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint3.png'; ?>" alt="image03" /></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri().'/images/clint4.png'; ?>" alt="image03" /></a></li>
				</ul>
                
                
                </div> -->
                           	
            </div>
        </div>	
        <div class="sdow1"></div>
    </div>
<!--clients end-->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>