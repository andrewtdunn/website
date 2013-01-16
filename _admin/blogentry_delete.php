<?php
require_once('../_includes/initialize.php');

//echo"delete";
$entry = BlogEntry::find_by_id($_GET['id']);
if($entry->destroy())
{
	redirect_to("index.php?ref=blogList&page=".$session->get_page()); // write mesg to session? save offset to session?
}
?>