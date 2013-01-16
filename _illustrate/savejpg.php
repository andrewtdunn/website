<?php

include "../_includes/config.inc.php";
include $fullPath."_includes/db_connect.inc.php";


if (isset($GLOBALS["HTTP_RAW_POST_DATA"]))
{
	$jpg = $GLOBALS["HTTP_RAW_POST_DATA"];
	$img = addslashes ($_GET['img']);
	$name = addslashes ($_GET['artist']);
	$id =(!preg_match('/^[0-9]+$/', $_GET['id']) ? 0 : $_GET['id'] );

	
	
	$query = "INSERT INTO reflinks SET topic_name='".$name."'," ;
	$query .= " image_title='".$img."', entrytime=NOW(),ref_categories_id='3',childid='".$id."', isIllustration = '1'";
	$result  = mysql_query($query) or die ("Unable to connect to database");
	
	header("Content-Type: image/jpeg");
	// mysql - add img to table
	
	
	$fp = fopen('../_illustrations/'.$img, 'wb' );
	fwrite( $fp, $GLOBALS[ 'HTTP_RAW_POST_DATA' ] );
	fclose( $fp );
	
	echo $jpg;
	
		
	
	//header("Content-Disposition:attachment; filename=".$img);
	
}
else
{
	echo"Encoded JPEG information not received";
}




?>