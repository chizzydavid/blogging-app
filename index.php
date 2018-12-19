<?php 
  require_once('classes/blog-class.php');
  $page_title = "Chizzy's Blog - Homepage";
  $site_logo = 'Default Logo';
  $stylesheet = 'blog-home.css';
  $header_bg = 'images/portfolio-12.jpg';
  $header_title = "Chizzy's Blog";
  $header_subtitle = 'Welcome to my awesome blog, sit back and enjoy.';
  $page_number = 1;

  if (isset($_POST['page'])) {
    $page =  $_POST['page'];
    $posts = $bc->get_new_posts($page);
    echo $posts;
    exit();
  }

  /*if ($_GET['page']) $page_number = $_GET['page'];  
  $next_page = $page_number + 1;
  */

  require_once('templates/header-template.php');  
  ?>

  <section id="" class="blog-entry-container">
  <?php $bc->do_blog_posts($page_number); ?>
  </section>
  <section class="controls">
    <p id="info-space"> </p>
    <p id="more-posts"><a href="<?php echo $_SERVER['PHP_SELF']. '?page='. $next_page ?>">Older Posts &raquo;</a></p>
  </section>

  <?php
  require_once('templates/footer-template.php');
?>