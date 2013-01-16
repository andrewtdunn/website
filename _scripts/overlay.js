console.log("go");
var $overlay = $('<div id="overlay" />').prependTo('body'),
$enable = $('#enableOverlay'),
toggle = function () {
	if($enable.hasClass('active')) {
    	$overlay.fadeOut(400, function () {
        	/* In callback so it doesn't jump to the back of the overlay */
            $footer.removeClass('abs');
         });
            $enable.removeClass('active');
                
                
         } else {
            $enable.addClass('active');
            $overlay.fadeIn();
                
            $footer.css({left: $footer.offset().left, top: $footer.offset().top}).addClass('abs');
         }
}