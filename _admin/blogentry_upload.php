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
		$blogEntry;
		if(isset($_POST['modify_id']))
		{
			$edited = true;	
			$blogEntry = BlogEntry::find_by_id($_POST['modify_id']);
			Logger::log_action(2, "admin" , "modifying", "{$blogEntry->title}");
		}
		else {
			$blogEntry = new BlogEntry();
		}
		if(isset($_POST['blog_title']))	$blogEntry->title = $_POST['blog_title'];
		if(isset($_POST['blog_entry']))	$blogEntry->text = $_POST['blog_entry'];
		if(isset($_POST['imgAlign'])) 	$blogEntry->imgAlign = $_POST['imgAlign'];
	
		
		$fileAttachHasntFailed = true;
		
		if($_FILES['blog_image']['name'] != "" && $_FILES['blog_image']['name'] != $blogEntry->image_title )
		{
			// updating
			$newImageName = $_FILES['blog_image']['name'];
		//	Logger::log_action(2, "admin" , "image name found", "{$newImageName}");
			if($blogEntry->attach_file($_FILES['blog_image']))
			{
				//if old entry found, delete it
				if ($blogEntry->image_title != "")
				{
			//		Logger::log_action(2, "admin" , "image file deleted", "{$_POST['image_title']}");
					$target_path = $blogEntry->image_path(); // but what if there is no image
					unlink($target_path);
					$blogEntry->image_title =""; // erase title
				}
				// creating new entry
				$blogEntry->image_title = $blogEntry->filename;	
			//	Logger::log_action(2, "admin" , "file attached", "{$newImageName}");
			}
			else
			{
				Logger::log_action(2, "admin" , "file attached failed", "{$newImageName}");
				echo $blogEntry->errors();	
				$fileAttachHasntFailed = false;	
			}
		}
		else if($blogEntry->image_title !="" && $_FILES['blog_image']['name'] == "") // no update
		{
		//	echo "updated - old filename is ".$blogEntry->image_title;
		//	Logger::log_action(2, "admin" , "old title: {$blogEntry->image_title}", "no new title found");
		}
		if(isset($_POST['delete_image'])) // delete imaage
		{
		//	Logger::log_action(2, "admin" , "image file deleted", "{$blogEntry->image_title}");
			$target_path = /*SITE_ROOT.DS.'public'.DS.*/$blogEntry->image_path(); // but what if there is no image
			unlink($target_path);
			$blogEntry->image_title =""; // erase title
		}
		
		if($fileAttachHasntFailed)
		{
			$username = User::find_by_id($session->user_id)->username;
			if($blogEntry->save())
			{
				// Success
				//$session->message("Blog entry uploaded successfully.");
				if (!$edited)
				{Logger::log_action(1,"{$username}","posted", "{$blogEntry->id}");}
				else
				{Logger::log_action(2,"{$username}","edited", "{$blogEntry->id}");}
				redirect_to("index.php?ref=blogList&page=".$session->get_page());
			}
			else 
			{
				Logger::log_action(2,"{$username}","save failed", "{$blogEntry->id}");
			 	// Failure
			 	$message = join("<br/>", $blogEntry->errors);
				echo( "save failed. errors: ".$message);
			}
		}
	}
	

?>
