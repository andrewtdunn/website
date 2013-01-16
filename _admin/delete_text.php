$friend<?require_once('../_includes/initialize.php');

//echo"delete";
$entry = Friend::find_by_id($_GET['id']);
if($entry->destroy())
{
	redirect_to("index.php?ref=friendList&page=".$session->get_page()); // write mesg to session? save offset to session?
}
?>