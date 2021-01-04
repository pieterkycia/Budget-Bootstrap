<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	header('Location: register.php');
	exit();
} else if (!isset($_POST['date'])) {
	header('Location: menu.php');
	exit();
} else {
	require_once 'auxiliaryFunctions.php';
	
	if (check_date_format($_POST['date'])) {
		$full_date = explode('-', $_POST['date']);
		$year = $full_date[0];
		$month = $full_date[1];
		$day = $full_date[2];
		if (checkdate($month, $day, $year))
			echo "true";
		else
			echo "false";
	} else
		echo "false";
}
?>