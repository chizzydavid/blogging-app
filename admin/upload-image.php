<?php
	if (isset($_POST)) {
		$img_name = $_FILES['image']['name'];
		$img_path = '../images/' . $img_name;

		if(move_uploaded_file($_FILES['image']['tmp_name'], $img_path)) {
			echo $img_path;
		}
		else {
			echo 'Error uploading your file to the server';
		}
	} else {
		echo 'nothing to display';
	}
?>