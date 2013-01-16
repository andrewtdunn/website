<html>
	<head>
		<title>Form Test</title>
		<link type="text/css" href="_css/form.css" media="all" rel="stylesheet" /> 
		<script>
			function removeCover()
			{
				var cover=document.getElementById("cover");
				cover.parentNode.removeChild(cover);
			};
			
			function submit()
			{
				console.log("submit");
			}
		</script>
	</head>
	<body>
		<div id="cover">
			<div id="closeButton" class="button" onclick="removeCover();">
				Enter
			</div>
		</div>
		<div id="mainLayout">
			<div id="mainLayoutInner">
				<header><h1>Entrance Form</h1></header>
				<h2>Name</h2>
				<input type="text" value="name" id="name"></input>
				
				<h2>Password</h2>
				<input type="text" value="password" id="password"></input>
				
				<div id="submitButton" class="button" onclick="submit();">submit</div>
			</div>
		</div>
	</body>
</html>