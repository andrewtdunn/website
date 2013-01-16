$(document).ready(function(){
	
        $(".log-entries li:nth-child(even)").hoverIntent(function() {
        		 $(this).animate({ color: "#000000" },  50);
        		 $(this).find("a").animate({ color: "#66666"},  50);
        		 $(this).find(".commentTime").animate({ color: "#000000" },  50);
                 $(this).animate({ backgroundColor: "#CEF0FC" }, 600);
                 $(this).find("a").css("text-decoration", "underline");
                 $(this).css( 'cursor', 'pointer' );
                 $(this).click(function() {
        		    $(this).find("a").animate({ color: "#000000" },  50);
  				 	window.location = $(this).find("a").attr("href");
				 });
               
        },function() {
        		 $(this).animate({ color: "#FFFFF" }, 50);
        		 $(this).find("a").animate({ color: "#FFF0A5" },  50);
        		 $(this).find("a").css("text-decoration", "none");
        		 $(this).find(".commentTime").animate({ color: "#CEF0FC" },  50);
                 $(this).animate({ backgroundColor: "#000000" }, 400);   
                     
        });
        
        $(".log-entries li:nth-child(odd)").hoverIntent(function() {
        		 $(this).animate({ color: "#000000" },  50);
        		 $(this).find("a").animate({ color: "#66666"},  50);
        		 $(this).find(".commentTime").animate({ color: "#000000" },  50);
                 $(this).animate({ backgroundColor: "#CCFFFF" }, 600);
                 $(this).find("a").css("text-decoration", "underline");
                 $(this).css( 'cursor', 'pointer' );
                 $(this).click(function() {
                 	$(this).find("a").animate({ color: "#000000" },  50);
  				 	window.location = $(this).find("a").attr("href");
				 });
        	
        },function() {
        		 $(this).animate({ color: "#FFFFF" }, 50);
        		 $(this).find("a").animate({ color: "#FFF0A5" },  50);
        		 $(this).find("a").css("text-decoration", "none");
        		 $(this).find(".commentTime").animate({ color: "#CEF0FC" },  50);
                 $(this).animate({ backgroundColor: "#000000" }, 400);      
        })
});