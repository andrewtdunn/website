$(document).load(function(){
		
         $("#slideshow li:nth-child(even) a").hoverIntent(function() {
         		console.log("over");
                $(this).parent().animate({ backgroundColor: "#CEF0FC" }, 600);
               
        },function() {
                 $(this).animate({ backgroundColor: "#000000" }, 400);       
        });
        
        
        $("#slideshow li:nth-child(even)").hoverIntent(function() {
                $(this).animate({ backgroundColor: "#CCFFFF" }, 600);
               
        },function() {
                 $(this).animate({ backgroundColor: "#000000" }, 400);       
        });
});
