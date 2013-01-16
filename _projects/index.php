<?php require_once '../_includes/initialize.php'; ?>
<?php
	
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM projects ";
	$sql .= "ORDER BY RAND()";
	$projects = Project::find_by_sql($sql);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	
	$pageInfo = Text::find_by_id(3);
?>	
<?php include_layout_template('new_header.php'); ?>


		<script type="text/javascript" src="../_scripts/jquery.center.js"></script>
		<script type="text/javascript" src="../_scripts/farinspace-jquery.imgpreload-6e0e307/jquery.imgpreload.min.js"></script>
		<script type="text/javascript" src="../_scripts/marquee.js"></script>
		<script>
			$(window).scroll(function() {
	
				if ($(this).scrollTop() > 208) { //I just used 200 for testing
		        	$("#scrollingDiv").css({ "position": "fixed", "top": 0 });
		    	} else {
		        	$("#scrollingDiv").css({ "position": "absolute", "top": "208" }); //same here
		    	}  
	    	}); 
	    	
	    	$('a.enableOverlay').click(function()    {
        			$('<div id = "overlay" />').appendTo('body').fadeIn("slow");
			});
	    
		</script>
		<section class="col1">
		<?php require_once SITE_ROOT.DS.'_includes/navigation.php'; ?>
		</section>
		<section id="projects" class="col6">
				<?php require_once SITE_ROOT.DS.'_includes/iNav.php'; ?>			
				<div class="marquee_container">
					<div class="marquee_photos"></div>
					<div class="marquee_caption">
						<div class="marquee_caption_content"></div>
					</div>
					<div id="navSlide" class="marquee_nav"></div>
				</div>
			
			
			<div class="marquee_panels">

<?php foreach ($projects as $project): ?>
	
		
		<div class="marquee_panel">
			<img class="marquee_panel_photo" src="../_images/project_images/<?php echo $project->image_title; ?>" alt="<?php echo $project->title; ?>" width="700" />
			<div class="marquee_panel_caption">
				<img class="marquee_flag" src="../_siteImages/3panda.png" width="60" height="83" />
				<h2><?php echo $project->title; ?></h2>
				<p><?php echo $project->text; ?></p>
				<p><a class="enableOverlay">Check it out!</a></p>
			</div><!-- for marquee panel caption -->
			<div class="overlayContent"><?php echo $project->vimeoID; ?></div>
			<div class="overlayTextCopy"><p><?php echo nl2br(trim($project->overlay_text)); ?></p></div>
		</div><!-- for marquee panel class -->
		
<?php endforeach; ?>

			
		
		</div> <!-- for marquee panels -->
		<article id="siteIntro">
			<div>
				<hgroup class="headerSection">
					<h2><?php echo trim($pageInfo->title); ?></h2>
				</hgroup>
			</div>
			<div id="expo" class="text2col">
			<?php echo "<span id=\"leadLetter\">".substr(($pageInfo->text),0,1)."</span>";
				echo "<p class=\"longEntry\">".nl2br(stripslashes(substr($pageInfo->text,1)))."</p>"; ?>
    			
			
		</div>
		
		
		</article>
		<img class="pageImage" src="../_images/page_images/<?php echo $pageInfo->image_title; ?>"/>
		
		
		</section>
		
<?php include_layout_template('new_footer.php'); ?>