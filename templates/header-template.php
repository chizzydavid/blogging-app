<?php require_once('templates/functions.php');  ?>
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
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><?php echo $site_logo; ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

          <?php  $nav = do_main_nav(); echo $nav;?>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead" 
    style="background:linear-gradient( rgba(19, 19, 19, 0.6), rgba(19, 19, 19, 0.6)), url('<?php echo $header_bg; ?>'); background-position: center; background-repeat: no-repeat; background-size: cover;">
      <div class="container mast-con">
        <div class="mx-auto">
          <h1 class=""><?php echo $header_title; ?></h1>
          <h2 class=""><?php echo $header_subtitle; ?></h2>
        </div>
      </div>
    </header>