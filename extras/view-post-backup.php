<?php
	require_once('classes/blog-class.php');
	if($_GET) {
		$post_id = $_GET['p'];
		$bc->view_post($post_id);
	} else {
		echo 'No Post to display.';
	}

?>