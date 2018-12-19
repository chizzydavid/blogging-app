<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <?php 
    if (isset($stylesheet)) {
    echo "<link rel=\"stylesheet\" href=\"css/$stylesheet\">";
    }
    else echo "<link rel=\"stylesheet\" href=\"css/admin.css\">"; 
  ?>
  <title><?php echo $title; ?></title>
</head>
<body>


  <?php
    if($loggedIn) {
      $id = $_SESSION['id'];
  ?>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="#page-top">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="../index.php">Blog Home</a></li>
            <li class="nav-item"><a class="nav-link " href="index.php">All Posts</a></li>
            <li class="nav-item"><a class="nav-link" href="add-post.php">Add Post</a></li>

            <?php if ($id === '6') { ?>
              <li class="nav-item"><a class="nav-link" href="users.php">All Users</a></li>
              <li class="nav-item"><a class="nav-link" href="add-user.php">Add User</a></li>
            <?php }
            ?>
            <li class="nav-item"><a class="nav-link" href="user-profile.php?ID=<?php echo $id ?>">View Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
   
  <?php } 

  ?> 
<section class="container <?php if (isset($page_title)) echo $page_title; ?>" id="main-container">
  <h1><?php echo $title; ?></h1>
