<?php require_once '../_includes/initialize.php'; ?>
<?php
$pageName = "Friends";
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
<script type="text/javascript">				
		
$(window).load(function(){  
 	var spotlight = {  
        // the opacity of the 'transparent' images - change it if you like  
    	opacity : 0.2,  

	/*the vars bellow are for width and height of the images so we can make the <li> same size */  
        imgWidth : $('.spotlightWrapper ul li').find('img').width(),  
  		imgHeight : $('.spotlightWrapper ul li').find('img').height()  

  	};  
  	
  	//set the width and height of the list items same as the images  
  	$('.spotlightWrapper ul li').css({ 'width' : spotlight.imgWidth, 'height' : spotlight.imgHeight });  
     
  	//when mouse over the list item...  
  	$('.spotlightWrapper ul li').hover(function(){  
  		   
  		//...find the image inside of it and add active class to it and change opacity to 1 (no transparency)  
  		$(this).find('img').addClass('active').animate({ 'opacity' : 1}, 250);     
  		
  		//get the other list items and change the opacity of the images inside it to the one we have set in the spotlight array  
  		
  		$(this).siblings('li').find('img').animate({ 'opacity' : spotlight.opacity}, 250);  
 
  	//when mouse leave...  
  	}, function(){  
  	
  	//... find the image inside of the list item we just left and remove the active class  
  	$(this).find('img').removeClass('active');  
     
  	});  
    
    //when mouse leaves the unordered list...  
  	$('.spotlightWrapper ul').bind('mouseleave',function(){  
  	//find the images and change the opacity to 1 (fully visible)  
  	$(this).find('img').animate({ 'opacity' : 1}, 750);  
  });  

});
</script>
<h2><?php echo $text->title; ?></h2>
<section id="blog"/>
	
	<div class='spotlightWrapper'>
	<div class="artHolder">
    <ul>
