<?php

$folder=dir($fullPath);

$navArray = array();

while($thisItem = $folder->read()){

	$printThis = 1;
	
	$folderItem = $fullPath.$thisItem;
	
	if ($thisItem == "diplomas") $printThis =0;
	
	if ($thisItem == "erivera") $printThis =0;
    
    if ($thisItem == "thomaschapman") $printThis =0;
	
	if ($thisItem == "jubiwax") $printThis =0;
	
	if ($thisItem == "cgi") $printThis =0;
	
	if ($thisItem == "Documents") $printThis =0;
	
	if ($thisItem == "php_uploads") $printThis =0;
	
	if ($thisItem == "stats") $printThis =0;
	
	if ($thisItem == "amfphp") $printThis =0;
	
	if ($thisItem == "E-CAINESWORK") $printThis =0;
	
	if (is_dir($folderItem)) {
	
		$foundDot = (strpos($thisItem,".",0));
		
		if ($foundDot === 0) $printThis = 0;
		
		$result = (strpos($thisItem,"_",0));
		
		if ($result === 0) $printThis = 0;
		
			if ($printThis){
			
				$thisItemDisplay = str_replace ("-","/",$thisItem);
			
				$thisItemDisplay = str_replace ("_"," ",$thisItem);
				
				$thisItemDisplay = preg_replace("/[0-9]/","",$thisItemDisplay);
				
				$thisItemDisplay = ucfirst($thisItemDisplay);
				
				$navArray [$thisItemDisplay]=$thisItem;
			
		}
			
		
	}

}
asort($navArray);
print "<nav id=\"scrollingDiv\">";
print "<ul>";

/*
foreach ($navArray as $name=>$value) {
		
	print '<li><a href="'.$folderPath.$value.'">'.$name."</a></li>";		

}

print '<li><a href="'.$folderPath.'">'."Home</a></li>";
*/
print '<li><a href="http://www.andrewtdunn.com/_projects/">Projects</a></li>';
print '<li><a href="http://www.andrewtdunn.com/_newBlog/">Blog</a></li>';
print '<li><a href="http://www.andrewtdunn.com/_contact/">Contact</a></li>';
print '<li><a href="http://www.andrewtdunn.com/_art/">Art</a></li>';
print '<li><a href="http://www.andrewtdunn.com/_illustrate/">Illustrate</a></li>';
print '<li><a href="http://www.andrewtdunn.com/_friends/">Friends</a></li>';
print '<li><a href="http://www.andrewtdunn.com/_about/">About</a></li>';
if ($session->is_logged_in()) {print '<li><a href="http://www.andrewtdunn.com/_admin/">Admin</a></li>';}


print "</ul>";
print "</nav>";

$folder->close();


?>
