<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start. 
require_once(LIB_PATH.DS.'database.php');

class Comment extends DatabaseObject
{
	protected static $table_name = "comments";
	protected static $db_fields = array ('id', 'blog_id', 'created', 'author', 'body');
	
	public $id;
	public $blog_id;
	public $created;
	public $author;
	public $body;
	
	// factory method
	// "new" is a reserved word so we use "make" (or "build")
	public static function make($blog_id, $author="Anonymous", $body="")
	{
		if (!empty($blog_id) && !empty($author) && !empty($body)) 
		{
			$comment = new Comment();
			$comment->blog_id = (int)$blog_id;
			$comment->created = strftime("%Y-%m-%d %H:%M:%S", time());
			$comment->author = $author;
			$comment->body = $body;
			return $comment;
		}
		else
		{
			return false;
		}
	}	
	
	public static function find_comment_on($blog_id=0)
	{
		global $database;
		$sql = " SELECT * FROM ".static::$table_name;
		$sql .= " WHERE blog_id=".$database->escape_value($blog_id);
		$sql .= " ORDER BY created ASC";
		return static::find_by_sql($sql);
	}
}
?>