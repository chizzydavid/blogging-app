<?php
  require_once('../classes/admin-class.php');
  $loggedIn = $ac->checklogin();

  if($loggedIn == true) {
    $title = 'Profile Page';
    $page_title = 'view-profile';  
    require_once('admin-header.php');
    $ac->view_user_profile();
  } else {
    echo '<p>You have to be logged in to view this page. Click here to <a href="login.php">Login</a></p>';
  } 
  
  require_once('admin-footer.php');

?>
