<?php
require_once('../_includes/initialize.php');
$entry;
if (isset($_GET['modify_id']))
{
	$idToFind = $_GET['modify_id'];
		
	$entry = Text::find_by_id($idToFind);
}
?>
<h1>Text Form</h1>
<form class="adminForm" action="index.php?page=<?echo $session->get_page();?>" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="form_type" value="text" />
	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo Photograph::$max_file_size; ?>" />
<?php
/*
print '<select name = "category">'."\n";
print '<option value = "none">Select a Category</option>'."\n";   
$Categories = mysql_query('SELECT * FROM ref_categories',
$connectID);

while ($Category = mysql_fetch_array($Categories,MYSQL_ASSOC)){

print'<option value="'.$Category['id'].'"';

	if($record_data['cat_id']==$Category['id'])print" selected=\"selected\" ";
	
	print '>'.$Category['category_name']."</option>\n";
}
print '</select>'."<br/>\n";
*/
?>	
<?
	if (isset($entry->image_title) && $entry->image_title!="")
	{
		echo "<img src=\"../_images/page_images/".$entry->image_title."\"/>";
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

	<p>Image: <input type="file" name="text_image" /></p>
	
<?php


$pages = Page::find_all();
if (isset($entry->page_id) && $entry->page_id != "")
{
		print "page id:".$entry->page_id;
}
else 
{
	print '<select name = "text_page_id">'."\n";
	print '<option value = "none">Select a Page</option>'."\n";   
	foreach ($pages as $page) 
	{
		print'<option value="'.$page->id.'"';
		print '>'.$page->page_name."</option>\n";
	}
}


print '</select>'."<br/>\n";
?>

	<p>Title: <input type="text" name="text_title" value="<?php if(isset($entry)){echo $entry->title;} ?>" /></p>
	<p>Entry: </p>
	<textarea name="text_entry" cols="100" rows="10"><?php if(isset($entry)){echo $entry->text;} ?></textarea>
	<br/>
	<input type="submit" name="submit" value="Submit"/>
</form>
	