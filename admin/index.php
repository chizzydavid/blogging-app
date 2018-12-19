<?php
  require_once('../classes/admin-class.php');
  $loggedIn = $ac->checklogin();

  if($loggedIn == true) {
    $page_title = 'all-posts';
    $title = 'Blog Admin Home Page';
	  require_once('admin-header.php');  
  	$ac->all_blog_posts();
  }

  else {
  	echo '<p>You have to be logged in to view this page. Click here to <a href="login.php">Login</a></p>';
  }
  require_once('admin-footer.php'); 
?>

</body>
</html>




