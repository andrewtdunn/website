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
	$per_page=7;
	// 3. total record cost ($total_count)
	$total_count = Text::count_all();
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM text ";
	$sql .= "ORDER BY entrytime DESC ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()} ";
	
	$entries = Text::find_by_sql($sql);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session) 
	$session->set_page($page);
?>
<h1>Text List</h1>
<?php 
// this should be a function of Pagination. pass in link
//include_layout_template('pagination_div.php');
// if $pagination is declared as global... why not called a non object??

print_pagination($pagination,$page, "index.php?ref=textList&");
?>
<?php

echo "<table class=\"adminTable\">";
echo "<th>id</th>";
echo "<th>page id</th>";
echo "<th>title</th>";
echo "<th>text</th>";
echo "<th>image_title</th>";
echo "<th>date</th>";
echo "<th></th>";


foreach ($entries as $entry): 
?>

<tr>
	<td><?php echo ($entry->id!="")?$entry->id:"(no id)"; ?></td>
	<td><?php 
	
	
		//echo ($entry->page_id!="")?$entry->page_id:"(no page id)"; 
		
		if (isset($entry->page_id) && $entry->page_id!="")
		{
			$sql2="";
			$sql2 = "SELECT * FROM pages WHERE id=".$entry->page_id." LIMIT 1";
			$pages = Page::find_by_sql($sql2);
			echo $pages[0]->page_name;
		}
		else {
			echo "(no page id)";
		}
		?>
	</td>
	<td><?php echo ($entry->title!="")?$entry->title:"(untitled)"; ?></td>
	<td><?php echo ($entry->text!="")?nl2br($entry->text):"(no text)"; ?></td>
	<td>
	<?php	
		if(isset($entry->image_title) && $entry->image_title !="" && strpos($entry->image_title, "swf")==0)
		{
			echo "<img src=\"";
			echo "../_images/page_images/".$entry->image_title;
			echo "\"/></td>";
		}
		else if (isset($entry->image_title) && $entry->image_title !="" && strpos($entry->image_title, "swf")!=0)
		{
			echo "(swf)";
		}
		else if ($entry->image_title =="")
		{
			echo "(no image)";
		}
	?>
	<td><?php echo datetime_to_text($entry->entrytime);?></td>
	<td><a href="">Hide</a><br/>
		<a href="index.php?ref=text&page=<?php echo $session->get_page()?>&modify_id=<?php echo $entry->id;?>">Edit</a><br/>
		<a href="index.php?ref=text&id=<?php echo $entry->id;?>&delete=1">Delete</a><br/>
	</a></td>
</tr>


<?php endforeach;
echo "</table>";
print_pagination($pagination,$page, "index.php?ref=textList&");	
?>