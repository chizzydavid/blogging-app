<?php
    function slug($text) {
      $text = preg_replace('~[^pLd]+u~', '-', $text);
      $text = trim($text, '-');
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      $text = strtolower($text);
      $text = preg_replace('~[^-w]+~', '', $text);
      if (empty($text)) {
        return 'n-a';
      }
      return $text;
    }
    echo slug('How to be a millionaire');
    echo 'how there';
    $a = true;
    echo '<p><b>l</b>umbar</p>';

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $page_title; ?></title>
    <link href="templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="templates/css/<?php echo $stylesheet; ?>" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Default Logo</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link " href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link " href="about.php">About</a></li>
            <li class="nav-item"><a class="nav-link " href="categories.php">Categories</a></li>
            <li class="nav-item"><a class="nav-link " href="contact.php">Contact</a></li>
          </ul>        
        </div>
      </div>
    </nav>




  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">

        <button type="button" id="nav-icon" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <div id="barone" class="icon-bar"></div>
          <div id="bartwo" class="icon-bar"></div>
          <div id="barthree" class="icon-bar"></div>                 
        </button>

        <a class="navbar-brand" href="#myPage">Logo</a>
      </div>

      <div class="collapse navbar-collapse navbar-right" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="../index.php">Blog Home</a></li>
          <li><a href="index.php">All Posts</a></li>
          <li><a href="add-post.php">Add Post</a></li>

          <?php if ($id === '6') { ?>
            <li><a href="users.php">All Users</a></li>
            <li><a href="add-user.php">Add User</a></li>
          <?php }
          ?>
          <li><a href="user-profile.php?ID=<?php echo $id ?>">View Profile</a></li>
          <li><a href="logout.php">Log Out</a></li>
       </ul>
      </div>
    </div>
  </nav> 



  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="#myPage">Logo</a>
      </div>

      <div class="collapse navbar-collapse navbar-right" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#mybody" class="active">HOME</a></li>
          <li><a href="#about">ABOUT</a></li>
          <li><a href="#services">SERVICES</a></li>
          <li><a href="#picture">PICTURE GALLERY</a></li>
          <li><a href="#contact">CONTACT</a></li>
         </ul>
      </div>
    </div>
  </nav> 




    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Default Logo</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

          <ul class="nav navbar-nav">
            <li><a href="../index.php">Blog Home</a></li>
            <li><a href="index.php">All Posts</a></li>
            <li><a href="add-post.php">Add Post</a></li>

            <?php if ($id === '6') { ?>
              <li><a href="users.php">All Users</a></li>
              <li><a href="add-user.php">Add User</a></li>
            <?php }
            ?>
            <li><a href="user-profile.php?ID=<?php echo $id ?>">View Profile</a></li>
            <li><a href="logout.php">Log Out</a></li>
         </ul>       
        </div>
      </div>
    </nav> 

