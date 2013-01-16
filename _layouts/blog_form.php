<?php
require_once('../_includes/initialize.php');
$entry;
if (isset($_GET['modify_id']))
{
	$idToFind = $_GET['modify_id'];
		
	$entry = BlogEntry::find_by_id($idToFind);
}
?>
<h1>Blog Form</h1>
<form class="adminForm" action="index.php?page=<?echo $session->get_page();?>" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="form_type" value="blog" />
	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo Photograph::$max_file_size; ?>" />
<?
	if (isset($entry->image_title) && $entry->image_title!="")
	{
		echo "<img class=\"formImg\" src=\"../_images/blog_images/".$entry->image_title."\"/>";
		echo "<input type=\"checkbox\" name=\"delete_image\" value=\"checked\" />Delete Image<br />";
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

	<p>Image: <input type="file" name="blog_image" /></p>
<?

$left_status = 'unchecked';
$center_status = 'unchecked';
$right_status = 'unchecked';


if (isset($entry->imgAlign)) 
{

	$selected_radio = $entry->imgAlign;

	if ($selected_radio == 'left') 
	{
		$left_status = 'checked';
	}
	else if ($selected_radio == 'center') 
	{
		$center_status = 'checked';
	}
	else if ($selected_radio == 'right') 
	{
		$right_status = 'checked';
	}
}
else 
{
	$center_status = 'checked';
}


?>
	
	
	<input type ='radio' name='imgAlign' value='left' <?PHP print $left_status; ?>>Left <input type='radio' name='imgAlign' value='center' <?PHP print $center_status; ?>>Center <input type='radio' name='imgAlign' value='right' 
<?PHP print $right_status;?> >Right

	<p>Title: <input type="text" name="blog_title" value="<?php if(isset($entry)){echo $entry->title;} ?>" /></p>
	<p>Entry: </p>
	<textarea name="blog_entry" cols="100" rows="10"><?php if(isset($entry)){echo $entry->text;} ?></textarea>
	<br/>
	<input type="submit" name="submit" value="Submit"/>
</form>
	