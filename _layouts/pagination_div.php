<?php
global $pagination;
global $page;
if ($pagination -> total_pages() > 1) {
	echo '<div id="pagination">';
	if ($pagination -> has_previous_page()) {
		echo " <a href=\"blog.php?page=";
		echo $pagination -> previous_page();
		echo "\"> &laquo; Previous</a> ";
	}

	if ($page <= 5)
	{
		for ($i = 1; $i<=5; $i++)
		{
			if ($i == $page) {
				echo "<span class=\"selected\">{$i}</span> ";
			} else {
				echo "<a href=\"blog.php?page={$i}\">{$i}</a> ";
			}
			
		}
	}
	else if ($page + 3 >= $pagination->total_pages()) 
	{
		$minPage = $pagination->total_pages() -5;
		for ($i = $minPage; $i <= $pagination->total_pages(); $i++)
		{
			if ($i == $page) {
				echo "<span class=\"selected\">{$i}</span> ";
			} else {
				echo "<a href=\"blog.php?page={$i}\">{$i}</a> ";
			}
		}
	}
	else 
	{
		$minPage = $page - 2 ;
		$minPage = $page + 2;
		for ($i = $minPage; $i <= $maxPage; $i++)
		{
			if ($i == $page) {
				echo "<span class=\"selected\">{$i}</span> ";
			} else {
				echo "<a href=\"blog.php?page={$i}\">{$i}</a> ";
			}
		}
	}

	if ($pagination -> has_next_page()) {
		echo " <a href= \"blog.php?page=";
		echo $pagination -> next_page();
		echo "\">Next &raquo; </a>";
	}
}
?>
</div>