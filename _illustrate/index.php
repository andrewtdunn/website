<?php require_once '../_includes/initialize.php'; ?>
<?php 
$pageName = "Illustrate";
$text = Page::getTextForPage($pageName);
$session->pageTitle="Andrew T. Dunn | ".$pageName;
include_layout_template('new_header.php'); ?>
<script type="text/javascript" src="../_scripts/jquery-embedagram.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
       $("#scrollingDiv2").remove();
       $('#slideshow').embedagram({
			instagram_id: 41597549,
			thumb_width: 75,
			limit: 18
        });
      
  	});
  	
  	 $(window).scroll(function() 
  	 {
		if ($(this).scrollTop() > 208) 
		{ //I just used 200 for testing
	        $("#scrollingDiv").css({ "position": "fixed", "top": 0 });
	    } 
	    else 
	    {
	        $("#scrollingDiv").css({ "position": "absolute", "top": "208" }); //same here
	  	}
	  });  
	    
</script>
<section class="col1"><?php require_once SITE_ROOT.DS.'_includes/navigation.php'; ?></section>
<section class="col2">
<h2><?php echo $text->title?></h2>
<section id="blog"/>
	<div class="artHolder">
	<div id="flashcontentArt"> Illustrate My Life </div>
     <script type="text/javascript">
			var so = new SWFObject("PicCalendar.swf", "mymovie", "500", "530", "8", "#000000");
			so.addParam("wmode","opaque");
   			so.write("flashcontentArt");
	</script>
	</div>
	<p class="supportText"><?php echo $text->text; ?></p>
</section>
</section>
<?php include_layout_template('aside2.php'); ?>
<?php include_layout_template('new_footer.php'); ?>

