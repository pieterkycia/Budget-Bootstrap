<?php
session_start();

if (!isset($_SESSION['user_id'])) {
	header('Location: register.php');
	exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<title>Budżet osobisty</title>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="description" content="budżet osobisty, zarządzanie finansami"/>
		<meta name="keywords" content="budżet, finanse, wydatki, planowanie"/>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
		<script src="js/auxiliaryFunctions.js"></script>
		
		<link href = "css/main.css" rel = "stylesheet" type = "text/css"/>
		<link href = "css/fontello.css" rel = "stylesheet" type = "text/css"/>
	</head>	
	<body>
	
		<nav class="navbar navbar-expand-lg sticky-top shadow-lg navbar-light">
			<div class="container">
				<a class="navbar-brand" href="menu.php">
					<i class="icon-money-1" style="color: green;"><strong>Budżet.pl</strong></i>
				</a>
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="menu">
					<ul class="navbar-nav pl-lg-5">
						<li class="nav-item px-2">
							<a class="nav-link" href="incomes.php"><b>Dodaj przychód</b></a>
						</li>
						<li class="nav-item px-2">
							<a class="nav-link" href="expenses.php"><b>Dodaj wydatek</b></a>
						</li>
						<li class="nav-item px-2">
							<a class="nav-link" href="balance.php"><b>Przeglądaj bilans</b></a>
						</li>
						<li class="nav-item px-2">
							<a class="nav-link" href="settings.php"><b>Ustawienia</b></a>
						</li>
					</ul>	
					<ul class="navbar-nav ml-auto">	
						<li class="nav-item pl-2 pl-lg-0">
							<a class="nav-link" href="logout.php"><b>Wyloguj się</b></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	
		<div class="container mt-5">
			<div class="row">
				<div class="col-lg-10 mx-auto">
					<div class="shadow-lg app-description p-3">
						<h2 class="text-center">Przegląd wydatków z tego miesiąca</h2>
						<div class="row">
							<div class="col-10 col-lg-8 mx-auto">
								<fieldset class="shadow-xl rounded-xl pl-3 mt-3">
									<h3 class="pt-3">Wydatki</h3>
									<p id="expenses" style="font-size: 15px;"></p>
								</fieldset>
							</div>
						</div>
						<div class="row">
							<div class="col mt-3" id="chart-parent">
								<canvas id="chart" width="200" height="100"></canvas>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
		<script>
			var date = new Date();
			$.post("expenses_balance_response.php", 
			{date1: firstDayOfCurrentMonth(date), date2: lastDayOfCurrentMonth(date)},function(data) {
				$("#expenses").html(data);
				showChart(firstDayOfCurrentMonth(date), lastDayOfCurrentMonth(date));
			});
		</script>
	</body>
</html>