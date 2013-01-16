<?php
// If it's going to need the database, then it's
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class Page extends DatabaseObject
{
	protected static $table_name="pages";
	protected static $db_fields=array('id','page_name');

	public $id;
	public $page_name;
	
	
	public static function getTextForPage($pageName)
	{
		$pageSql = "SELECT * FROM pages WHERE page_name='".$pageName."' LIMIT 1";
		$pages= Page::find_by_sql($pageSql);
		$textSql = "SELECT * FROM text WHERE page_id=".$pages[0]->id." LIMIT 1";
		$texts = Text::find_by_sql($textSql);
		$text = $texts[0];
		return $text;
	}
	
	
}