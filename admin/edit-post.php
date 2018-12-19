<?php
  require_once('../classes/db.php');
  require_once('../classes/admin-class.php');
  $loggedIn = $ac->checklogin();

  if($loggedIn == true) {
    $title = '';
    $stylesheet = 'add-post.css';
	  require_once('admin-header.php');

    if (isset($_GET['id'])) {
      $postID = $_GET['id'];
      $query = "SELECT * FROM blog_posts WHERE ID='$postID'";
      $results = $db->select($query); 

      if($results->num_rows == 1) {
        $row = $results->fetch_assoc();
        /*
        echo "
          <div id=\"post\">
            <p id=\"post-title\">$row[postTitle]</p>
            <p id=\"post-author\">$row[postAuthor]</p>            
            <p id=\"post-desc\">$row[postDesc]</p>            
            <p id=\"feat-image\">$row[featuredImage]</p>                        
            <div id=\"post-content\">$row[postContent]</div>
          </div>
        ";
        */ 

        echo 
          '<p id="result"></p>
          <div id="post-nav" class="post-nav">
            <ul class=\'nav nav-justified\' id=\'posts-nav-list\'>
              <li><a class="add-title">Edit Title</a></li>
              <li><a class="add-author">Edit Author</a></li>
              <li><a class="add-description">Edit Description</a></li>
              <li><a class="add-featured-image">Edit Featured Image</a></li>
              <li><a class="add-paragraph">Add Paragraph</a></li>
              <li><a class="add-image">Insert Image</a></li>
              <li><a class="add-subheading">Add Heading</a></li>
            </ul>
          </div>

          <div class="form-space form-hidden">
            <h2>Form Action</h2>
            <form id="form" enctype="multipart/form-data" method="POST" action="" >

              <div class="form-control">
                <input id="done" type="submit" name="submit" value="Done">
                <input id="cancel" type="submit" name="submit" value="Cancel">
              </div>
            </form>
          </div>

          <div class="blog-post">
            <!--<h2>Edit Blog Post</h2>-->
            <iframe id="blog-iframe" src="newpost.php"></iframe>
          </div>

          <section class="submit-section">
            <input id="submit-post" type="submit" name="submit" value="Submit Post">
            <input id="cancel-post" type="submit" name="submit" value="Cancel Post">
          </section>
        ';
      }
    }
    else {
      echo 'Please <a href=index.php>select</a> a post to Edit';
    } 

  } else {
  	echo '<p>You have to be logged in to view this page. Click here to <a href="login.php">Login</a></p>';
	}

?>
  </section>
  <script src="js/edit-post.js"></script>

</body>

</html>