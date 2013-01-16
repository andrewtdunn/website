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
		$text;
		if(isset($_POST['modify_id']))
		{
			$edited = true;	
			$text = Text::find_by_id($_POST['modify_id']);
			Logger::log_action(2, "admin" , "modifying", "{$text->title}");
		}
		else {
			$text = new Text();
		}
		if(isset($_POST['text_page_id']))$text->page_id = $_POST['text_page_id'];
		if(isset($_POST['text_title']))$text->title = $_POST['text_title'];
		if(isset($_POST['text_entry']))$text->text = $_POST['text_entry'];
		
		
		$fileAttachHasntFailed = true;
		
		if($_FILES['text_image']['name'] != "" && $_FILES['text_image']['name'] != $text->image_title )
		{
			// updating
			$newImageName = $_FILES['text_image']['name'];
			Logger::log_action(2, "admin" , "image name found", "{$newImageName}");
			if($text->attach_file($_FILES['text_image']))
			{
				//if old entry found, delete it
				if ($text->image_title != "")
				{
					Logger::log_action(2, "admin" , "image file deleted", "{$_POST['image_title']}");
					$target_path = $text->image_path(); // but what if there is no image
					unlink($target_path);
					$text->image_title =""; // erase title
				}
				// creating new entry
				$text->image_title = $text->filename;	
				Logger::log_action(2, "admin" , "file attached", "{$newImageName}");
			}
			else
			{
				Logger::log_action(2, "admin" , "file attached failed", "{$newImageName}");
				echo $text->errors();	
				$fileAttachHasntFailed = false;	
			}
		}
		else if($text->image_title !="" && $_FILES['text_image']['name'] == "") // no update
		{
		//	echo "updated - old filename is ".$text->image_title;
			Logger::log_action(2, "admin" , "old title: {$text->image_title}", "no new title found");
		}
		if(isset($_POST['delete_image'])) // delete imaage
		{
			Logger::log_action(2, "admin" , "image file deleted", "{$text->image_title}");
			$target_path = /*SITE_ROOT.DS.'public'.DS.*/$text->image_path(); // but what if there is no image
			unlink($target_path);
			$text->image_title =""; // erase title
		}
		
		if($fileAttachHasntFailed)
		{
			$username = User::find_by_id($session->user_id)->username;
			if($text->save())
			{
				// Success
				//$session->message("text entry uploaded successfully.");
				if (!$edited)
				{Logger::log_action(1,"{$username}","posted", "{$text->id}");}
				else
				{Logger::log_action(1,"{$username}","edited", "{$text->id}");}
				redirect_to("index.php?ref=textList&page=".$session->get_page());
			}
			else 
			{
				Logger::log_action(2,"{$username}","save failed", "{$text->id}");
			 	// Failure
			 	$message = join("<br/>", $text->errors);
				echo( "save failed. errors: ".$message);
			}
		}
	}
	

?>
