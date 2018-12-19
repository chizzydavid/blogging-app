<?php
  require_once('../classes/admin-class.php');
  $loggedIn = $ac->checklogin();

  if($loggedIn == true) {
	require_once('admin-header.php');  
  	$ac->logout();
  }

?>
