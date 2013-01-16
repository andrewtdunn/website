<?php require_once '../_includes/initialize.php'; ?>
<?php require_once '../_includes/validationFunctions.php'; ?>
<?php
if (isset($_POST['submitted'])) 
{
	$first_name = ($_POST['first_name']);
	
	$last_name = ($_POST['last_name']);
	
	$email = ($_POST['email']);
	
	$msg = ($_POST['message']);
	
	$destination_email = "atd2005@gmail.com";
	
	$email_subject = "Email from Contact Form";
	
	$from = "{$first_name} {$last_name}:";
	$email_body = "$from\n$msg\n$email";
	
	if ( get_magic_quotes_gpc() )
	{
		//Print "magic quotes is on!";
		
		$first_name = stripslashes($first_name);
		
		$last_name = stripslashes($last_name);
		
		$email = stripslashes($email);
		
		$msg = stripslashes($msg);
	
	}
	
	$error_msg=array();
	
	if ($first_name=="")
	{
		$error_msg[]  = "Please enter your first name";
	}	
	
	if ($last_name=="")
	{
		$error_msg[]  = "Please enter your last name";
	}	
	
	if ($email=="")
	{
		$error_msg[]  = "Please enter your email";
	}	
	
	if ($msg=="")
	{
		$error_msg[]  = "Don't forget to write your message!";
	}	
	
	// verify first name
	$valid = verifyAlphaNum($first_name);
	
	if(!$valid)
	{
	
		$error_msg[]="First name must be letter and numbers, spaces, dashes and ' only.";
	
	}
	
	// verify last name
	$valid = verifyAlphaNum($last_name);
	
	if(!$valid)
	{
	
		$error_msg[]="Last name must be letter and numbers, spaces, dashes and ' only.";
	
	}
	
	// verify email
	$valid = verifyEmail($email);
	
	if(!$valid)
	{
	
		$error_msg[]="Email must be a valid format (e.g. yourname@youremail.com).";
	
	}
	
	// verify email
	$valid = verifyText($msg);
	
	if(!$valid)
	{
	
		$error_msg[]="Message can only contain letters, numbers and basic puncutation \" ' ? ! ";
	
	}
	
	
	if(md5($_POST['captchaText']) != $_SESSION['key'])
	{
	  	$error_msg[] = "Please enter the code correctly!";
	}
	
	// if no errors send email and redirect
	if (!$error_msg)
	{
		mail($destination_email, $email_subject, $email_body);
		
		header('Location: emailConfirmation.php');
		
		exit();
		
	}

}
?><?php 

$pageName = "Contact";
$text = Page::getTextForPage($pageName);
$session->pageTitle="Andrew T. Dunn | ".$pageName;

include_layout_template('new_header.php'); ?>
<script type="text/javascript" src="../_scripts/jquery-embedagram.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
       $("#scrollingDiv2").remove();
       $('#slideshow').embedagram({
			instagram_id: 41597549,
			thumb_width: 75,
			limit: 18
        });
      
  	});
  	
  	 $(window).scroll(function() 
  	 {
		if ($(this).scrollTop() > 208) 
		{ //I just used 200 for testing
	        $("#scrollingDiv").css({ "position": "fixed", "top": 0 });
	    } 
	    else 
	    {
	        $("#scrollingDiv").css({ "position": "absolute", "top": "208" }); //same here
	  	}
	  });  
	    
</script>
<section class="col1"><?php require_once SITE_ROOT.DS.'_includes/navigation.php'; ?></section>
<section class="col2">
<?php require_once SITE_ROOT.DS.'_includes/iNav.php'; ?>
<h2><?php echo $text->title; ?></h2>
<div align="center">
</div>
<section id="contact"/>


	<form id="contactForm" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
		
        <br/>
    <?php
	
	if (isset($error_msg))
	{
		
		echo "<ul>\n";
		
			foreach($error_msg as $err)
			{
			
				echo"<div id=\"fixMsgs\" class=\"error\"><li>".$err."</li></div>\n";
			
			}
		
		echo "</ul>\n";
	}    
	
    ?>
    	<input class="entryComment" id="firstnameInput" name="first_name" type="text" size="20" id="first_name" placeholder="first name" value="<?php if (isset($first_name))echo $first_name?>"/>
    	<input class="entryComment" name="last_name" id="lastName" type="text" size="20" id="last_name" placeholder="last name" value="<?php if (isset($last_name))echo $last_name?>"/>
    	<br/>
    	<input class="entryComment" name="email" type="text" size="20" id="email" placeholder="email" value="<?php if (isset($email))echo $email?>" autocapitalize="off" autocorrect="off">
    	<textarea name="message" Placeholder="questions, comments, concerns ..." rows="10"><?php if (isset($msg))echo $msg; ?></textarea><br/>
    	<div id="captcha">
			<p>
		   		<label for="captchaText">Prove you are human:</label>
		   		<input name="captchaText" type="text" size="5" id="captchaText" value=""/>
		   		<img alt="captcha" src="captcha.php">
		   	<p/>
		</div>
    	<input type="hidden" name="submitted" value="1"/>
    	<input class="submitButton" type="submit" value="Send Message"/>
    </form>

	<p class="supportText"><?php echo $text->text; ?></p>

	</section>
</section>
<?php include_layout_template('aside2.php'); ?>
<?php include_layout_template('new_footer.php'); ?>

