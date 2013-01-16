<?php
require_once 'initialize.php';

class Logger
{
	public static $INFO = 1;
	public static $DEBUG = 2;

	public static function log_action($level, $actor, $action, $dirObj)
	{
		$log_file = SITE_ROOT.DS.'_logs'.DS.'log.txt'; 
		$new = file_exists($log_file) ? false : true;
		if ($handle = fopen ($log_file, 'a')) // append
		{
			$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
			$content = "{$level}|{$timestamp}|{$actor}|{$action}|{$dirObj}\n";
			fwrite($handle,$content);
			fclose($handle);
			if ($new)
			{
				chmod($log_file, 0755);
			}
		}
		else 
		{
			echo "Could not open log file for writing";	
		}
	}
	
	public static function print_log()
	{
		$log_file = SITE_ROOT.DS.'_logs'.DS.'log.txt'; 
		if (file_exists($log_file) && is_readable($log_file)
		&& /*$handle=fopen($log_file, 'r')*/$file = file($log_file ))
		{
			echo "<ul class=\"log-entries\">";
			$file = array_reverse($file);
			$maxListings=5;
			$numListings=0;
			foreach($file as $entry){
    		//	echo $f."<br />";
    			$msgArray = explode("|",trim($entry));
				if ($msgArray[0] == static::$INFO)
				{
					if(!isset($msgArray[4]) || $msgArray[4]=="") break;
					if ($blogEntry = BlogEntry::find_by_id($msgArray[4]))
					{
						$blogEntryTitle = $blogEntry->title; 
						if ($blogEntryTitle == "") $blogEntryTitle = "untitled";
						echo "<li><p>{$msgArray[2]} {$msgArray[3]} <a class=\"logLink\" href=\"http://www.andrewtdunn.com/_newBlog/entry.php?id={$msgArray[4]}\">{$blogEntryTitle}</a>.</p><span class=\"commentTime\">";printDate($msgArray[1]);echo"</span></li>";
						$numListings++;
					}
				}
				if ($numListings == $maxListings){ break;}
			}
			/*
			while (!feof($handle))
			{
				$entry = fgets($handle); // get each line
				if (trim($entry) != "")
				{
					echo "<li>{$entry}</li>";
				}
			}
			 * 
			 */
			echo "</ul>";
		}
		else 
		{
			echo "Could not read from {$logfile}";
		}
	}
	
	public static function clear_log($user_id)
	{
		$log_file = SITE_ROOT.DS.'_logs'.DS.'log.txt'; 
		file_put_contents($log_file, '');
		Logger::log_action(2,"{$user_id}","cleared log","");
		// Add the first log action
		redirect_to('logfile.php');
	}
	
}



?>