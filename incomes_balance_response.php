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
	FROM incomes AS i
	INNER JOIN incomes_category_assigned_to_users AS ic
	ON i.income_category_assigned_to_user_id = ic.id 
	AND i.user_id = ic.user_id 
	AND ic.user_id = "'.$_SESSION['user_id'].'" 
	AND date_of_income BETWEEN "'.$_POST['date1'].'" 
	AND "'.$_POST['date2'].'" 
	GROUP BY name 
	ORDER BY amount DESC');
	
	$incomes = $query->fetchALL();
	$rows = $query->rowCount();
	$_SESSION['incomesSum'] = 0;
	if ($rows == 0)
		echo "Brak przychodów!";
	else {
		echo <<<EN
		<table class="table table-striped table-bordered">
			<thead>
			  <tr>
				<th>Income</th>
				<th>Amount</th>
			  </tr>
			</thead>
			<tbody>
EN;
		foreach($incomes as $income) {
			echo <<<EN
			  <tr>
				<td>{$income['name']}</td>
				<td>{$income['amount']}</td>
			  </tr>
EN;
			$_SESSION['incomesSum'] += $income['amount'];
		}
		echo <<<EN
			</tbody>
		  </table>
		  <b>Suma przychodów: {$_SESSION['incomesSum']}</b>
EN;
	}
}
?>