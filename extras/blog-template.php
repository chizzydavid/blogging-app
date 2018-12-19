<?php 
  $page_title = 'The Ultimate Template Engine';
  $site_logo = 'Default Logo';
  $stylesheet = 'stylesheetsec.css';
  //$header_bg = 'assets/img/bg-masthead.jpg';
  $header_title = 'My Web Template';
  $header_subtitle = 'My route to making websites very much faster, and making a lot of f@#king money';

  require_once('templates/header-template.php');
  ?>

  <section id="" class="page-content text-center">
    <div class="container">
      <div class="row">
				<p class="col-lg-12">Page Content Goes Here!!</p>
		  </div>
		</div>
  </section>

  <section id="" class="page-content text-center">
    <div class="container">
      <div class="row">
				<p class="col-lg-12">Page Content Goes Here!!</p>
		  </div>
		</div>
  </section>

  <?php
  require_once('templates/footer-template.php');
?>