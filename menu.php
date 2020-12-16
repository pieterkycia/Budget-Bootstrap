<?php
session_start();

if (!isset($_SESSION['user_id']))
{
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
						<h2>Ogólny przegląd wydatków z wykresem</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed sagittis ligula. Aenean fermentum quam eu fringilla vehicula. Quisque ac arcu faucibus, scelerisque felis vel, sollicitudin tellus. Morbi nulla nibh, pretium non accumsan quis, rhoncus at nisl. Vestibulum nec iaculis orci. Sed tincidunt purus in turpis iaculis, eget porttitor mi viverra. Nulla elementum elit a placerat dictum. Aliquam vehicula tellus ac neque elementum, eu ornare erat auctor. Nulla fermentum dictum metus.</p>
						
						<div class="row my-5">
							<img class="img-fluid d-block mx-auto" src="img/wykres-kolowy.png" alt="wykres"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>