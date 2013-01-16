<?require_once('../_includes/initialize.php');

//echo"delete";
$entry = Text::find_by_id($_GET['id']);
if($entry->destroy())
{
	redirect_to("index.php?ref=textList&page=".$session->get_page()); // write mesg to session? save offset to session?
}
?>