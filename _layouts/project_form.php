<?php
require_once('../_includes/initialize.php');
$entry;
if (isset($_GET['modify_id']))
{
	$idToFind = $_GET['modify_id'];
		
	$entry = Project::find_by_id($idToFind);
}
?>
<?php 
//echo output_message($message); 
//echo "session page: ".$session->get_page()."<br/>";
?>
<h1>Project Form</h1>
<form action="index.php?page=<? echo $session->get_page(); ?>" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="form_type" value="project" />
	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo Photograph::$max_file_size; ?>" />
<?
	if (isset($entry->image_title) && $entry->image_title!="")
	{
		echo "<img src=\"../_images/project_images/".$entry->image_title."\"/>";
		echo "<br/><input type=\"checkbox\" name=\"delete_image\" value=\"checked\" />Delete Image<br />";
	}
	if (isset($_GET['modify_id']))
	{
		echo "<input type=\"hidden\" name=\"modify_id\" value=\"".$_GET['modify_id']."\" />\n";
		echo "<input type=\"hidden\" name=\"entrytime\" value=\"".$entry->entrytime."\" />\n";
		if (isset($entry->image_title) && $entry->image_title!="")
		{
			echo "<input type=\"hidden\" name=\"image_title\" value=\"".$entry->image_title."\" />\n";
		}
	}
?>

	<p>Image: <input type="file" name="project_image" /></p>
	<p>Title: <input type="text" name="project_title" value="<?php if(isset($entry)){echo $entry->title;} ?>" /></p>
	<p>Entry: </p>
	<textarea name="project_entry" cols="100" rows="10"><?php if(isset($entry)){echo $entry->text;} ?></textarea>
	<br/>
	<p>vimeo ID: <input type="text" name="vimeoID" value="<?php if(isset($entry)){echo $entry->vimeoID;} ?>" /></p>
	<p>Overlay Text: </p>
	<textarea name="overlay_text" cols="100" rows="10"><?php if(isset($entry)){echo $entry->overlay_text;} ?></textarea>
	<br/>
	<input type="submit" name="submit" value="Submit"/>
</form>
	