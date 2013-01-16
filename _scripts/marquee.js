/**
 *  @author Andrew Dunn
 */

var currentSlide = 0;
var totalSlides;
var intervalHandle;
var timeoutHandle;
var pauseLength = 4000;

$(document).ready(function()
{
	
    
    $(window).blur(function(){
        window.clearInterval(intervalHandle);
		window.clearTimeout(timeoutHandle);
    });

	
//	console.log("hi");
	$('img.marquee_panel_photo').each(function(index)
	{
		var photoWidth = $('.marquee_container').width();
		var photoPosition = index * photoWidth;
		
		$('.marquee_photos').append('<img class="marquee_photo" style="left:'+photoPosition+';" src="'+$(this).attr('src')+'" alt="'+$(this).attr('alt')+'" width="700" height="350" />');
		$('.marquee_photos').css('width',photoPosition+photoWidth);
	});
	
	$('.marquee_panels .marquee_panel').each(function(index)
	{
		$('.marquee_nav').append('<a class="marquee_nav_item"></a>');
	});
	
	$('.marquee_nav .marquee_nav_item').click(function()
	{
		window.clearInterval(intervalHandle);
		window.clearTimeout(timeoutHandle);
		currentSlide = $(this).index();
		shift();
		timeoutHandle = setTimeout(run, 5000);
		$(this).css( 'background-position-x', '-50px' );
		$(this).mouseleave( function() {
        	$(this).css( 'background-position-x', '-50px' );
    	})
		
	});
	
	$('.marquee_panels img').imgpreload(function()
	{
		initializeMarquee();
	});
	
	totalSlides = $('.marquee_nav').children().size()

	
	timeoutHandle = setTimeout(run, 4000);
});

function run()
{ 
	intervalHandle = setInterval(nextSlide, pauseLength);
}

function shift()
{
 
 	//console.log(currentSlide);
 	var navNum = currentSlide + 1;
 	$('.marquee_nav a.marquee_nav_item').removeClass('selected');
 	$('.marquee_nav a.marquee_nav_item').css( 'background-position-x', '0px' );
	$('.marquee_nav a.marquee_nav_item:nth-child(' + navNum + ')').addClass('selected');
	$('.marquee_nav a.marquee_nav_item:nth-child(' + navNum + ')').css( 'background-position-x', '-50px' );
	$('.marquee_nav a.marquee_nav_item:nth-child(' + navNum + ')').mouseenter( function() {
        $(this).css( 'background-position-x', '-50px' );
    })
    $('.marquee_nav a.marquee_nav_item:nth-child(' + navNum + ')').mouseleave( function() {
        $(this).css( 'background-position-x', '-50px' );
    })
	$('.marquee_nav .marquee_nav_item').not(".selected").mouseenter( function() {
        $(this).css( 'background-position-x', '-25px' );
    })

    $('.marquee_nav .marquee_nav_item').not(".selected").mouseleave( function() {
        $(this).css( 'background-position-x', '0px' );
    })
	
	var marqueeWidth = $('.marquee_container').width();
	var distanceToMove = marqueeWidth * (-1);
	var newPhotoPosition = currentSlide * distanceToMove + 'px';
		
	var newCaption = $('.marquee_panel_caption').get(currentSlide);
	
		
	$('.marquee_photos').animate({left:newPhotoPosition}, 1000);
		
	$('.marquee_caption').animate({top:'340px'},500,function()
	{
		var newHTML = $(newCaption).html();
		/*
		var newOverlayContent = '<iframe src="http://player.vimeo.com/video/'+$(newOverlayText).html()+'?autoplay=1" width="800" height="450" frameborder="1" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		*/
		$('.marquee_caption_content').html(newHTML);
		setCaption();
		
	});
}


function initializeMarquee()
{
	$('.marquee_caption_content').html(
		$('.marquee_panels .marquee_panel_caption').html()
	);
	$('.marquee_nav a.marquee_nav_item:first').addClass('selected');
	$('.marquee_photos').fadeIn(500);
	
	$('.marquee_nav .marquee_nav_item').not(".selected").mouseenter( function() {
        $(this).css( 'background-position-x', '-25px' );
    })

    $('.marquee_nav .marquee_nav_item').not(".selected").mouseleave( function() {
        $(this).css( 'background-position-x', '0px' );
    })
    
    
	setCaption();
	
	
}

function setCaption()
{
	$('.enableOverlay').css("color","#CEF0FC");
	var captionHeight = $('.marquee_caption').height();
	var marqueeHeight = $('.marquee_container').height();
	var newCaptionTop = marqueeHeight - captionHeight - 15;
	$('.marquee_caption').delay(100).animate({top:newCaptionTop}, 500);
	setTimeout( function() {
		//	console.log("change color");	
		 	$('.enableOverlay').animate({ color: "#bce08a"},  400) 
	}, 1000 );
	setTimeout( function() {
			console.log("change color");	
		 	$('.enableOverlay').animate({ color: "#FFF0A5"},  400) 
	}, 2000 );
	setTimeout( function() {
		//	console.log("change color");	
		 	$('.enableOverlay').animate({ color: "#bce08a"},  400) 
	}, 3000 );
	
	$('.enableOverlay').click(function()
	{
		//$('body').append('<div id="test">My Test</div>');
		window.clearInterval(intervalHandle);
		window.clearTimeout(timeoutHandle);
		var staticOverlayImage = $('img.marquee_panel_photo').get(currentSlide);
		var newOverlayImage = $('.overlayContent').get(currentSlide);
		var newOverlayTextH2 = $('.marquee_caption_content h2');
		var newOverlayText = $('.overlayTextCopy').get(currentSlide);
		var newOverlayContent;
		if ($(newOverlayImage).html()!="")
		{
    		newOverlayContent = '<div id="overlayInfoContainer"><div align="center"><hgroup class="headerSection"><h2>'+newOverlayTextH2.html()+'</h2></hgroup></div><div id="iFrameBorder"><iframe src="http://player.vimeo.com/video/'+newOverlayImage.innerHTML+'?autoplay=1&amp;loop=1" width="800" height="450" frameborder="1" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div><div id="overlayText" class="text2col">'+newOverlayText.innerHTML+'</div>';
    	}
    	else
    	{
    		newOverlayContent = '<div id="overlayInfoContainer"><div align="center"><hgroup class="headerSection"><h2>'+newOverlayTextH2.html()+'</h2></hgroup></div><img id="overlayImage" src="'+staticOverlayImage.src+'" /><div id="overlayText" class="text2col">'+newOverlayText.innerHTML+'</div>';
    	}
    	
    	
    	
    	
    	
    	
    	$('<div id = "overlay" />').html(newOverlayContent).appendTo('body');
    	$("#overlay").fadeIn("slow", function()
    	{
    		    	$("#overlayInfoContainer").center();
    		    	$("#overlayInfoContainer").fadeIn("slow");
    	}
    	);
    	
    	
    	
    	$("html,body").css("overflow","hidden");
    	
        
        
    	
    	
    	
    	
    	
	});
	
	$('#overlay').live("click", function()  {
		$('#testDiv').hide("slow", function()
		{
			$('#testDiv').appendTo('body', function()
			{
				
			});
		});
        $(this).fadeOut("slow", function() { $(this).remove(); nextSlide(); timeoutHandle = setTimeout(run, 4000); });
        $("html,body").css("overflow","auto");
   
	});
}

function nextSlide()
{
	
	currentSlide ++;
	if (currentSlide > totalSlides - 1)
	{
		currentSlide = 0;
	}
	shift(currentSlide);
}

    

    
