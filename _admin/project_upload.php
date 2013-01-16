<?php

require_once('../_includes/initialize.php');

//$session->logout();
//if (!$session->is_logged_in()) {redirect_to("login.php");}
?>
<?php
	//echo "session id is ".$session->get_page()."<br/>";
	$message = "";
	if (isset($_POST['submit']))
	{
		$edited;
		$project;
		if(isset($_POST['modify_id']))
		{
			$edited = true;	
			$project = Project::find_by_id($_POST['modify_id']);
		}
		else 
		{
			$project = new Project();
		}
		if(isset($_POST['project_title']))$project->title = $_POST['project_title'];
		if(isset($_POST['project_entry']))$project->text = $_POST['project_entry'];
		if(isset($_POST['vimeoID']))$project->vimeoID = $_POST['vimeoID'];
		if(isset($_POST['overlay_text']))$project->overlay_text = $_POST['overlay_text'];
		
		$fileAttachHasntFailed = true;
		
		if($_FILES['project_image']['name'] != "")
		if($_FILES['project_image']['name'] != "" && $_FILES['project_image']['name'] != $project->image_title )
		{	
			
			$newImageName = $_FILES['project_image']['name'];
			Logger::log_action(2, "admin" , "project image name found", "{$newImageName}");
			if($project->attach_file($_FILES['project_image']))
			{
				//if old entry found, delete it
				if ($project->image_title != "")
				{
					Logger::log_action(2, "admin" , "project image file deleted", "{$_POST['image_title']}");
					$target_path = $project->image_path(); // but what if there is no image
					unlink($target_path);
					$project->image_title =""; // erase title
				}
				// creating new entry
				$project->image_title = $project->filename;	
				Logger::log_action(2, "admin" , "file attached", "{$newImageName}");
			}
			else
			{
				Logger::log_action(2, "admin" , "file attached failed", "{$newImageName}");
				echo $project->errors();	
				$fileAttachHasntFailed = false;	
			}
		}
		else if($project->image_title !="" && $_FILES['project_image']['name'] == "") 
		{
			Logger::log_action(2, "admin" , "old title: {$project->image_title}", "no new title found");
		}
		if(isset($_POST['delete_image']))
		{
			
			
			Logger::log_action(2, "admin" , "image file deleted", "{$project->image_title}");
			$target_path = /*SITE_ROOT.DS.'public'.DS.*/$project->image_path(); // but what if there is no image
			unlink($target_path);
			$project->image_title =""; // erase title
		}
		
		if($fileAttachHasntFailed)
		{
			$username = User::find_by_id($session->user_id)->username;
			if($project->save())
			{
				// Success
				$session->message("project entry uploaded successfully.");
				if (!$edited)
				{Logger::log_action(1,"{$username}","posted a new project", "{$project->id}");}
				else
				{Logger::log_action(1,"{$username}","edited a project", "{$project->id}");}
				redirect_to("index.php?ref=projectList&page=".$session->get_page());
			}
			else 
			{
				Logger::log_action(2,"{$username}","save failed", "{$project->id}");
			 	// Failure
			 	$message = join("<br/>", $project->errors);
				echo( "failed. errors: ".$message);
			}
		}
	}
	

?>
