<?php
  require_once('../classes/admin-class.php');
  $loggedIn = $ac->checklogin();

  if($loggedIn == true) {
    $title = 'Add New Blog Post';
    $page_title = 'add-post';
    $stylesheet = 'add-post.css';
	  require_once('admin-header.php');
	  $ac->add_post_page();
  } else {
  	echo '<p>You have to be logged in to view this page. Click here to <a href="login.php">Login</a></p>';
	} 
	

  $js = 'add-post.js';
  require_once('admin-footer.php');

?>
