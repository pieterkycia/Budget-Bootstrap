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
		
		<style>
		.error {
		  font-size: 15px;
		  color: red;
		  margin-top: 10px;
		  margin-bottom: 10px;
		}
		</style>
	</head>	
	<body>
	
		<nav class="navbar navbar-expand-lg sticky-top shadow-lg navbar-light">
			<div class="container">
				<a class="navbar-brand" href="menu.html">
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
							<a class="nav-link active" href="balance.php"><b>Przeglądaj bilans</b></a>
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
			<div class="col-md-10 mx-auto">
				<div class="shadow-lg app-description p-3">
					<h2 class="pl-3">Przeglądanie bilansu</h2>
					<div class="row px-3 my-3">
						<div class="ml-lg-auto">
							<label for="checkDate">Wybierz okres:</label>
						</div>	
						<div class="col-6 col-lg-4 col-xl-3">
							<select id="checkDate" name="checkDate" class="form-control">
								<option value="1">Bieżący miesiąc</option>
								<option value="2">Poprzedni miesiąc</option>
								<option value="3">Bieżący rok</option>
								<option value="4" data-target="#myModal">Niestandardowy</option>
							</select>	
						</div>
					</div>

					<div class="row px-3">	
						<div class="col-lg-6">
							<fieldset class="shadow-xl rounded-xl px-3 my-3">
								<h3 class="pt-3">Przychody</h3>
								<p id="incomes" style="font-size: 15px;"></p>
							</fieldset>
						</div>
						<div class="col-lg-6">
							<fieldset class="shadow-xl rounded-xl pl-3 mt-3">
								<h3 class="pt-3">Wydatki</h3>
								<p id="expenses" style="font-size: 15px;"></p>
							</fieldset>
						</div>
					</div>	
					<div class="row my-3 pt-3">
						<img class="img-fluid d-block mx-auto" src="img/wykres-kolowy.png" alt="wykres"/>
					</div>
				</div>
			</div>
		</div>
		
			<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Tytuł okienka pop-up</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>					
					</div>
					<div class="modal-body">
						<div class="row mb-3">
							<div class="pl-3 mt-1">
								<label for="date">Data:</label>
							</div>	
							<div class="col-8">
								<input type="date" id="date1" name="date1" class="form-control"/>
							</div>
						</div>
						
						<div class="row">
							<div class="pl-3 mt-1">
								<label for="date">Data:</label>
							</div>	
							<div class="col-8">
								<input type="date" id="date2" name="date2" class="form-control"/>
							</div>
						</div>
						<div class="pl-5 error" id="date-error"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="btn-show-balance">Pokaż</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
					</div>
				</div>
			</div>
		</div>
		
		<script>
		var dateOption = $('#checkDate').val();
		var date = new Date();
		var date1 = date.getFullYear() + "-" + (date.getMonth() + 1) + "-01";
		var date2 = date.getFullYear() + "-" + (date.getMonth() + 1) + "-31";
		$.post("incomes_balance_response.php", {date1: date1, date2: date2}, function(data){
			$("#incomes").html(data);});
		$.post("expenses_balance_response.php", {date1: date1, date2: date2},function(data){
			$("#expenses").html(data);
		});
		
		$('#checkDate').change(function() {
			dateOption = $(this).val();
			switch(dateOption)
			{
				case '1': 
				
					var date1 = date.getFullYear() + "-" + (date.getMonth() + 1) + "-01";
					var date2 = date.getFullYear() + "-" + (date.getMonth() + 1) + "-31";
					$.post("incomes_balance_response.php", {date1: date1, date2: date2},function(data){
						$("#incomes").html(data);
					});	
					$.post("expenses_balance_response.php", {date1: date1, date2: date2},function(data){
						$("#expenses").html(data);
					});
					break;
					
				case '2': 
					if (date.getMonth() == 0)
					{
						var date1 = (date.getFullYear() - 1) + "-12-01";
						var date2 = (date.getFullYear() - 1) + "-12-31";
					}
					else
					{
						var date1 = date.getFullYear() + "-" + date.getMonth() + "-01";
						var date2 = date.getFullYear() + "-" + date.getMonth() + "-31";
					}
					$.post("incomes_balance_response.php", {date1: date1, date2: date2},function(data){
						$("#incomes").html(data);
					});	
					$.post("expenses_balance_response.php", {date1: date1, date2: date2},function(data){
						$("#expenses").html(data);
					});
					break;
					
				case '3': 
					var date1 = date.getFullYear() + "-01-01";
					var date2 = date.getFullYear() + "-12-31";
					$.post("incomes_balance_response.php", {date1: date1, date2: date2},function(data){
						$("#incomes").html(data);
					});	
					$.post("expenses_balance_response.php", {date1: date1, date2: date2},function(data){
						$("#expenses").html(data);
					});
					break;
					
				case '4':
					$('#myModal').modal("show");
					$('#btn-show-balance').click(function() {
						var date1 = $('#date1').val();
						var date2 = $('#date2').val();
						var checkDateFunction = true;
						if (checkDateFunction == true)
						{
							$.post("incomes_balance_response.php", {date1: date1, date2: date2}, function(data){$("#incomes").html(data);});
							$.post("expenses_balance_response.php", {date1: date1, date2: date2}, function(data){$("#expenses").html(data);});
							$('#myModal').modal("hide");
						}
						else
						$('#date-error').text('Niepoprawna data!');	
					});
					break;
			}					
		});
		</script>
	</body>
</html>