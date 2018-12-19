<?php
	require_once('classes/blog-class.php');
	if($_GET) {
		$post_id = $_GET['p'];
		$post = $bc->get_post_data($post_id);
	  $page_title = $post['postTitle'];
	  $site_logo = 'Default Logo';
	  $stylesheet = 'blog-page.css';
	  $header_bg = $post['featuredImage'];
	  $header_title = $post['postTitle'];
	  $header_subtitle = 'Posted on ' . $post['postDate'] . ' by ' . $post['postAuthor'] ;
	  $content = $post['postContent'];

	  require_once('templates/header-template.php');

	  	echo	
	  	"<section class='blog-container' id='blog-container'>
		   $content
		 </section>
		";
	  require_once('templates/footer-template.php');	
	}
	else echo 'There is no post to display';

?>