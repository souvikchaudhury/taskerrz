<!-- equalizing  height -->
$.fn.equalHeights = function(minHeight, maxHeight) {
	tallest = (minHeight) ? minHeight : 0;
	this.each(function() {
		if($(this).height() > tallest) {
			tallest = $(this).height();
		}
	});
	if((maxHeight) && tallest > maxHeight) tallest = maxHeight;
	return this.each(function() {
		$(this).height(tallest);
	});
}

$(document).ready(function() {
	<!-- equalizing  height -->
	$(".recenr_categories_bottom .recenr_categories_box").equalHeights();	
});