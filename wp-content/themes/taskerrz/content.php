<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Taskerrz
 * @since Taskerrz 1.0
 */
?>

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