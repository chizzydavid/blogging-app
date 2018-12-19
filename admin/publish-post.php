<?php
  require_once('../classes/db.php');
  require_once('../classes/admin-class.php');  
  $loggedIn = $ac->checklogin();

  if($loggedIn == true) {
    $title = 'Publish Post';
	  require_once('admin-header.php');

    if (isset($_GET['id'])) {
      $postID = $_GET['id'];
      $query = "UPDATE blog_posts SET approved = 1 WHERE id =". $postID;

      $results = $db->update($query); 
      if ($results) echo "<p>The post was published successfully.</p>
                      <p>Back to <a href=\"index.php\">HomePage</a></p>";
      else echo "There was an error publishing the post";
    } 
    else echo 'Please <a href=index.php>select</a> a post to publish'; 
  } 


  else {
    echo '<p>You have to be logged in to view this page. Click here to <a href="login.php">Login</a></p>';
  } 
  
	require_once('admin-footer.php');

?>
