<?php
require_once ('../_includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {redirect_to("login.php");}


// controllers
if(isset($_GET['page']) && !isset($session->page) )
{
	$session->set_page($_GET['page']);
} 

//-- blog --//
if (!isset($_POST['submit']) && isset($_GET['delete'])&& 
	(isset($_GET['ref']) && $_GET['ref']=="blog")
	)
{
	
	require_once ('blogentry_delete.php');
	//controller class
	//echo "delete blog entry";
}

if (isset($_POST['submit']) && !isset($_GET['delete']) && 
	(isset($_POST['form_type']) && $_POST['form_type']=="blog") 
)
{
	require_once ('blogentry_upload.php');
	//controller class
	//echo "upload blog post";
}

//-- projects --//
if (!isset($_POST['submit']) && isset($_GET['delete'])&& 
	(isset($_GET['ref']) && $_GET['ref']=="project")
	)
{
	require_once ('project_delete.php');
	//controller class
	//echo "delete blog entry";
}

if (isset($_POST['submit']) && !isset($_GET['delete']) && 
	(isset($_POST['form_type']) && $_POST['form_type']=="project") 
) // updating project
{
	require_once('project_upload.php');
	//require_once ('project_upload.php');
	//controller class
	//echo "upload blog post";
}

//-- projects --//
if (!isset($_POST['submit']) && isset($_GET['delete'])&& 
	(isset($_GET['ref']) && $_GET['ref']=="text")
	)
{
	require_once ('delete_text.php');
	//controller class
	//echo "delete blog entry";
}

if (isset($_POST['submit']) && !isset($_GET['delete']) && 
	(isset($_POST['form_type']) && $_POST['form_type']=="text") 
) // updating project
{
	require_once('text_upload.php');
	//require_once ('project_upload.php');
	//controller class
	//echo "upload blog post";
}

//-- projects --//
if (!isset($_POST['submit']) && isset($_GET['delete'])&& 
	(isset($_GET['ref']) && $_GET['ref']=="todo")
	)
{
	require_once ('todo_delete.php');
	//controller class
	//echo "delete blog entry";
}

if (isset($_POST['submit']) && !isset($_GET['delete']) && 
	(isset($_POST['form_type']) && $_POST['form_type']=="todo") 
) // updating project
{
	require_once('todo_upload.php');
	//require_once ('project_upload.php');
	//controller class
	//echo "upload blog post";
}

?>
<?php include_layout_template('new_admin_header.php');?>
<?php
// views
if (isset($_GET['ref']) && $_GET['ref'] == "blog") {
	include_layout_template('blog_form.php');
}

if (isset($_GET['ref']) && $_GET['ref'] == "blogList") {
	include_layout_template('blogList.php');
}

if (isset($_GET['ref']) && $_GET['ref'] == "project") {
	include_layout_template('project_form.php');
}

if (isset($_GET['ref']) && $_GET['ref'] == "projectList") {
	include_layout_template('projectList.php');
}

if (isset($_GET['ref']) && $_GET['ref'] == "text") {
	include_layout_template('text_form.php');
}

if (isset($_GET['ref']) && $_GET['ref'] == "textList") {
	include_layout_template('textList.php');
}
if (isset($_GET['ref']) && $_GET['ref'] == "todo") {
	include_layout_template('todo_form.php');
}

if (isset($_GET['ref']) && $_GET['ref'] == "todoList") {
	include_layout_template('todoList.php');
}
?>
<?php include_layout_template('new_admin_footer.php');?>