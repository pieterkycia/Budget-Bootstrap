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
				<a class="navbar-brand" href="menu.html">
					<i class="icon-money-1" style="color: green;"><strong>Budżet.pl</strong></i>
				</a>
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="menu">
					<ul class="navbar-nav pl-lg-5">
						<li class="nav-item px-2">
							<a class="nav-link" href="incomes.html"><b>Dodaj przychód</b></a>
						</li>
						<li class="nav-item px-2">
							<a class="nav-link active" href="expenses.html"><b>Dodaj wydatek</b></a>
						</li>
						<li class="nav-item px-2">
							<a class="nav-link" href="balance.html"><b>Przeglądaj bilans</b></a>
						</li>
						<li class="nav-item px-2">
							<a class="nav-link" href="settings.html"><b>Ustawienia</b></a>
						</li>
					</ul>	
					<ul class="navbar-nav ml-auto">	
						<li class="nav-item pl-2 pl-lg-0">
							<a class="nav-link" href="register.html"><b>Wyloguj się</b></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	
		<div class="container mt-5">
			<div class="col-md-10 mx-auto">
				<div class="shadow-lg app-description p-3">
					<h2 class="pl-3">Dodawanie wydatku</h2>
					<form action="menu.html">
	
						<div class="row pl-3 mt-3">
							<div class="pl-3">
								<label for="amount">Kwota:</label>
							</div>
							<div class="col-8 col-lg-5">
								<input type="number" id="amount" class="form-control" step="0.01"/>
							</div>
						</div>
							
						<div class="row pl-3 mt-3">
							<div class="pl-3">
								<label for="date">Data:</label>
							</div>	
							<div class="col-8 col-lg-5">
								<input type="date" id="date" class="form-control"/>
							</div>
						</div>
						
						<div class="px-3 mt-3">
							<fieldset class="col shadow-xl rounded-xl">
								<legend class="w-auto p-2"> Sposób płatności </legend>
								<div class="row mb-3">
									<div class="col-xl-3"><label><input type="radio" name="payment"/> Gotówka</label></div>
									<div class="col-xl-4"><label><input type="radio" name="payment"/> Karta debetowa</label></div>
									<div class="col-xl-3"><label><input type="radio" name="payment"/> Karta kredytowa</label></div>
								</div>
							</fieldset>
						</div>
						
						<div class="px-3 mt-3">
							<fieldset class="col shadow-xl rounded-xl">
								<legend class="w-auto p-2"> Kategoria </legend>
								<div class="row">
									<div class="col-lg-4">
										<div><label><input type="radio" name="category"/> Jedzenie</label></div>
										<div><label><input type="radio" name="category"/> Mieszkanie</label></div>
										<div><label><input type="radio" name="category"/> Transport</label></div>
										<div><label><input type="radio" name="category"/> Telekomunikacja</label></div>
										<div><label><input type="radio" name="category"/> Opieka zdrowotna</label></div>
										<div><label><input type="radio" name="category"/> Ubranie</label></div>
										<div><label><input type="radio" name="category"/> Higiena</label></div>
										<div><label><input type="radio" name="category"/> Dzieci</label></div>	
									</div>
									<div class="col-lg-4">
										<div><label><input type="radio" name="category"/> Rozrywka</label></div>
										<div><label><input type="radio" name="category"/> Wycieczka</label></div>
										<div><label><input type="radio" name="category"/> Szkolenia</label></div>
										<div><label><input type="radio" name="category"/> Książki</label></div>
										<div><label><input type="radio" name="category"/> Oszczędności</label></div>
										<div><label><input type="radio" name="category"/> Na emeryturę</label></div>
										<div><label><input type="radio" name="category"/> Spłata długów</label></div>
										<div><label><input type="radio" name="category"/> Darowizna</label></div>
									</div>
									<div class="col-lg-4">
										<div><label><input type="radio" name="category"/> Inne wydatki</label></div>
									</div>
								</div>
								<div class="mt-3"><label for="comment">Komentarz (opcjonalnie):</label></div> 
								<textarea class="form-control col-lg-11 rounded-xl mb-3" id="comment" rows="5"></textarea>
							</fieldset>
						</div>
						
						<div class="pl-4 mt-3">
							<input type="submit" class="btn btn-lg btn-success px-4" value="Dodaj"/>
							<input type="reset" class="btn btn-lg btn-danger" value="Wyczyść"/>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="js/insertTodayDate.js"></script>
	</body>
</html>