<?php require_once '../_includes/initialize.php'; ?>
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
	$sql .= "WHERE id = ".$_GET['id'];
	
	
	$entries = BlogEntry::find_by_sql($sql);
	$entry = $entries[0];
	
	$comments = $entry->comments();
	
	if (isset($_POST['submit']))
	{
		$author=trim($_POST['author']);
		$body=trim($_POST['body']);
		
		if(md5($_POST['captchaText']) != $_SESSION['key'])
		{
	  		$errorMessage = "Please enter the code correctly!";
		}
		else
			{
			
			$new_comment = Comment::make($entry->id,$author,$body);
			if ($new_comment && $new_comment->save())// captcha testing here...
			{
				Logger::log_action(1,"{$author}","commented on","{$entry->id}");
				
				$destination_email = "atd2005@gmail.com";
				
				$blogEntry = BlogEntry::find_by_id($entry->id);
				/* move to blog entry class */
				$blogEntryTitle = $blogEntry->title; 
				if ($blogEntryTitle == "") $blogEntryTitle = "untitled";
				$email_subject = "{$author} commented on {$blogEntryTitle}";
				
				$emailText = stripslashes($body);		
	
				$email_body = "'{$emailText}'"; ;
				
						
				mail($destination_email, $email_subject, $email_body);
				// comment saved
				// No message needed, seeing the comment is proof enough.
				
				// Important! You could just let the page render from here.
				// But then if the page is reloaded, the form will try
				// to resubmit the comment. So redirect instead:
				redirect_to("entry.php?id={$entry->id}&page={$page}");
			}
			else {
				
				// Failed
				$message = "There was an error that prevented the comment from being saved.";
			}
		}
	}
	else {
		$author="";
		$body="";
	}
	
	
	if(isset($entry->title)) $session->ogTitle = $entry->title;	
	if (isset($entry->image_title) && ($entry->image_title !="")) $session->ogImg = "http://www.andrewtdunn.com/_images/blog_images/".$entry->image_title;
	if(isset($entry->text)) $session->ogDesc = trim(str_replace("\"", "'", first_sentence($entry->text)));
	$session->pageTitle = "Andrew T. Dunn | Blog"
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	//if (!isset($session->page)){$session->page = $page;}
?>	
<?php include_layout_template('new_header.php'); ?>
<script>
	// keeps nav from scrolling off top of page
	$(window).scroll(function() {
    if ($(this).scrollTop() > 208) { //I just used 200 for testing
        $("#scrollingDiv").css({ "position": "fixed", "top": 0 });
    } else {
        $("#scrollingDiv").css({ "position": "absolute", "top": "208" }); //same here
    }                                
});                         

</script>
<script type="text/javascript" src="../_scripts/jquery-embedagram.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#slideshow').embedagram({
			instagram_id: 41597549,
			thumb_width: 75,
			limit: 18
        });
  	});
</script>
<?php require_once SITE_ROOT.DS.'_includes/iNav.php'; ?>
<section class="col1"><?php require_once SITE_ROOT.DS.'_includes/navigation.php'; ?></section>
<section class="col2">
<h2>tous les jours &ccedil;'est pas la m&ecirc;me</h2>
<script type="text/javascript" src="../_scripts/blueHeader.js"></script>
<p class="blueHeader"><a href="index.php?page=<?php echo $page; ?>#entry<?php echo $entry->id; ?>"><span class="arrow">&larr;</span> Back to Blog</a></p>
<script type="text/javascript">
    $(document).ready(function() {
       
        $('.blogPost').mouseover(function(){
    		$(this).removeClass().addClass("blogPostOver");
   			}).mouseout(function(){
    			$(this).removeClass().addClass("blogPost");		
   		});
   		
   		$("section article:first-child").removeClass().addClass("blogPostOver");
   		
   })
   
</script>
<?php $flashIndex=0; ?>
<section id="blog"/>
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

		</a>
		
		<?php
		
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
		<p class="meta"><?php  echo "Posted ";printDate( $entry->entrytime);echo".";  ?></p>
	<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fandrewtdunn.com%2F3blog%2Fcomments.php%3Fentry%3D'.$row['id'].'&amp;layout=standard&amp;show_faces=true&amp;width=400&amp;action=like&amp;colorscheme=dark&amp;height=80" ' .
				'scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:400px; height:80px;" allowTransparency="true"></iframe>

	<hr class="grayBar"/>
	<?php foreach($comments as $comment):?>
	<div class="comment">
		<hgroup><span class="commentAuthor"><?php echo stripslashes($comment->author); ?></span><span class="said"> said:</span></hgroup>
		<p><?php echo nl2br(stripslashes($comment->body)); ?></p>
		<p class="meta"><?php  echo "Posted ";printDate( $comment->created);echo"."; ?></p>
	</div>
	<?php endforeach ?>
	<div id="commentForm">
		<hgroup class="blueHeader">New Comment:</hgroup>
		<form action="entry.php?id=<?php echo $entry->id; ?>&page=<?php echo $_GET['page']; ?>" method="post">
			<input class="entryComment" type="text" name="author" placeholder="Name" value="<?php echo $author?>" />
			<textarea class="entryComment" name="body" placeholder="Comment..." cols="40" rows="8"><?php echo $body; ?></textarea></p>
			<div id="captcha">
			<p>
		   		<label for="captchaText">Prove you are human:</label>
		   		<input name="captchaText" type="text" size="5" id="captchaText" value=""/>
		   		<img alt="captcha" src="captcha.php">
		   	<p/>
		   	</div>
		   	<?php 
				if(isset($errorMessage))
				{
					print '<div class="error">'.$errorMessage.'</div>'."\n";
				}
			?>
			<br/>
			<p><input class="submitButton" type="submit" name="submit" value="Submit Comment"/></p>
		</form>
	</div>

	</article>

</section>

</section>
<?php include_layout_template('aside2.php'); ?>
<?php include_layout_template('new_footer.php'); ?>