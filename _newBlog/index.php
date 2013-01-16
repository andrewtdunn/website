<?php require_once '../_includes/initialize.php'; ?>
<?php

	// 1. The current page number ($current_page)
	$page=!empty($_GET['page'])?(int)$_GET['page'] : 1;
	// 2. records per page ($per_page)
	$per_page=7;
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
	$session->pageTitle = "Andrew T. Dunn | Blog"
?>	
<?php include_layout_template('new_header.php'); ?>
<script>

	// keeps nav from scrolling off top of page
	
		$(window).scroll(function() 
		{
			if ($(this).scrollTop() > 1825) { //I just used 200 for testing
		        $("#scrollingDiv2").css({ "position": "fixed", "top": 0 });
		    }
			else
			if ($(this).scrollTop() > 208) { //I just used 200 for testing
		        $("#scrollingDiv").css({ "position": "fixed", "top": 0 });
		        $("#scrollingDiv2").css({ "position": "absolute", "top": "1825" });
		    } else {
		        $("#scrollingDiv").css({ "position": "absolute", "top": "208" }); //same here
		        $("#scrollingDiv2").css({ "position": "absolute", "top": "1825" });
		    }                        
		});                         
</script>
<script type="text/javascript" src="../_scripts/jquery-embedagram.pack.js"></script>
<script type="text/javascript">
	// instantiates instagram slide show
	$(document).ready(function() {
		$('#slideshow').embedagram({
			instagram_id: 41597549,
			thumb_width: 75,
			limit: 18
        });
        
       if ( $("#blog > article").size() < 7)
       {
       	 $('#twtr-widget-1').remove();
       	 $('#scrollingDiv2').remove();
       }
       if ( $("#blog > article").size() < 2)
       {
       		$('#slideshow').remove();
       }
       
  	});
  	
  	
  	
  	$('.blogPost p').each(function(){
         // Split text at each period.
         var text = $(this).text().split('.');
         
         	for( var i = 0; i < 1; i++ ) {
             // Wrap first letter in span.
             var first_letter = '<span class="sunkenFirstLetter">' + text[i].substr(0,1) + '</span>';
             // Wrap sentence in span.
             text[i] = '<span class="capsFirstSentence">' + first_letter + text[i].substring(1, text[i].length) + '</span>';
         	 }
         	$(this).html(text.join('.'));
         
      });
  	
</script>
<section class="col1"><?php require_once SITE_ROOT.DS.'_includes/navigation.php'; ?></section>
<section class="col2">
<?php require_once SITE_ROOT.DS.'_includes/iNav.php'; ?>
<h2>tous les jours &ccedil;'est pas la m&ecirc;me</h2>
<div align="center">
<?php print_pagination($pagination,$page, "index.php?");  ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
       
        $('.blogPost').mouseover(function(){
    		$(this).removeClass().addClass("blogPostOver");
   			}).mouseout(function(){
    			$(this).removeClass().addClass("blogPost");		
   		});
   		
   		$("section article:first-child").removeClass().addClass("blogPostOver");
   		
   		if ($(this).scrollTop() > 1825) { //I just used 200 for testing
		        $("#scrollingDiv2").css({ "position": "fixed", "top": 0 });
		    }
			else
			if ($(this).scrollTop() > 208) { //I just used 200 for testing
		        $("#scrollingDiv").css({ "position": "fixed", "top": 0 });
		        $("#scrollingDiv2").css({ "position": "absolute", "top": "1825" });
		    } else {
		        $("#scrollingDiv").css({ "position": "absolute", "top": "208" }); //same here
		        $("#scrollingDiv2").css({ "position": "absolute", "top": "1825" });
		    }    
   		
   })
   
