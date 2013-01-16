<?php
require_once('../_includes/initialize.php');
$entry;
if (isset($_GET['modify_id']))
{
	$idToFind = $_GET['modify_id'];
		
	$entry = Todo::find_by_id($idToFind);
}
?>
<h1>To Do Item:</h1>
<form class="adminForm" action="index.php?page=<?echo $session->get_page();?>" enctype="multipart/form-data" method="POST">
	<?
	if (isset($_GET['modify_id']))
	{
		echo "<input type=\"hidden\" name=\"modify_id\" value=\"".$_GET['modify_id']."\" />\n";
	}
?>
	<input type="hidden" name="form_type" value="todo" />
	<p>Description: </p>
	<textarea name="description" cols="100" rows="10"><?php if(isset($entry)){echo $entry->description;} ?></textarea>
	<br/>
	<input type="submit" name="submit" value="Submit"/>
</form>
	