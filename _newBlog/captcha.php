<?php

session_start();

// create a random string with md5
$md5 = md5(microtime() * mktime());

//
$string = substr($md5,0,5);

//create image for captcha background
$captcha = imagecreatefrompng("captcha.png");

// rgb color codes - line is powder blue
$black = imagecolorallocate($captcha, 0, 0, 0);
$line = imagecolorallocate($captcha,233,239,239);

// add lines to image to make harder for bots to break
imageline($captcha,0,0,39,29,$line);
imageline($captcha,40,0,64,29,$line);

//write random string to the image
imagestring($captcha,5,15,5,$string,$black);

// Encrypt and store the key inside of a session
$_SESSION['key'] = md5($string);



//header("Content-type: image/jpg");
//imagejpeg($captcha);
header("Content-type: image/png");
imagepng($captcha);


?>