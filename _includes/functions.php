<?php

function showdate($dated) // for straight timestamp 14
{
$hour = substr($dated,8,2);
$minute = substr($dated,10,2);
$second = substr($dated,12,2);
$month = substr($dated,4,2);
$day = substr($dated,6,2);
$year = substr($dated,0,4);
$mktime = mktime($hour, $minute, $second, $month, $day, $year);
$formatted = date("F j, Y g:i a",$mktime);
return $formatted;
} 

function showdate_II($dated)// for the DATETIME format
{
$hour = substr($dated,11,2);
$minute = substr($dated,14,2);
$second = substr($dated,17,2);
$month = substr($dated,5,2);
$day = substr($dated,8,2);
$year = substr($dated,0,4);
$mktime = mktime($hour, $minute, $second, $month, $day, $year);
$formatted = date("F j, Y g:i a",$mktime);
return $formatted;
} 

function strip_zeroes_from_date($marked_string="" )
{
	// remove marked zeroes
	$no_zeroes = str_replace('*0', '', $marked_string);
	// remove any remaining marks
	$cleaned_string = str_replace('*', '', $no_zeroes);
	return $cleaned_string;
};

function redirect_to($location=NULL)
{
	if ($location != NULL)
	{
		header("Location: {$location}");
		exit;
	}
}

function output_message($message="")
{
	if (!empty($message))
	{
		return "<p class=\"message\">{$message}</p>";
	}
	else {
		return"";
	}
}

function __autoload($class_name)
{
	$class_name = strtolower($class_name);
	$path = "LIBPATH.DS.{$class_name}.php";
	if (file_exists($path))
	{
		require_once($path);
	}
	else 
	{
		die ("The file {$class_name}.php could not be found.");	
	}
}

function include_layout_template($template="")
{
	global $session;
	include(SITE_ROOT.DS.'_layouts'.DS.$template);
}

function datetime_to_text($datetime)
{
	$unixdatetime = strtotime($datetime);
	return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}
 
function print_pagination($pagination, $page, $link)
{

	echo '<div id="pagination">';
	
	if ($page != 1)
	{
		echo "<a href=\"".$link."page=1\">  &laquo </a>";
	}
	else
	{
		echo "<span class=\"dead\">  &laquo </span> ";	
	}
	
		
	if ($pagination -> has_previous_page()) {
		echo "  <a href=\"".$link."page=";
		echo $pagination->previous_page();
		echo "\"> < </a> ";
	}
	else
	{
		echo "<span class=\"dead\"> < </span>";
	}
	

	if ($page <= 3)
	{
		for ($i = 1; $i<=5; $i++)
		{
			if ($i == $page)
			{
				echo "<span class=\"selected\"> {$i} </span>";
			}
			else 
			{
				echo "<a href=\"".$link."page={$i}\"> {$i} </a>";
			} 
			
		}
	}
	else if ($page + 3 >= $pagination->total_pages()) 
	{
		$minPage = $pagination->total_pages() -5;
		for ($i = $minPage; $i <= $pagination->total_pages(); $i++)
		{
			if ($i == $page)
			{
				echo "<span class=\"selected\"> {$i} </span>";
			}
			else 
			{
				echo "<a href=\"".$link."page={$i}\"> {$i} </a>";
			}
			
		}
	}
	else 
	{
		$minPage = $page - 2 ;
		$maxPage = $page + 2;
		for ($i = $minPage; $i <= $maxPage; $i++)
		{
			if ($i == $page)
			{
				echo "<span class=\"selected\"> {$i} </span>";
			} 
			else 
			{
				echo "<a href=\"".$link."page={$i}\"> {$i} </a>";
			}
		}
	}

	if ($pagination -> has_next_page()) 
	{
		echo "<a href= \"".$link."page=";
		echo $pagination->next_page();
		echo "\"> > </a>";
	}
	else
	{
		echo "<span class=\"dead\"> > </span>";
	}
	
	if ($page != $pagination->total_pages())
	{
		echo "  <a href=\"".$link."page=".$pagination->total_pages()."\"> &raquo;  </a>";
	}
	else 
	{
		echo " <span class=\"dead\"> &raquo;  </span>";	
	}
	echo '</div>'; //pagination
}

function first_sentence($content) 
{
    if (strripos($content, "youtube"))
    {
        $hasEmbed = strripos($content, ">");
        $pos = strpos($content, '.');            
        return substr($content, $hasEmbed +1, $pos+1); 
    }
	if(strpos($content, '.')==0)
	{return $content;}	
    return substr($content, 0, strpos($content, '.')+1);    
}

function curPageURL() {
 $pageURL = 'http';
 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function printDate($date)
{
	$rooster = 5;
	$endOfMorning = 11;
	$dusk = 18; 
	$now = time() + 7200;
	$yesterday = strtotime("-1 day") + 7200;
	$entryTime= strtotime($date) + 7200;
	if (date('Ymd', $now ) == date('Ymd',$entryTime))
	// same day 
	{
		// tonight - early morning
		if( 
		intval(date('H',$entryTime)) <= $rooster
		&&
		intval(date('H',$now)) <= $rooster
		)
		{
			echo "tonight at ";
		}
		// last night - day
		else if 
		( 
		intval(date('H',$entryTime)) <= $rooster
		&&
		intval(date('H',$now)) > $rooster
		&&
		intval(date('H',$now)) <= $dusk
		)
		{
			echo "last night at ";
		}
		// this morning - day
		else if 
		( 
		intval(date('H',$entryTime)) > $rooster
		&&
		intval(date('H',$entryTime)) <= $endOfMorning
		&&
		intval(date('H',$now)) > $rooster
		)
		{
			echo "this morning at ";
		}
		// tonight - nighttime
		else if 
		( 
		intval(date('H',$entryTime)) >= $dusk 
		&&
		intval(date('H',$now)) >= $dusk
		)
		{
			echo "tonight at ";
		}
		else // today - today
		{
			echo "today at ";
		}
		
		
		
		 echo date("g:i a", $entryTime);
	}
	else if (date('Ymd', $yesterday ) == date('Ymd',$entryTime))
	{
		if(intval(date('H',$entryTime)) > $dusk)
		{
			if (intval(date('H',$now)) < $rooster	)
			{
				echo "tonight at "; echo date("g:i a", $entryTime);
			}
			else {
				echo "last night at "; echo date("g:i a", $entryTime);
			}
		}
		else {
			echo "yesterday at "; echo date("g:i a", $entryTime);
		}
		
	}
	else 
	{
		echo ($entryTime > strtotime("-6 day"))?date("l \a\\t g:i a", $entryTime):date("l F j, Y", $entryTime);
	}
	
}





?>