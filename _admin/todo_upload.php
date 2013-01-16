<?php

require_once('../_includes/initialize.php');

//$session->logout();
//if (!$session->is_logged_in()) {redirect_to("login.php");}
?>
<?php
	$message = "";
	if (isset($_POST['submit']))
	{
		$edited = false;
		$todo;
		if(isset($_POST['modify_id']))
		{
			$todo = Todo::find_by_id($_POST['modify_id']);
		}
		else {
			$todo = new Todo();
		}
		if(isset($_POST['description']))$todo->description = $_POST['description'];
		
			$username = User::find_by_id($session->user_id)->username;
			if($todo->save())
			{
				redirect_to("index.php?ref=todoList&page=".$session->get_page());
			}
			else 
			{
			 	// Failure
			 	$message = join("<br/>", $todo->errors);
				echo( "save failed. errors: ".$message);
			}
	}
	

?>
