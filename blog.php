<?php require_once '_includes/initialize.php'; ?>
<?php

	// 1. The current page number ($current_page)
	$page=!empty($_GET['page'])?(int)$_GET['page'] : 1;
	// 2. records per page ($per_page)
	$per_page=6;
	// 3. total record cost ($total_count)
	$total_count = BlogEntry::count_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM blog_entries ";
	$sql .= "ORDER BY entrytime DESC ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
	
	
	$entries = BlogEntry::find_by_sql($sql);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	//if (!isset($session->page)){$session->page = $page;}
?>	
<?php include_layout_template('new_header.php'); ?>
<script>
	// keeps nav from scrolling off top of page
	$(window).scroll(function() {
    if ($(this).scrollTop() > 145) { //I just used 200 for testing
        $("#scrollingDiv").css({ "position": "fixed", "top": 0 });
    } else {
        $("#scrollingDiv").css({ "position": "absolute", "top": "145px" }); //same here
    }                           
});                         

</script>
<script type="text/javascript" src="_scripts/jquery-embedagram.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#slideshow').embedagram({
			instagram_id: 41597549,
			thumb_width: 250,
			limit: 4
        });
  	});
</script>

<section class="col1"><?php require_once '_includes/navigation.php'; ?></section>
<section class="col2">
<?php print_pagination($pagination,$page, "blog.php?"); ?>
<section id="blog"/>
<script type="text/javascript">
    $(document).ready(function() {
        $('.blogPost').bind("mouseover", function(){
            var color  = $(this).css("background-color");

            $(this).css("background", "#000000");

            $(this).bind("mouseout", function(){
                $(this).css("background", color);
            })    
        })    
    })
</script>
<?php 
$flashIndex=0;
echo "<br/><hr/>";
foreach ($entries as $entry): 
?>
	<article class="blogPost"> 
		<div align="center">
		<hgroup class="headerSection">
		<h3><?php echo $entry->title; ?></h3>
		</hgroup>
		</div>
		<br/>
		<?php 
		
		if ((isset($entry->image_title)) && ($entry->image_title != ""))
		{
			$imageExt = substr($entry->image_title,-3);
		if ($imageExt == "swf"){
			print '<div id="flashholder">';
			print '<div id="flashcontent'.$flashIndex.'">'.$entry->image_title.'</div></div>'."\n";
			print '<script type="text/javascript">';
			print 'var so'.$flashIndex.' = new SWFObject("_images/blog_images/'.$entry->image_title.'",'.' "mymovie'.$flashIndex.'",'.' "400",'.' "300",'.' "8",'.' "#000000");';
			print "\n";
			print 'so'.$flashIndex.'.addParam('.'"wmode"'.','.'"opaque");';
			print 'so'.$flashIndex.'.write("flashcontent'.$flashIndex.'");';
		    print '</script>'."\n";
			$flashIndex++;
		}	
		else 
		{
	
		  echo "<img src=\"_images/blog_images/".$entry->image_title."\" />";
		
		}
		}
		 
		?>

		</a>
		
		<p><?php echo nl2br($entry->text); ?></p>
		<p><?php  echo "posted on "; echo date(  "F j, Y  g:i a", strtotime( $entry->entrytime ) ) ?></p>
		<hr/>

	</article>
<?php endforeach; ?>
</section>
<?php print_pagination($pagination,$page, "blog.php?");  ?>
</section>
<?php include_layout_template('aside.php'); ?>
<?php include_layout_template('new_footer.php'); ?>

