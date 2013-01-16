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
		$friend;
		if(isset($_POST['modify_id']))
		{
			$edited = true;	
			$friend = Friend::find_by_id($_POST['modify_id']);
			Logger::log_action(2, "admin" , "modifying", "{$friend->title}");
		}
		else {
			$friend = new Friend();
		}
		if(isset($_POST['friend_title']))$blogEntry->title = $_POST['friend_title'];
		
		
		$fileAttachHasntFailed = true;
		
		if($_FILES['friend_image']['name'] != "" && $_FILES['friend_image']['name'] != $friend->image_title )
		{
			// updating
			$newImageName = $_FILES['friend_image']['name'];
			Logger::log_action(2, "admin" , "image name found", "{$newImageName}");
			if($blogEntry->attach_file($_FILES['blog_image']))
			{
				//if old entry found, delete it
				if ($blogEntry->image_title != "")
				{
					Logger::log_action(2, "admin" , "friend image file deleted", "{$_POST['image_title']}");
					$target_path = $friend->image_path(); // but what if there is no image
					unlink($target_path);
					$friend->image_title =""; // erase title
				}
				// creating new entry
				$friend->image_title = $friend->filename;	
				Logger::log_action(2, "admin" , "friend file attached", "{$imageName}");
			}
			else
			{
				Logger::log_action(2, "admin" , "friend file attached failed", "{$imageName}");
				echo $friend->errors();	
				$fileAttachHasntFailed = false;	
			}
		}
		else if($friend->image_title !="" && $_FILES['friend_image']['name'] == "") // no update
		{
		//	echo "updated - old filename is ".$blogEntry->image_title;
			Logger::log_action(2, "admin" , "old title: {$friend->image_title}", "no new title found");
		}
		if(isset($_POST['delete_image'])) // delete imaage
		{
			Logger::log_action(2, "admin" , "image file deleted", "{$blogEntry->image_title}");
			$target_path = /*SITE_ROOT.DS.'public'.DS.*/$friend->image_path(); // but what if there is no image
			unlink($target_path);
			$friend->image_title =""; // erase title
		}
		
		if($fileAttachHasntFailed)
		{
			$username = User::find_by_id($session->user_id)->username;
			if($friend->save())
			{
				// Success
				//$session->message("Blog entry uploaded successfully.");
				if (!$edited)
				{Logger::log_action(1,"{$username}","added a friend", "{$friend->id}");}
				else
				{Logger::log_action(1,"{$username}","edited friend - ", "{$friend->id}");}
				redirect_to("index.php?ref=friendList&page=".$session->get_page());
			}
			else 
			{
				Logger::log_action(2,"{$username}","save failed", "{$blogEntry->id}");
			 	// Failure
			 	$message = join("<br/>", $friend->errors);
				echo( "save failed. errors: ".$message);
			}
		}
	}
	

?>
