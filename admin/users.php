<?php
  require_once('../classes/admin-class.php');
  $loggedIn = $ac->checklogin();
  $title = 'All Users';
  $page_title = 'all-users';
  require_once('admin-header.php');  
  $ac->all_users();

  require_once('admin-footer.php');

?>
  