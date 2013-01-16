<?php require_once '../_includes/initialize.php'; ?>
<?php require_once '../_includes/pagination.php'; ?>
<?php
/**
 * Admin table for blog
 * 
 */

 	// this should be in a separate class
 
	// 1. The current page number ($current_page)
	$page=!empty($_GET['page'])?(int)$_GET['page'] : 1;
	// 2. records per page ($per_page)
	$per_page=30;
	// 3. total record cost ($total_count)
	$total_count = Todo::count_all();
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM todo ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
	
	$entries = Todo::find_by_sql($sql);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session) 
	$session->set_page($page);
?>
<h1>To Do List</h1>
<?php 
// this should be a function of Pagination. pass in link
//include_layout_template('pagination_div.php');
// if $pagination is declared as global... why not called a non object??

print_pagination($pagination,$page, "index.php?ref=todoList&");
?>
<?php

echo "<table class=\"adminTable\">";
echo "<th></th>";
echo "<th>description</th>";
echo "<th></th>";

$entryNum=1;
foreach ($entries as $entry): 
?>

<tr>
	<td><?php echo $entryNum; ?></td>
	<td><?php echo ($entry->description!="")?$entry->description:"(no description)"; ?></td>
	<td><a href="">Hide</a><br/>
		<a href="index.php?ref=todo&page=<?php echo $session->get_page()?>&modify_id=<?php echo $entry->id;?>">Edit</a><br/>
		<a href="index.php?ref=todo&id=<?php echo $entry->id;?>&delete=1">Delete</a><br/>
	</a></td>
</tr>


<?php $entryNum++; endforeach;
echo "</table>";
print_pagination($pagination,$page, "index.php?ref=todoList&");	
?>