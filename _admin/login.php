<?php

require_once '../_includes/initialize.php';


if ($session->is_logged_in()) {redirect_to("index.php");}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit']))
{
	// form has been submitted.
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	
	// Check database to see if username/password exists.
	$found_user = User::authenticate($username, $password);
	
	if ($found_user)
	{
		$session->login($found_user);
		Logger::log_action(2,"Login", "{$found_user->username}","");
		redirect_to("index.php");
	}
	else 
	{
		// username/password combo was not found in the database
		$message = "Username/password combination incorrect";	
	}
}
else // form has not been submitted 
{	
	$username = "";
	$password = "";	
}

?>



<?php include_layout_template('new_header.php'); ?>

		
		<div id="main">
			<h2>Admin</h2>
			<?php if(isset($message))echo output_message($message); ?>
			
			<form action="login.php" method="post">
				<table>
					<tr>
						<td>Username:</td>
						<td>
							<input type="text"  name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
						</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td>
							<input type="password"  name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Login"/>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div id="footer">Copyright <?php echo date("Y", time()); ?>, Andrew Dunn</div>	
	</body>
</html>
<?php if(isset($db)){$db->close_connection();} ?>
