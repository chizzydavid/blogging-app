<?php
  require_once('db.php');
  
  class ADMIN_CLASS {
    public function signup () {
      global $db;
      if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $f_name = $db->clean($_POST['fullname']);
        $u_name = $db->clean($_POST['username']);
        $p_word = $db->clean($_POST['password']);
        $p_word2 = $db->clean($_POST['password2']);
        $phone = $db->clean($_POST['phone']);  
        $email = $db->clean($_POST['email']);
        $gender = $db->clean($_POST['gender']);
        $bio = $db->clean($_POST['bio']);
        $pt = $_FILES['portrait']['name'];
        $pt_type = $_FILES['portrait']['type'];
        $pt_size = $_FILES['portrait']['size'];

        //You still need major form validation for all the form fields
        if(!empty($f_name) && !empty($u_name) && !empty($p_word) && !empty($p_word2) && !empty($phone) && 
          !empty($email) && !empty($gender) && !empty($bio) && !empty($pt) ) {

          if ($p_word == $p_word2) {
            if($pt_type == 'image/png' || $pt_type == 'image/jpg' || $pt_type == 'image/jpeg' || $pt_type == 'image/gif') {

              if (($pt_size == 0) || ($pt_size >= GW_MAXFILESIZE)) {
                echo 'Your image must be less than 32kb';
                return;
              }

              //Check if username already exists in the database
              $table = 'blog_members';
              $query = "SELECT * FROM $table WHERE username= '$u_name'";
              $checkuser = $db->select($query);
              if($checkuser->num_rows != 0) {
                echo 'That username has been taken, please try again.';
                return;
              }
              $uploadpath = 'localhost/Projects/Blog_Application/admin/admin-img/';
              //Move uploaded image file to target folder
              $target = $uploadpath . $pt;
              if(!move_uploaded_file($_FILES['portrait']['tmp_name'], $target)){
                echo 'There was a problem uploading your file to the server';
                return;            
              } 

              //hash password
              $nonce = md5('registration-' . $u_name);
              $password = $db->pass_secure($p_word, $nonce);

              //insert values into the database
              $fields = array('ID', 'fullname', 'username', 'password', 'phone', 'email', 'gender', 'bio', 'portrait', 'date');
              $values = array(0, "'$f_name'", "'$u_name'", "'$password'", "'$phone'", "'$email'", "'$gender'", "'$bio'", "'$pt'", "now()");


              if($db->insert($table, $fields, $values)) {
                echo 'Registration successful. Click here to <a href="login.php"><b>login.</b></a>';
              } else {
                echo 'There was a problem uploading your data into the database';
              }

            } else {
              echo 'Invalid image file ' . $pt_type;
            }
          } else {
            echo 'Your two passwords don\'t march';
          }            

        } else {
          echo 'Please you must enter all the form fields';
        }

      } else return false;
    }

    public function login() {
      global $db;
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $u_name = $db->clean($_POST['username']);
        $p_word = $db->clean($_POST['password']);

        if(!empty($u_name) && !empty($p_word)) {
          //Check if username exists in the database(if the user is already registered)
          $table = 'blog_members';
          $query = "SELECT * FROM $table WHERE username= '$u_name'";
          $checkuser = $db->select($query);

          if($checkuser->num_rows == 1) {
            $results = $checkuser->fetch_assoc();

            $stopass = $results['password'];
            //rehash entered password so we can compare with the password already stored in the database
            $nonce = md5('registration-' . $results['username']);
            $subpass = $db->pass_secure($p_word, $nonce);

            if($stopass == $subpass) {
              //Create authentication Id
              $authnonce = md5('cookie-' . $u_name . $results['userreg']);
              $authID = $db->pass_secure($p_word, $authnonce);
              session_start();
              $_SESSION['id'] = $results['ID'];
              $_SESSION['blog_admin_uid'] = $authID;
              $_SESSION['blog_admin_user'] = $u_name;

              setcookie('blog_admin_uid', $authID, time() + (3600 * 48));
              setcookie('blog_admin_user', $subname, time() + (3600 * 48));

              //Redirect user to HOMEPAGE
              $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
              $redirect = str_replace('login.php', 'index.php', $url);
              header('Location: ' . $redirect);

            }
          } else {
            echo 'This Username doesn\'t exist';
          }          

        } else {
          echo 'Please enter your username and password';
        }
      }
    }

    public function checklogin() {
      session_start();
      if(isset($_SESSION['blog_admin_uid'])) return true; 
      else return false;
    }

    public function all_users() {
      global $db;      
      $id = $_SESSION['id'];
      echo "
        <table class='table mb-5 table-hover table-bordered'>
        <tr>
          <th><strong>Name</strong></th>
          <th><strong>Gender</strong></th>
          <th><strong>Phone Number</strong></th>
          <th><strong>Email Address</strong></th>
          <th><strong>Bio</strong></th>
          <th><strong>Date Registered</strong></th>
          <th><strong>Delete User</strong></th>
          </tr>";

      $query = "SELECT * FROM blog_members";
      $results = $db->select($query);

      while ($row = $results->fetch_assoc()) {
        $userID = $row['ID'];
        echo
          "<tr>
            <td> $row[fullname] </td>
            <td> $row[gender] </td>
            <td> $row[phone] </td>
            <td> $row[email] </td>
            <td> $row[bio] </td>
            <td> $row[date] </td>
            <td> <a href=\"confirm.php?deluser=$userID\">Delete</a></td>
            </tr>";
      }
      echo " </table>";
    }

    public function view_user_profile() {
      global $db;
      if (isset($_GET['ID'])) {
        $userID = $_GET['ID'];
        $query = "SELECT * FROM blog_members WHERE ID = ". $userID;

        $results = $db->select($query);
        if($results->num_rows === 1) {
          $row = $results->fetch_assoc();

          echo 
          '<div class="user-profile">
            <div class="image-sec"> 
              <h3>'. $row['fullname'] . '</h3>
              <p class="profile-image"><img class="portrait-img" src="admin-img/' . $row['portrait'] . '" alt="Portrait image" /></p>
            </div>
            <div class="personal-info">
              <p><span class="info-item">username: </span>'. $row['username'] .'</p> 
              <p><span class="info-item">Email Address: </span>'. $row['email'] . '</p> 
              <p><span class="info-item">Phone Number:  </span> '. $row['phone'] . ' </p>
              <p><span class="info-item">Bio:  </span>'. $row['bio'] . '</p>
              <p><a href="edit-user.php?ID= '. $userID .'">Edit Profile</a></p>
            </div>
          </div>';
        } 
        else {
          echo 'The user does not exist';
        }
      }
      else {
        echo 'Please select a user.';
      }
    }

    public function edit_user_profile() {
      global $db;
      if (isset($_GET['ID'])) {
        $userID = $_GET['ID'];
        $query = "SELECT * FROM blog_members WHERE ID = ". $userID;

        $results = $db->select($query);
        if($results->num_rows === 1) {
          $row = $results->fetch_assoc();
          return $row;
        } 
        else {
          echo 'The user does not exist';
        }
      }
      else {
        echo 'No user information';
      }
    }

    public function delete_user() {
      global $db;
      if (isset($_GET['id'])) {
        $userID = $_GET['id'];
        $query = "DELETE FROM blog_members WHERE ID =". $userID;

        $results = $db->update($query); 
        if ($results) echo "The user has been deleted from the database";
        else echo "There was an error deleting this user.";
      } 
      else {
        echo 'Please <a href=index.php>select</a> a post to delete';
      }
      $results = $db->select($query); 
    }    

    public function logout() {
      //Clear sessions and cookie data
      session_destroy();

      setcookie('login_admin_uid', $authID, time() - (3600 * 48));
      setcookie('login_admin_user', $subname, time() - (3600 * 48));

      $url = 'http://' .$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
      header('Location: '. $url);
    }

    public function all_blog_posts() {
      global $db;
      $self = $_SERVER['PHP_SELF'];
      $id = $_SESSION['id'];
      //6 is user-id for blog admin(blog-owner)
      if ($id === "6") {
        echo "
          <ul class='nav nav-justified' id='posts-nav'>
            <li><a class='active' href=\"$self\">All Posts</a></li>
            <li><a href=\"$self?approved=0\">Unpublished Posts</a> </li>
            <li><a href=\"$self?approved=1\">Published Posts</a> </li>
          </ul>
        ";
      }

      if (isset($_GET['approved'])) {
        $req = $_GET['approved'];
        $query = "SELECT * FROM blog_posts WHERE ". $req . " ORDER BY ID DESC";
      } 
      else $query = "SELECT * FROM blog_posts ORDER BY ID DESC";

      $results = $db->select($query);
      if ($results->num_rows == 0) {
        echo '<h3>There are no posts to display.</h3>';
        return;
      }

      echo " 
        <table class='table mb-5 table-hover table-bordered'>
        <tr>
          <th><strong>Post Title</strong></th>
          <th><strong>Post Author</strong></th>
          <th><strong>Post Description</strong></th>
          <th><strong>View Post</strong></th>
          <th><strong>Edit Post</strong></th>
          <th><strong>Post Date</strong></th> ";

          if ($id === "6") {
            echo "
              <th><strong>Delete Post</strong></th>
              <th><strong>Publish Post</strong></th>
            ";
          } 

         echo "</tr> ";

      while ($row = $results->fetch_assoc()) {
        $this->display_post($row);
      }      
              
      echo "</table>";
    }

    public function display_post($row) {
      //$time = date('jS M Y', $row['postDate']);
      $id = $_SESSION['id'];
      $time = $row['postDate'];
      $postID = $row['ID'];
      echo "<tr>
            <td> $row[postTitle] </td>
            <td> $row[postAuthor] </td>
            <td> $row[postDesc] </td>
            <td> <a href=\"../view-post.php?p=$postID\">View</a></td>
            <td> <a href=\"edit-post.php?id=$postID\">Edit</a></td>
            <td> $time </td> ";

          if ($id === "6") {
            echo "<td> <a href=\"confirm.php?del=$postID\">Delete</a></td> ";
            echo ($row['approved'] == 0) ? 
              "<td> <a href=\"confirm.php?pub=$postID\">Publish</a></td>" :
              "<td> <a href=\"confirm.php?remove=$postID\">Remove</a></td>
            ";
          }          
         echo "</tr> ";
    }

    public function add_post_page() {
      echo 
      '<p id="result"></p>
      <div id="post-nav" class="post-nav">

        <ul class=\'nav nav-justified\' id=\'posts-nav-list\'>
          <li><a class="add-title">Add Title</a></li>
          <li><a class="add-author">Add Author</a></li>
          <li><a class="add-description">Add Description</a></li>
          <li><a class="add-featured-image">Featured Image</a></li>
          <li><a class="add-paragraph">Add Paragraph</a></li>
          <li><a class="add-image">Insert Image</a></li>
          <li><a class="add-subheading">Add Heading</a></li>
        </ul>
      </div>

      <div class="form-space form-hidden">
        <h2>Form Action</h2>
        <form id="form" enctype="multipart/form-data" method="POST" action="new_blog_post.php" >

          <div class="form-controls">
            <input id="done" type="submit" name="submit" value="Done">
            <input id="cancel" type="submit" name="submit" value="Cancel">
          </div>
        </form>
      </div>

      <div class="blog-post">
        <iframe id="blog-iframe" src="newpost.php"></iframe>
      </div>

      <section class="submit-section">
        <input id="submit-post" type="submit" name="submit" value="Submit Post">
        <input id="cancel-post" type="submit" name="submit" value="Cancel Post">
      </section>
          ';
    }

    public function insert_post($array) {
      global $db;
      $title = $db->clean($_POST['title']);
      $author = $db->clean($_POST['author']);
      $description = $db->clean($_POST['description']);
      $featuredImage = $db->clean($_POST['featuredImage']);
      $content = $db->clean($_POST['content']);
      $table = 'blog_posts';
      $fields = array('ID', 'postTitle', 'postAuthor', 'postDesc', 'featuredImage', 'postContent', 'postDate');
      $values = array(0, "'$title'", "'$author'", "'$description'", "'$featuredImage'", "'$content'", "now()");
      if($db->insert($table, $fields, $values)) return true;
      else return false;
    }

    public function remove_post() {
      global $db;

      if (isset($_GET['id'])) {
        $postID = $_GET['id'];
        $query = "UPDATE blog_posts SET approved = 0 WHERE id =". $postID;

        $results = $db->update($query); 
        if ($results) echo "The post was removed successfully.";
        else echo "There was an error removing the post";
      } 
      else echo 'Please <a href=index.php>select</a> a post to remove';
    }
  }

  $ac = new ADMIN_CLASS;


?>