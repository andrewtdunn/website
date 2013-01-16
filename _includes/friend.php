<?php
// If it's going to need the database, then it's
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class Friend extends DatabaseObject
{
	protected static $table_name="blog_entries";
	protected static $db_fields=array('id','title','image_title','entrytime');

	public $id;
	public $title;
	public $image_title;
	public $entrytime;
	
	private $temp_path;
	protected $upload_dir="/home/content/a/n/d/andrewtdunn28/html/_images/blog_images";
	public $errors=array();
	
	private $fileAttached = false;

	protected $upload_errors = array(
	// http://www.php.net/manual/en/features.file-upload.errors.php
	// associative array
	UPLOAD_ERR_OK 			=> "no errors.",
	UPLOAD_ERR_INI_SIZE 	=> "Larger than upload_max_filesize.",
	UPLOAD_ERR_FORM_SIZE	=> "Larger than form MAX_FILE_SIZE.",
	UPLOAD_ERR_PARTIAL		=> "Partial upload.",
	UPLOAD_ERR_NO_FILE		=> "No file.",
	UPLOAD_ERR_NO_TMP_DIR	=> "No Temporary directory.",
	UPLOAD_ERR_CANT_WRITE	=> "Can't write to disk.",
	UPLOAD_ERR_EXTENSION	=> "File upload stopped by extension"
	);
	
	
		
	/**
	 * Instantiate photo and save photo, give photo this particular id
	 * call photographs() during constructor?
	 * 
	 */
	// overwrites super class save()
	
	
	public function image_path()
	{
		return $this->upload_dir.DS.$this->image_title;
	}
	
	public function size_as_text()
	{
		if ($this->size < 1024)
		{
			return "{$this->size} bytes";
		}
		elseif($this->size < 1048576)
		{
			$size_kb = round($this->size/1024);
			return "{$size_kb} KB";
		}
		else {
			$size_mb = round($this->size/1048756, 1);
			return "{$size_mb} MB";
		}
	}
	
	public function destroy()
	{
		// First remove the database entry
		if ($this->delete())
		{
			// then remove the file
			// Note that even though the database entry is gone, this object
			// is still around (which lets us use $this->image_path())
			if (isset($this->image_title) && $this->image_title != "")
			{
				$target_path = /*SITE_ROOT.DS.'public'.DS.*/$this->image_path(); // but what if there is no image
																				 // attached to the post?
				return unlink($target_path) ? true : false;
			}
			else {
				return true;
			}
		}
		else {
			// database delete failed
			return false;
		}
		// then remove the file
	}
	
	public function comments()
	{
		return Comment::find_comment_on($this->id);
	}
	
	public function photographs()
	{
		// get photos with blog for $this->id
	}
	
	// Pass in $_FILE(['uploaded_file']) as an argument
	public function attach_file($file)
	{
		// Perform error checking on the form parameters
		if (!$file || empty($file) || !is_array($file))
		{
			// error: nothing uploaded or wrong argument used
			$this->errors[] = "No file was uploaded";
			return false;
		}
		elseif ($file['error'] != 0)
		{
			// error: report what PHP says went wrong
			$this->errors[] = $this->upload_errors[$file['error']];
			return false;
		}
		else 
		{
			// Set object attributes to the form parameters.
			$this->temp_path 	= $file['tmp_name'];
			$this->filename		= basename($file['name']);
			$this->type 		= $file['type'];
			$this->size 		= $file['size'];
			// Don't worry about saving anything to the database yet. 
			$this->fileAttached = true;
			return true;
		}
	}
	
	// overwrites super class save()
	public function save()
	{
		// first, if necessary, upload photo
		if($this->fileAttached)
		{
			// Determine the target_path
			$target_path = /*SITE_ROOT.DS.*/$this->upload_dir.DS.$this->filename;
			$this->image_title = $this->filename;
				
			// Make sure a file doesn't already exist in the target location
			if (file_exists($target_path))
			{
				$this->errors[] = "The file {$this->filename} already exists.";
				return false;
			}
			
			// Attempt to move the file
			if (move_uploaded_file($this->temp_path, $target_path))
			{
				//return true;
				// Success
				// Save a corresponding entry to the database
				/*
				//$this->entrytime = now();
				if ($this->create())
				{
					// We are done with the temp path, the file isn't there anymore
					unset($this->temp_path);
					return true;
				}
				else 
				{
					// File was not moved.
					$this->errors[]="The file upload failed, possibly due to incorrect permissions on the upload folder.";
					return false;
				}
				 * 
				 */
			}
			else 
			{
				echo'no upload<br/>';
				$this->errors[]="The file upload failed, possibly due to incorrect permissions on the upload folder.";
				return false;
			}
			
		}
		
		
		// A new record won't have an id yet.
		if (isset($this->id))
		{
			{Logger::log_action(2,"admin","updating", "{$this->id}");}
			//echo "updating ".$this->image_title; 
			// Really just to update the caption
			
			//echo ("updating<br/> id: ".$this->id."<br/> img: ".$this->image_title."<br/> title: ".nl2br($this->title)."<br/> "."<br/> text".$this->text."<br/> ");
			return $this->update();
		}
		else // new entry
		{
			// Make sure the caption is not too long for the DB
			if (strlen($this->title) >= 255)
			{
				$this->errors[] = "The title can only be 255 characters long.";
				return false;
			}
			
			// Make sure there are no errors 
			// Can't save if there are pre-existing errors
			if (!empty($this->errors)) {return false;}
			 
			$this->entrytime = date("Y-m-d H:i:s");
			// echo ("creating<br/> id: ".$this->id."<br/> img: ".$this->image_title."<br/> title: ".$this->title."<br/> text: ".nl2br($this->text)."<br/> ");
			// Save a corresponding entry to the database
			return $this->create();
		}
	}
}