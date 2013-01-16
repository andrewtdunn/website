<?php

// enable error reporting
ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ALL);


// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY SEPARATOR is a PHP pre-defined constant

defined('DS')?null:define('DS',DIRECTORY_SEPARATOR);
// /home/content/a/n/d/andrewtdunn28/html//
defined('SITE_ROOT') ? null : define('SITE_ROOT',DS.'home'.DS.'content'.DS.'a'.DS.'n'.DS.'d'.DS.'andrewtdunn28'.DS.'html'); //deploy
//defined('SITE_ROOT') ? null : define('SITE_ROOT',DS.'Applications'.DS.'MAMP'.DS.'htdocs'.DS.'andrewtdunn'); // local
defined('LIB_PATH') ? null : define ('LIB_PATH', SITE_ROOT.DS.'_includes'); //deploy
defined('LOG_FILE') ? null : define ('LOG_FILE', SITE_ROOT.DS.'_logs'.DS.'logfile.php');


// load config file first
require_once(LIB_PATH.DS.'config.php');

// load basic functions next so that everything after can use them
require_once (LIB_PATH.DS.'functions.php');

// load core objects
require_once (LIB_PATH.DS.'session.php');
require_once (LIB_PATH.DS.'database.php');
require_once (LIB_PATH.DS.'database_object.php');
require_once (LIB_PATH.DS.'pagination.php');

// load database-related classes
require_once (LIB_PATH.DS.'user.php');
require_once(LIB_PATH.DS.'logger.php');
require_once(LIB_PATH.DS.'photograph.php');
require_once(LIB_PATH.DS.'comment.php');
require_once(LIB_PATH.DS.'blogentry.php');
require_once(LIB_PATH.DS.'project.php');
require_once(LIB_PATH.DS.'text.php');
require_once(LIB_PATH.DS.'page.php');
//require_once(LIB_PATH.DS.'friend.php');
require_once(LIB_PATH.DS.'todo.php');
?>