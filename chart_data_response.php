<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	header('Location: register.php');
	exit();
} else if (!isset($_POST['date1'])) {
	header('Location: menu.php');
	exit();
} else {
	require_once 'database.php';
		
	$query = $db->query('SELECT name, SUM(amount) AS amount 
	FROM expenses AS e 
	INNER JOIN expenses_category_assigned_to_users AS ec 
	ON e.expense_category_assigned_to_user_id = ec.id 
	AND e.user_id = ec.user_id 
	AND ec.user_id = "'.$_SESSION['user_id'].'" 
	AND date_of_expense BETWEEN "'.$_POST['date1'].'" 
	AND "'.$_POST['date2'].'" 
	GROUP BY name 
	ORDER BY amount DESC');
	
	$expenses = $query->fetchALL();
	$rows = $query->rowCount();
	
	echo json_encode($expenses);
}
?>