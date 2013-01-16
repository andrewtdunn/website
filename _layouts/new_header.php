<html>
	<head>
		<title>
			
			<?
if (isset($session->pageTitle)){

	print $session->pageTitle;
    
 } else {

 	print "Andrew T. Dunn | Interactive";
}
?></title>
			<meta name = "viewport" content = "user-scalable=no, width=device-width">
			<meta name="apple-mobile-web-app-capable" content="yes"/>
			<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />   
			<link href="../_css/daytime.css" media="all" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="../_scripts/jquery-1.7.2.min.js"></script>
			<script type="text/javascript" src="../_scripts/jquery.easing.1.3.js"></script>
			<script type="text/javascript" src="../_scripts/jquery.color.js"></script>
			<script type="text/javascript" src="../_scripts/jquery.hoverintent.minified.js"></script>
			<script type="text/javascript" src="../_scripts/nav.js"></script>
			<script type="text/javascript" src="../_scripts/link.js"></script>
			<script src="../_scripts/swfobject.js" type="text/javascript"></script>
			<link rel="icon" type="image/png" href="../_siteImages/pandaHead.png" />
			<LINK REL="apple-touch-icon" HREF="../_siteImages/marqueePanda2.png" />
			<link rel="apple-touch-startup-image" href="../_siteImages/2panda.png">
				
<?



// if blog page add fb meta data
if (isset($session->pageTitle) && $session->pageTitle == "Andrew T. Dunn | Blog")
{
	
	
	
	if (isset($session->ogTitle) && $session->ogTitle!="")
	{print'<meta property="og:title" content="'.$session->ogTitle.'"/>'."\n";}
	else
	{print'<meta property="og:title" content="tous les jours"/>'."\n";}
    
    
   
    print'<meta property="og:url" content="'.curPageURL().'"/>'."\n";
    
    
    
	print'<meta property="og:site_name" content="andrewtdunn.com"/>'."\n";
	if (isset($session->ogImg)) print'<meta property="og:image" content="'.$session->ogImg.'"/>'."\n";
	if (isset($session->ogDesc))print'<meta property="og:description" content="'.$session->ogDesc.'.."/>'."\n";
    /*
    print'<meta property="og:type" content="blog" />'."\n";
    print'<meta property="fb:admins" content="567255076" />'."\n";
    */
}
unset($session->pageTitle);
unset($session->ogTitle);
unset($session->ogImg);
unset($session->ogDesc);
?>
		
	</head>
	<body>
		<header>
			
		</header>
		