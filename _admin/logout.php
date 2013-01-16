<?php

require_once('../_includes/initialize.php');

$session->logout();
if (!$session->is_logged_in()) {redirect_to("login.php");}
?>