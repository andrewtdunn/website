<?php
require_once('../_includes/initialize.php');

//echo"delete";
$entry = Todo::find_by_id($_GET['id']);
if($entry->delete())
{
	redirect_to("index.php?ref=todoList&page=".$session->get_page()); // write mesg to session? save offset to session?
}
?>