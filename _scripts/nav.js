$(document).ready(function(){
		
        
        // simple, but elegant jquery to light up nav items 
        // on rollover. there are two slightly different shades
        // of light blue between even and odd items for
        // a more natural flourescent effect, and text fades
        // to black. 
        var lightblue	= "#CEF0FC";
	    var lightblue2 	= "#CCFFFF";
	    var offWhite 	= "#EEFFFF";
	    var black		= "#000000";
        var uptime		= 600; // ms
        var downtime	= 400;
        var textTime	= 50;
        var ogBkgdColor = "#bce08a"
        
        
         $("#scrollingDiv a:nth-child(even)").hoverIntent(function() {
        		 $(this).animate({ color: black },  textTime);
                $(this).animate({ backgroundColor: lightblue }, uptime);
               
        },function() {
        		 $(this).animate({ color: ogBkgdColor }, textTime);
                 $(this).animate({ backgroundColor: black },downtime);       
        });
        
        
        $("#scrollingDiv a:nth-child(odd)").hoverIntent(function() {
        		 $(this).animate({ color: black }, textTime);
                $(this).animate({ backgroundColor: lightblue2 }, uptime);
               
        },function() {
        		 $(this).animate({ color: ogBkgdColor }, textTime);
                 $(this).animate({ backgroundColor: black },downtime);       
        });
        
        $("#scrollingDiv a").click(function() {
        		 $(this).animate({ backgroundColor: offWhite },  uptime);      
        });
        
        
});


