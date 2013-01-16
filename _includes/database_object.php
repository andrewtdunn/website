<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once LIB_PATH.DS.'database.php';

class DatabaseObject
{
	// note:  "static" and "get_called_class"
	//			are only in PHP 5.3
	//	http://www.php.net/lsb
	
	
	// Common Database Methods
	public static function find_all()
	{
		return static::find_by_sql("SELECT * FROM ".static::$table_name);
	}
	
	public static function find_by_id($id=0)
	{
		global $database;
		$result_array = static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id=".$database->escape_value($id)." LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_sql($sql="")
	{
		global $db;
		$result_set=$db->query($sql);
		$object_array=array();
		while($row = $db->fetch_array($result_set))
		{
			$object_array[]=static::instantiate($row);
		}
		return $object_array;
	}
	
	public static function count_all()
	{
		global $database;
		$sql = "SELECT COUNT(*) FROM ".static::$table_name;
		$result_set = $database->query($sql);
		$row = $database->fetch_array($result_set);
		return array_shift($row);	
	}
	
	private static function instantiate($record)
	{
		// Could check that $record exists an is an array
		// Simple, long form approach
		$class_name = get_called_class();
		$object = new $class_name;
		/*
		$object->id=$record['id'];
		$object->user_name=$record['username'];
		$object->password=$record['password'];
		$object->first_name=$record['first_name'];
		$object->last_name=$record['last_name']; 
		*/
		
		// More dynamic, short-form approach
		foreach($record as $attribute=>$value)
		{
			if ($object->has_attribute($attribute))
			{
				$object->$attribute = $value;
			}
		}
		return $object;
	}
	
	private function has_attribute($attribute)
	{
		// get_object_vars returns an associative array with all attributes
		// (incl. private ones!) as the keys and their current values as the value
		// see php.net for workaround to exclude private vars
		$object_vars = get_object_vars($this);
		// We don't care about the value, we just want to know if the key exists 
		// Will return true or false value
		return array_key_exists($attribute, $object_vars);
	}
	
	
	
	protected function attributes()
	{
		// return an array of attribute keys and their values
		$attributes = array();
		foreach(static::$db_fields as $field)
		{
			if(property_exists($this, $field))
			{
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	
	protected function sanitized_attributes()
	{
		global $database;
		$clean_attributes = array();
		// sanitize attributes before submitting
		// Note: does not alter the actual value of each attribute
		foreach($this->attributes() as $key=>$value)
		{
			$clean_attributes[$key] = $database->escape_value($value);
		}
		return $clean_attributes;
	}
	
	
	
	protected function create()
	{
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('values', 'values')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".static::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .=") values ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "') ";
		if($database->query($sql))
		{
			$this->id = $database->insert_id();
			return true;
		}
		else 
		{
			return false;		
		}
		
	}
	
	public function save()
	{
		// A new record won't have an id yet
		return isset($this->id) ? static::update() : static::create();
	}
	
	protected function update()
	{
		global $database;

		// Don't forget your SQL syntax and good habits:
		// - UPDATE table SET key='value', key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key=>$value)
		{
			$attribute_pairs[] = "{$key}='{$value}'";
		}
		
		$sql = "UPDATE ".static::$table_name." SET ";
		$sql .= join (", ", $attribute_pairs);
		$sql .= " WHERE id=".$database->escape_value($this->id);
		$database->query($sql);
		return ($database->affected_rows() == 1)? true : false;
		
		
	}
	
	public function delete()
	{
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQL injection
		// - use LIMIT 1
		
		$sql = "DELETE FROM ".static::$table_name." ";
		$sql .= "WHERE id=". $database->escape_value($this->id);
		$sql .=" LIMIT 1";
		$database->query($sql);
		return ($database->affected_rows() == 1)?true : false;
		// NB: After deleting, the instance of User still
		// exists, even though the database entry does not.
		// This can be useful as in:
		// echo $user->first_name . " was deleted.";
	}
}

?>
