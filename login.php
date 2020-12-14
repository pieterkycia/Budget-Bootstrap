<?php
session_start();

if (isset($_SESSION['user_id']))
{
	header ('Location: menu.php');
	exit();
}

if (isset($_POST['email']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	require_once 'database.php';
	
	//Pobieranie danych z bazy do weryfikacji
	$query = $db->query('SELECT id, email, password FROM users');
	$users = $query->fetchALL();
	
	foreach ($users as $user)
	{
		if (($user['email'] == $email) && ($user['password'] == $password))
		{
			$_SESSION['user_id'] = $user['id'];
			header ('Location: menu.php');
			exit();
		}
	}
	$_SESSION['e_login'] = "Niepoprawny email lub hasło!";
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
	
		<nav class="navbar navbar-expand-sm sticky-top shadow-lg navbar-light">
			<div class="container">
				<a class="navbar-brand" href="register.php">
					<i class="icon-money-1" style="color: green;"><strong>Budżet.pl</strong></i>
				</a>
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="menu">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="register.php"><b>Rejestracja</b></a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="login.php"><b>Logowanie</b></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	
		<div class="container mt-5">
			<div class="row">
				<div class="col-md-8 col-lg-6 mt-3 mx-auto">
					<div class="shadow-lg app-description pb-4">
						<h2 class="text-center">Logowanie!</h2>
						<form method="post">
							<div class="form-group mt-4">
								<label for="email" class="sr-only">Email</label>
								<input type="email" id="email" name="email" class="form-control" placeholder="E-mail"/>
							</div>
							<div class="form-group">
								<label for="password" class="sr-only">Password</label>
								<input type="password" id="password" name="password" class="form-control" placeholder="Hasło"/>
							</div>
							<?php
							if (isset($_SESSION['e_login']))
							{
								echo '<div class="error">'.$_SESSION['e_login'].'</div>';
								unset ($_SESSION['e_login']);
							}
							?>
							<div class="text-center mt-4">
								<input type="submit" class="btn btn-success" value="Zaloguj się"/>
								<input type="reset" class="btn btn-danger" value="Wyczyść"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>