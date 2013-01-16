<?php


function verifyAlphaNum ($testString) {
	return (preg_match ("/^[a-z0-9]+([\\s]{1}[a-z0-9]|[a-z0-9])+$/i", $testString));
}


function verifyEmail ($testString) {
		
	return (preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $testString));
}
 
function verifyPassword ($testString) {
	return (eregi ("^([[:alnum:]]|-|\.| |\?|\?|\"|')+$", $testString));
	
}

function verifyText ($testString) {
	$pattern = "/[^\w\s\;\.\-\,\?\'\!]\"/iD";
	return (!preg_match($pattern, $testString));
}

function verifyPhone ($testString) {
	return (eregi ('^([[:digit:]]| |-)+$', $testString));

}
?>