</script>
<section id="blog"/>
<?php 
$flashIndex=0;
echo "";
foreach ($entries as $entry): 
?>
	<article class="blogPost" id="entry<?php echo $entry->id?>"> 
		<div align="center">
		<hgroup class="headerSection">
		<h3><?php echo $entry->title; ?></h3>
		</hgroup>
		</div>
		<?php 
		// if post contains an image, display an img tag
		// if image_title ends with .swf serialize the swf object
		if ((isset($entry->image_title)) && ($entry->image_title != ""))
		{
			$imageExt = substr($entry->image_title,-3);
			if ($imageExt == "swf")
			{
				print '<div id="flashholder" align="center" class="innerImage">';
				print '<div id="flashcontent'.$flashIndex.'">'.$entry->image_title.'</div></div>'."\n";
				print '<script type="text/javascript">';
				print 'var so'.$flashIndex.' = new SWFObject("../_images/blog_images/'.$entry->image_title.'",'.' "mymovie'.$flashIndex.'",'.' "400",'.' "300",'.' "8",'.' "#000000");';
				print "\n";
				print 'so'.$flashIndex.'.addParam('.'"wmode"'.','.'"opaque");';
				print 'so'.$flashIndex.'.write("flashcontent'.$flashIndex.'");';
		    	print '</script>'."\n";
				$flashIndex++;
			}	
			else 
			{
		  		echo "<img ";
				if (isset($entry->imgAlign))
				{
					switch ($entry->imgAlign) {
					    case "left":
					        echo "class =\"leftImg\"";
					        break;
						case "center":
					        echo "class =\"centerImg\"";
					        break;
					    case "right":
					        echo "class =\"rightImg\"";
					        break;
					}
					if ($entry->imgAlign == "") echo "class =\"centerImg\"";
				}
		  		echo "src=\"../_images/blog_images/".$entry->image_title."\" />";
		
			}	
		}
		?>
		<?php
		// creates large uppercase first letter and uppercase first line of every post
		if (strlen($entry->text)>100 && !stripos(substr($entry->text,0,100),"<iframe")
			&& strlen($entry->text)>100 && !stripos(substr($entry->text,0,200),"embed")
			&& strlen($entry->text)>100 && !stripos(substr($entry->text,0,400),"<object")
			&& (!stripos(substr($entry->text,0,100),"youtube") || stripos(substr($entry->text,0,100),"href=\"http://www.youtube") )
			
			&& !ctype_lower($entry->text[0]))
		{
			
			if (substr(($entry->text),0,2) !="<a")
			{
				echo "<span class=\"firstSunkenLetter\">".substr(($entry->text),0,1)."</span>";
				echo "<p class=\"longEntry\">".nl2br(stripslashes(substr($entry->text,1)))."</p>";
			}
			else 
			{
				$startIndex = (int) stripos($entry->text, ">") + 1;
				echo "<span class=\"firstSunkenLetter\">".substr(($entry->text),$startIndex,1)."</span>";
				echo "<p class=\"longEntry\">".nl2br(stripslashes(substr($entry->text,$startIndex+1)))."</p>";
			}
		}
		else
		{
			echo "<p>".nl2br(stripslashes($entry->text))."</p>";
		}
		?>
		
		<p class="meta"><?php  echo "Posted ";printDate( $entry->entrytime);echo"."; ?>  <a href="entry.php?id=<? echo $entry->id;?>&page=<?php echo $page; ?>">Comments(<?php echo count($entry->comments()); ?>)</a></p>
		<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fandrewtdunn.com%2F3blog%2Fcomments.php%3Fentry%3D'.$row['id'].'&amp;layout=standard&amp;show_faces=true&amp;width=400&amp;action=like&amp;colorscheme=dark&amp;height=80" ' .
				'scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:400px; height:80px;" allowTransparency="true"></iframe>

	</article>
<?php endforeach; ?>
</section>
<div align="center"><?php print_pagination($pagination,$page, "index.php?");  ?></div>
</section>
<?php include_layout_template('aside.php'); ?>
<?php include_layout_template('new_footer.php'); ?>

