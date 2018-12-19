<?php 
  require_once('../classes/admin-class.php');
	if ($_POST) {
		if ($ac->insert_post($_POST)) {
			echo 'Post added succesfully';
		}
		else {
			echo  'Error sending your post';
		} 
	}

?>
