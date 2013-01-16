<?php require_once '../_includes/initialize.php'; ?>
<?php
/**
 * Admin table for blog
 * 
 */

 	// this should be in a separate class
 
	// 1. The current page number ($current_page)
	$page=!empty($_GET['page'])?(int)$_GET['page'] : 1;
	// 2. records per page ($per_page)
	$per_page=5;
	// 3. total record cost ($total_count)
	$total_count = Project::count_all();
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM projects ";
	$sql .= "ORDER BY entrytime DESC ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
	
	$projects = Project::find_by_sql($sql);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session) 
	$session->set_page($page);

?>
<h1>Project List</h1>
<?php 
// this should be a function of Pagination. pass in link
//include_layout_template('pagination_div.php');
// if $pagination is declared as global... why not called a non object??

print_pagination($pagination,$page, "index.php?ref=projectList&");
?>
<?php

echo "<table class=\"adminTable\">";
echo "<th>title</th>";
echo "<th>text</th>";
echo "<th>image</th>";
echo "<th>vimeo id</th>";
echo "<th>overlay_text</th>";
echo "<th></th>";

foreach ($projects as $project): 
?>

<tr>
	<td><?php echo ($project->title!="")?$project->title:"(untitled)"; ?></td>
	<td><?php echo ($project->text!="")?nl2br($project->text):"(no text)"; ?></td>
	<td>
	<?php	
		if(isset($project->image_title) && $project->image_title !="" && strpos($project->image_title, "swf")==0)
		{
			echo "<img src=\"../_images/project_images/";
			echo $project->image_title;
			echo "\"/></td>";
		}
		else if (isset($project->image_title) && $project->image_title !="" && strpos($project->image_title, "swf")!=0)
		{
			echo "(swf)";
		}
		else if ($project->image_title =="")
		{
			echo "(no image)";
		}
	?>
	<td><?php echo ($project->vimeoID!="")?$project->vimeoID:"(none)"; ?></td>
	<td><?php echo ($project->overlay_text!="")?nl2br($project->overlay_text):"(no overlay text)"; ?></td>
	<td><a href="">Hide</a><br/>
		<a href="index.php?ref=project&page=<?php echo $session->get_page()?>&modify_id=<?php echo $project->id;?>">Edit</a><br/>
		<a href="index.php?ref=project&id=<?php echo $project->id;?>&delete=1">Delete</a><br/>
	</a></td>
</tr>


<?php endforeach;
echo "</table>";
print_pagination($pagination,$page, "index.php?ref=projectList&");	
