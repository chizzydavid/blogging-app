<?php
  require_once('../classes/db.php');
  require_once('../classes/admin-class.php');  
  $loggedIn = $ac->checklogin();

  if($loggedIn == true) {
    $title = 'Confirm Action';
	  require_once('admin-header.php');
    //$ac->confirm_action();

    if ($_GET) { 
      if (isset($_GET['pub'])) {
        $id = $_GET['pub'];
        $query = "SELECT * FROM blog_posts WHERE ID='$id'";
        $results = $db->select($query); 
        if ($results->num_rows ===  1) {
          $row = $results->fetch_assoc();
          $postTitle = $row['postTitle'];
        }

        echo "<p>You are about to publish this post?</p>
              <h3 class='confirm-title'>$postTitle</h3>
              <p>
               <button ><a href=\"publish-post.php?id=$id\">Continue </a></button>
               <button ><a href=\"index.php\"> Cancel</a></button>
              </p>
            ";
      }

      else if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $query = "SELECT * FROM blog_posts WHERE ID='$id'";
        $results = $db->select($query); 
        if ($results->num_rows ===  1) {
          $row = $results->fetch_assoc();
          $postTitle = $row['postTitle'];
        }           

        echo "<p>Are you sure you want to delete this post?</p>
              <h3 class='confirm-title'>$postTitle</h2>
              <p>
               <button><a href=\"delete-post.php?id=$id\">Continue </a></button>
               <button><a href=\"index.php\"> Cancel</a></button>
              </p>
            ";
      }

      else if (isset($_GET['deluser'])) {
        $id = $_GET['deluser'];
        $query = "SELECT * FROM blog_members WHERE ID='$id'";
        $results = $db->select($query); 
        if ($results->num_rows ===  1) {
          $row = $results->fetch_assoc();
          $username = $row['fullname'];
        }           

        echo "<p>Are you sure you want to delete this user?</p>
              <h3 class='confirm-title'>$username</h2>
               <p>
               <button><a href=\"delete-user.php?id=$id\">Continue </a></button>
               <button><a href=\"index.php\"> Cancel</a></button>
              </p>
            ";
      }

      else if (isset($_GET['remove'])) {
        $id = $_GET['remove'];
        $query = "SELECT * FROM blog_posts WHERE ID='$id'";
        $results = $db->select($query); 
        if ($results->num_rows ===  1) {
          $row = $results->fetch_assoc();
          $postTitle = $row['postTitle'];
        }

        echo "<p>You are about to Unpublish/remove this post?</p>
              <h3 class='confirm-title'>$postTitle</h3>
              <p>
               <button><a href=\"remove-post.php?id=$id\">Continue </a></button>
               <button><a href=\"index.php\"> Cancel</a></button>
              </p>
            ";
      }

    } else {
        echo 'Please <a href=index.php>select</a> an action to confirm';
    }  
  } else {
  	echo '<p>You have to be logged in to view this page. Click here to <a href="login.php">Login</a></p>';
	} 
	
	require_once('admin-footer.php');

?>
