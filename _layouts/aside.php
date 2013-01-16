<?php require_once '../_includes/text.php'; ?>
<aside class="col3">
	<script type="text/javascript" src="../_scripts/logList.js"></script>
	<h3 class="log-header">Recent Activity</h3>
	<?php Logger::print_log(); ?>
	<script type="text/javascript" src="../_scripts/instgramOveride.js"></script>
	<ul id="slideshow"></ul>
	<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 9,
  interval: 30000,
  width: 312,
  height: 550,
  theme: {
    shell: {
      background: '#333333',
      color: '#bce08a'
    },
    tweets: {
      background: '#000000',
      color: '#ffffff',
      links: '#CEF0FC'
    }
  },
  features: {
    scrollbar: true,
    loop: false,
    live: true,
    behavior: 'all'
  }
}).render().setUser('andrewtdunn').start();
</script>
<div id="scrollingDiv2">	
<?php
	$description = Text::find_by_id(4);
?>	
	
	
			<h2 id="scrollingDivHeader"><?php echo $description->title; ?></h2>
			<img id="asideImage" src="../_images/page_images/<?php echo $description->image_title; ?>"/>
			<p class="supportText"><?php echo nl2br($description->text); ?></p>
</div>
			
		</aside>