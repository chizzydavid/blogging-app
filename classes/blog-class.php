<?php
  require_once('db.php');

  class BLOGCLASS {

    //Query the database for all the approved blog posts, order them by postID in descending order
    public function do_blog_posts($page) {
      global $db; 
      $limit = '';
      if ($page == 1) $limit = 'LIMIT 0, 5'; 
      else if ($page > 1) {
        $skip = ($page * 5) - 5;
        $limit = 'LIMIT '. $skip . ', 5';
      }

      $query = "SELECT ID, postTitle, postDesc FROM blog_posts WHERE approved = '1' ORDER BY ID DESC ". $limit;
      $results = $db->select($query);

      while ($row = $results->fetch_assoc()) {
        echo "
          <div class=\"blog-entry\">
            <h2 class='mb-1 blog-title'><a href=\"view-post.php?p=$row[ID]\">$row[ID] $row[postTitle]</a></h2>
            <p class='blog-desc'>$row[postDesc]</p>
          </div>
        ";      
      }
    }

    public function get_post_data($post_id) {
      global $db;
      $query = "SELECT * FROM blog_posts WHERE ID='$post_id'";
      $results = $db->select($query); 

      if($results->num_rows == 1) {
        $row = $results->fetch_assoc();
        return $row;
      }     
    }

    public function get_new_posts($page) {
      global $db; 
      $limit = '';
      $posts = array();
      if ($page > 1) {
        $skip = ($page * 5) - 5;
        $limit = 'LIMIT '. $skip . ', 5';
      }

      $query = "SELECT ID, postTitle, postDesc FROM blog_posts WHERE approved = '1' ORDER BY ID DESC ". $limit;
      $results = $db->select($query);

      while ($row = $results->fetch_assoc()) { $posts[] = $row;  }
      return json_encode($posts);
    }
  }

  $bc = new BLOGCLASS;

?>