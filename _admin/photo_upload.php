<?php

require_once('../../includes/initialize.php');

//$session->logout();
if (!$session->is_logged_in()) {redirect_to("login.php");}
?>
<?php
	
	$message = "";
	if (isset($_POST['submit']))
	{
		$photo = new Photograph();
		$photo->caption = $_POST['caption'];
		$photo->attach_file($_FILES['file_upload']);
		if($photo->save())
		{
			// Success
			$session->message("Photograph uploaded successfully.");
			redirect_to("display_photos.php");
		}
		else 
		{
		 	// Failure
		 	$message = join("<br/>", $photo->errors);
		}
	}
	

?>
<?php include_layout_template('admin_header.php'); ?>
	
	<h2>Photo Upload</h2>
	<?php echo output_message($message); ?>
	<form action="photo_upload.php" enctype="multipart/form-data" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo Photograph::$max_file_size; ?>" />
		<input type="file" name="file_upload" />
		<p>Caption: <input type="text" name="caption" value="" /></p>
		<input type="submit" name="submit" value="Upload"/>
	</form>
	
<?php include_layout_template('admin_footer.php'); ?>