<?php 
require_once("../_includes/initialize.php");
?>
<?php
if (!$session->is_logged_in())
{
	redirect_to("login.php");
}


if (isset($_GET['clear']) && $_GET['clear']=='true')
{
	Logger::clear_log($session->user_id);	
}

?>
<?php

include_layout_template('admin_header.php'); 

?>

<a href="index.php">&laquo; Back</a><br/>
<br/>

<p><a href="logfile.php?clear=true">Clear log file</a></p>

<?php

	Logger::print_log();
?>

<?php include_layout_template('admin_footer.php'); ?>