<?php

require_once '../includes/initialize.php';

$sql = "SELECT * FROM reflinks WHERE ref_categories_id=3 AND isBlogOnly=1 ORDER BY entrytime";
global $db;
$result_set=$db->query($sql);
$object_array=array();
$blog;
/*
while($row = $db->fetch_array($result_set))
{
	
	$blog = new BlogEntry();
	$blog->title = $row['topic_name'];
	$blog->text = $row['topic_desc'];
	$blog->image_title = $row['image_title'];
	$blog->entrytime = $row['entrytime'];
	$blog->save();
}
*/

// this worked! hopefully no neeed to use it again
?>