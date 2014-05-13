<?php
function pricerrTheme_posts_where( $where ) {

			global $wpdb, $term;			
			$where .= " AND ({$wpdb->posts}.post_title LIKE '%$term%' OR {$wpdb->posts}.post_content LIKE '%$term%')";
	
		return $where;
}
	//hello
function PricerrTheme_adv_src_area_function()
{
	
	$my_order = pricerrtheme_get_current_order_by_thing();
	
?>
<div class="clients">
    <div class="container">
       	<div class="clients_inner listining">
            <div class="clients_inner_bottom1 about_us">
               	<div class="clients_inner_bottom1-part">
                    <div class="blog-details-part heading-listing">
                    	<h4 align="center"><?php echo sprintf( __("Advanced search for jobs",'PricerrTheme'));	?></h4>
                        <br>
                    </div>          
                    <br clear="all"/>      
                </div>
                <br>

				<?php
					$meta_querya = array();
					global $term;
					$term = trim(strip_tags($_GET['term1']));
					if(!empty($_GET['term1'])) {
						add_filter( 'posts_where' , 'PricerrTheme_posts_where' );		
					}
					if(isset($_GET['order'])) $order = $_GET['order'];
					else $order = "DESC";
	
					if(isset($_GET['orderby'])) $orderby = $_GET['orderby'];
					else $orderby = "date";
	
					if(isset($_GET['meta_key'])) $meta_key = $_GET['meta_key'];
					else $meta_key = "";
	
					$closed = array(
							'key' => 'closed',
							'value' => "0",
							//'type' => 'numeric',
							'compare' => '='
						);
		
					if(isset($_GET['featured']))
					{
						if($_GET['featured'] == "1"):
							$featured = array(
								'key' => 'featured',
								'value' => "1",
								//'type' => 'numeric',
								'compare' => '='
							);				
						endif;
					}
	
					if(!empty($_GET['job_location_cat'])) $loc = array(
							'taxonomy' => 'job_location',
							'field' => 'slug',
							'terms' => $_GET['job_location_cat']
						
					);
					else $loc = '';
	
	
					if(!empty($_GET['job_cat_cat'])) $adsads = array(
							'taxonomy' => 'job_cat',
							'field' => 'slug',
							'terms' => $_GET['job_cat_cat']
						
					);
					else $adsads = '';
	
					array_push($meta_querya,$closed);
					array_push($meta_querya,$featured);

					//-----------------------------------------------------

					$nrpostsPage = 16;
					
					if(isset($_GET['pj'])) $pj = $_GET['pj'];
					else $pj = 1;
					
					$my_page = $pj;
					

					$args = array('posts_per_page' => $nrpostsPage, 'paged' => $pj, 'post_type' => 'job', 'order' => $order , 'meta_query' => $meta_querya ,'meta_key' => $meta_key, 'orderby'=>$orderby, 'tax_query' => array($loc, $adsads));
					$the_query = new WP_Query( $args );

					$nrposts = $the_query->found_posts;
					$totalPages = ceil($nrposts / $nrpostsPage);
					$pagess = $totalPages;
				
					// The Loop
					$my_arr = array(); $i = 0;
					if($the_query->have_posts()):
						while ( $the_query->have_posts() ) : $the_query->the_post();
							if($view != "grid")
								PricerrTheme_get_post();
							else
							 	PricerrTheme_get_post_thumbs();
						endwhile;
						
						//********************** pagination ***********************************
								 	
						$batch = 10; //ceil($page / $nrpostsPage );
						$end = $batch * $nrpostsPage;
						$pages_curent = $my_page;

						if ($end > $pagess) {
							$end = $pagess;
						}
						$start = $end - $nrpostsPage + 1;
						if($start < 1) 
							$start = 1;
						$links = '';
						$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
						$start 		= $raport * $batch + 1; 
						$end		= $start + $batch - 1;
						$end_me 	= $end + 1;
						$start_me 	= $start - 1;
					
						if($end > $totalPages) 
							$end = $totalPages;
						if($end_me > $totalPages) 
							$end_me = $totalPages;
						if($start_me <= 0) 
							$start_me = 1;
						$previous_pg = $page - 1;
						if($previous_pg <= 0) 
							$previous_pg = 1;
						$next_pg = $pages_curent + 1;
						if($next_pg > $totalPages) 
							$next_pg = 1;
					?>
						<div class="clients_inner_bottom1 blog-btn-div">        
							<?php
								//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)
								if($my_page > 1)
								echo '<div class="old"><a href="'.PricerrTheme_get_adv_search_pagination_link($previous_pg).'"><< '.__('Previous','PricerrTheme').'</a></div>';
								// echo '<a href="'.PricerrTheme_get_adv_search_pagination_link($start_me).'"><<</a>';		
								//------------------------
								//echo $start." ".$end;
								for($i = $start; $i <= $end; $i ++) {
									if ($i == $pages_curent) {
										echo '<a class="activee" href="#" style="display:none;">'.$i.'</a>';
									} else {	
										echo '<a href="'.PricerrTheme_get_adv_search_pagination_link($i).'" style="display:none;">'.$i.'</a>';				
									}
								}		
								//----------------------
								/*if($totalPages > $my_page)
									echo '<a href="'.PricerrTheme_get_adv_search_pagination_link($end_me).'">>></a>';*/
								echo '<div class="new"><a href="'.PricerrTheme_get_adv_search_pagination_link($next_pg).'">'.__('Next','PricerrTheme').' >></a></div>';						
							?> 
		    			</div>
    					<?php
							//*********************************************************************
					else:
						_e('No results found.','PricerrTheme');
					endif;
				?>
			</div>
		</div>
	</div>
</div>
<?php	
	
}

?>
