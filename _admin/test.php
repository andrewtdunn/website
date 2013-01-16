<?php

require_once('../../includes/initialize.php');

//$session->logout();
if (!$session->is_logged_in()) {redirect_to("login.php");}
?>

<?php include_layout_template('admin_header.php'); ?>
	
<?php

	
	
	/*
	//testing create
	$user = new User();
	$user->username = "lonestar";
	$user->password = "beer";
	$user->first_name = "Rod";
	$user->last_name = "Steagall";
	$user->save();
	echo $user->full_name()." created.";
	*/
	
	
	//testing update
	if($user= User::find_by_id(11))
	{
		$user->username = "michaelstipe";
		$user->save();
	}
	
	
	
	//testing delete
	if($user = User::find_by_id(15))
	{
		$user->delete();
		echo $user->full_name()." is ghost.";
	}
	
	//testing read
	$users = User::find_all();
	echo "<hr/>";
	foreach ($users as $user) {
		echo $user->id."<br/>";
		echo $user->username."<br/>";
		echo $user->full_name()."<br/>";
		echo $user->password."<br/>";
		echo "<hr/>";
	}
	
?>
	
<?php include_layout_template('admin_footer.php'); ?>