<li margin="0" ><a href="http://www.lisaiaboni.com"  target="_blank" ><img src="../_tmp/lisaI2.jpg" alt = "Lisa Iaboni" title = "Lisa Iaboni"/></a></li>
<li margin="0" ><a href="http://d-pi.com/"  target="_blank" ><img src="../_tmp/ron2.jpg" alt = "Ron Wimberly" title = "Ron Wimberly"/></a></li>
<li margin="0" ><a href="http://www.cafepress.com/toonmarketplace"  target="_blank" ><img src="../_tmp/kcmd.jpg" alt = "Keith 'Cartoon Man' Douglas" title = "Keith 'Cartoon Man' Douglas"/></a></li>
<li margin="0" ><a href="http://www.theimaginary.net/"  target="_blank" ><img src="../_tmp/tarampi.jpg" alt = "Alex Tarampi" title = "Alex Tarampi"/></a></li>
<li margin="0" ><a href="http://www.willyrichardson.com/"  target="_blank" ><img src="../_tmp/wbr.png" alt = "Willy Richardson" title = "Willy Richardson"/></a></li>
<li margin="0" ><a href="http://www.dougcowan.net"  target="_blank" ><img src="../_tmp/doug.jpg" alt = "Doug Cowan" title = "Doug Cowan"/></a></li>
<li margin="0" ><a href="http://www.delanodunn.com/"  target="_blank" ><img src="../_tmp/delano.jpg" alt = "Delano Dunn" title = "Delano Dunn"/></a></li>
<li margin="0" ><a href="http://marcocarag.com/"  target="_blank" ><img src="../_tmp/mcarag.png" alt = "Marco Carag" title = "Marco Carag"/></a></li>
<li margin="0" ><a href="http://www.youtube.com/user/charlyneyi"  target="_blank" ><img src="../_tmp/cyi.png" alt = "Charlyne Yi" title = "Charlyne Yi"/></a></li>
<li margin="0" ><a href="http://www.joshsisk.com"  target="_blank" ><img src="../_tmp/joshsisk.jpg" alt = "Josh Sisk" title = "Josh Sisk"/></a></li>
<li margin="0" ><a href="http://www.seanstarwars.com/"  target="_blank" ><img src="../_tmp/sswars.jpg" alt = "Sean Star Wars" title = "Sean Star Wars"/></a></li>
<li margin="0" ><a href="http://www.lostinemoticons.com/"  target="_blank" ><img src="../_tmp/emoticons.jpg" alt = "Lost In Emoticons" title = "Lost In Emoticons"/></a></li>
<li margin="0" ><a href="http://www.astriasuparak.com"  target="_blank" ><img src="../_tmp/suparak.jpg" alt = "Astria Suparak" title = "Astria Suparak"/></a></li>
<li margin="0" ><a href="http://www.npr.org/blogs/monitormix/"  target="_blank" ><img src="../_tmp/mmix.png" alt = "Monitor Mix" title = "Monitor Mix"/></a></li>
<li margin="0" ><a href="http://www.edwardpramuk.com/"  target="_blank" ><img src="../_tmp/edPramuk.jpg" alt = "Edward Pramuk" title = "Edward Pramuk"/></a></li>
<li margin="0" ><a href="http://www.larsonburns.com/"  target="_blank" ><img src="../_tmp/lbs.png" alt = "Larson Burns Smith" title = "Larson Burns Smith"/></a></li>
<li margin="0" ><a href="http://www.npr.org/templates/story/story.php?storyId=6553605"  target="_blank" ><img src="../_tmp/benTupper.jpg" alt = "Ben Tupper" title = "Ben Tupper"/></a></li>
<li margin="0" ><a href="http://www.thunderant.com/"  target="_blank" ><img src="../_tmp/tant.png" alt = "ThunderAnt" title = "ThunderAnt"/></a></li>
<li margin="0" ><a href="http://millergallery.cfa.cmu.edu/"  target="_blank" ><img src="../_tmp/mgcmu.png" alt = "Miller Gallery at Carnegie Mellon University" title = "Miller Gallery at Carnegie Mellon University"/></a></li>
<li margin="0" ><a href="http://turnerlange.blogspot.com/"  target="_blank" ><img src="../_tmp/turner1.jpg" alt = "Turner Lange" title = "Turner Lange"/></a></li>
<li margin="0" ><a href="http://www.peterjketchum.com/"  target="_blank" ><img src="../_tmp/ketchum.jpg" alt = "Peter J. Ketchum" title = "Peter J. Ketchum"/></a></li>
<li margin="0" ><a href="http://www.amyemartin.com/"  target="_blank" ><img src="../_tmp/aem.png" alt = "Amy E. Martin" title = "Amy E. Martin"/></a></li>
<li margin="0" ><a href="http://www.andrewgarrahan.com/"  target="_blank" ><img src="../_tmp/ag.png" alt = "Andrew Garrahan" title = "Andrew Garrahan"/></a></li>
<li margin="0" ><a href="http://shinebriteproductions.blogspot.com/"  target="_blank" ><img src="../_tmp/dmas.png" alt = "Don Masse" title = "Don Masse"/></a></li>
<li margin="0" ><a href="http://www.genevieve-jones.com/"  target="_blank" ><img src="../_tmp/gj.jpg" alt = "Genevieve Jones" title = "Genevieve Jones"/></a></li>
<li margin="0" ><a href="http://vimeo.com/user1148089"  target="_blank" ><img src="../_tmp/tedTrain.jpg" alt = "Ted Lange IV" title = "Ted Lange IV"/></a></li>
<li margin="0" ><a href="http://www.jennifersullivan.org"  target="_blank" ><img src="../_tmp/jenVeil.jpg" alt = "Jennifer Sullivan" title = "Jennifer Sullivan"/></a></li>
<li margin="0" ><a href="http://www.transformazium.org/"  target="_blank" ><img src="../_tmp/braddock.jpg" alt = "transformazium" title = "transformazium"/></a></li>
<li margin="0" ><a href="http://peripheralmediaprojects.com/"  target="_blank" ><img src="../_tmp/pmp.jpg" alt = "{PMP}" title = "{PMP}"/></a></li>
<li margin="0" ><a href="http://ruedaminute.com/"  target="_blank" ><img src="../_tmp/mrueda.png" alt = "Michelle Rueda" title = "Michelle Rueda"/></a></li>
<li margin="0" ><a href="http://www.mayslesfilms.com/"  target="_blank" ><img src="../_tmp/maysles.jpg" alt = "Albert Maysles" title = "Albert Maysles"/></a></li>
<li margin="0" ><a href="http://www.bendependent.com"  target="_blank" ><img src="../_tmp/benMonster.jpg" alt = "Bendependent" title = "Bendependent"/></a></li>
<li margin="0" ><a href="http://benjaminclanton.com"  target="_blank" ><img src="../_tmp/bcc.png" alt = "Benjamin Clanton" title = "Benjamin Clanton"/></a></li>
<li margin="0" ><a href="http://www.nabboull.com/"  target="_blank" ><img src="../_tmp/nbmznr.png" alt = "Nabil Mouzannar" title = "Nabil Mouzannar"/></a></li>
<li margin="0" ><a href="http://www.proudfootimaging.com/"  target="_blank" ><img src="../_tmp/milesArmor2.jpg" alt = "Miles Thorpe" title = "Miles Thorpe"/></a></li>
<li margin="0" ><a href="http://amyvcooper.com/"  target="_blank" ><img src="../_tmp/avc.png" alt = "Amy V. Cooper" title = "Amy V. Cooper"/></a></li>
			<div class='clear'></div>
   </ul> </div>
   </div>
   <p class="supportText"><?php echo $text->text;?></p>
</section>
</section>
<?php include_layout_template('aside2.php'); ?>
<?php include_layout_template('new_footer.php'); ?>

