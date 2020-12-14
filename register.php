<?php
session_start();

if (isset($_POST['name']))
{
	$is_OK = true;
	
//**************************************************		
	//Sprawdź poprawność imienia
	$name = $_POST['name'];
	$name = ucwords($name);
	if (ctype_alpha($name) == false)
	{
		$is_OK = false;
		$_SESSION['e_name'] = "Imię może składać się tylko z liter!";
	}
	if (strlen($name) < 3)
	{
		$is_OK = false;
		$_SESSION['e_name'] = "Imię musi posiadać co najmniej 3 znaki!";
	}
	
//**************************************************		
	//Sprawdź poprawność emaila
	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if ((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $email))
	{
		$is_OK = false;
		$_SESSION['e_email'] = "Podaj poprawny adres e-mail!";
	}

//**************************************************		
	//Sprawdź poprawność hasła	
	$password = $_POST['password'];
	$password_2 = $_POST['repeat_password'];
	if (strlen($password) < 8)
	{
		$is_OK = false;
		$_SESSION['e_password'] = "Hasło musi zawierać co najmniej 8 znaków!";
	}
	if ($password != $password_2)
	{
		$is_OK = false;
		$_SESSION['e_password'] = "Oba hasła muszą być identyczne!";
	}
	
//**************************************************		
	//Nawiązanie połączenia z bazą i pobranie emaili	
	
	if ($is_OK == true)
	{
		require_once 'database.php';
		
		$query = $db->query('SELECT email FROM users');
		$users = $query->fetchAll();
		
		foreach($users as $emails)
		{	
			if ($emails['email'] == $email)
			{
				$is_OK = false;
				$_SESSION['e_email'] = "Podany adres email już istnieje!";
			}
		}
				
	//Dodawanie nowego uzytkownika do bazy		
		if ($is_OK == true)
		{
			$query = $db->prepare('INSERT INTO users VALUES (NULL, :name, :password, :email)');
			$query->bindValue(':name', $name, PDO::PARAM_STR);
			$query->bindValue(':password', $password, PDO::PARAM_STR);
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->execute();
			
	//Pobieranie id zarejestrowanego użytkownika		
			$register_id_query = $db->query('SELECT id FROM users WHERE email = "'.$email.'"');
			$register_id = $register_id_query->fetch(PDO::FETCH_ASSOC);
	
	//Dodawanie domyślnych kategorii przychodów
			$incomes_query = $db->query('SELECT name FROM incomes_category_default');
			$incomes = $incomes_query->fetchALL();
			
			foreach($incomes as $category)
			{	
				$query = $db->query('INSERT INTO incomes_category_assigned_to_users VALUES (NULL, '.$register_id['id'].', "'.$category['name'].'")');
			}
			
	//Dodawanie domyślnych kategorii wydatków
			$expenses_query = $db->query('SELECT name FROM expenses_category_default');
			$expenses = $expenses_query->fetchALL();
			
			foreach($expenses as $category)
			{	
				$query = $db->query('INSERT INTO expenses_category_assigned_to_users VALUES (NULL, '.$register_id['id'].', "'.$category['name'].'")');
			}
			
	//Dodawanie domyślnych kategorii płatności
			$payment_query = $db->query('SELECT name FROM payment_methods_default');
			$payment = $payment_query->fetchALL();
			
			foreach($payment as $category)
			{	
				$query = $db->query('INSERT INTO payment_methods_assigned_to_users VALUES (NULL, '.$register_id['id'].', "'.$category['name'].'")');
			}
		}
	}
}


?>

<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<title>Budżet osobisty</title>
		<meta charset="utf-8"/>
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
				<a class="navbar-brand" href="register.html">
					<i class="icon-money-1" style="color: green;"><strong>Budżet.pl</strong></i>
				</a>
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="menu">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link active" href="register.html"><b>Rejestracja</b></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="login.html"><b>Logowanie</b></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	
		<div class="container mt-5">
			<div class="row">
				<div class="col-md-7 col-lg-8">
					<div class="shadow-lg app-description p-3">
						<h1 class="mt-4">Kilka słów o aplikacji</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sed sagittis ligula. Aenean fermentum quam eu fringilla vehicula. Quisque ac arcu faucibus, scelerisque felis vel, sollicitudin tellus. Morbi nulla nibh, pretium non accumsan quis, rhoncus at nisl. Vestibulum nec iaculis orci. Sed tincidunt purus in turpis iaculis, eget porttitor mi viverra. Nulla elementum elit a placerat dictum. Aliquam vehicula tellus ac neque elementum, eu ornare erat auctor. Nulla fermentum dictum metus.</p>
					</div>
				</div>
				
				<div class="col-md-5 col-lg-4 mt-3 mt-md-0">
					<div class="shadow-lg app-description pb-4">
						<h2 class="text-center">Zarejestruj się!</h2>
						<form method="post">
							<div class="form-group mt-4">
								<label for="name" class="sr-only">Name</label>
								<input type="text" id="name" name="name" class="form-control" placeholder="Imię"/>
							</div>
							<?php
							if (isset($_SESSION['e_name']))
							{
								echo '<div class="error">'.$_SESSION['e_name'].'</div>';
								unset($_SESSION['e_name']);
							}
							?>
							<div class="form-group">
								<label for="email" class="sr-only">Email</label>
								<input type="email" id="email" name="email" class="form-control" placeholder="E-mail"/>
							</div>
							<?php
							if (isset($_SESSION['e_email']))
							{
								echo '<div class="error">'.$_SESSION['e_email'].'</div>';
								unset($_SESSION['e_email']);
							}
							?>
							<div class="form-group">
								<label for="password" class="sr-only">Password</label>
								<input type="password" id="password" name="password" class="form-control" placeholder="Hasło"/>
							</div>
							<?php
							if (isset($_SESSION['e_password']))
							{
								echo '<div class="error">'.$_SESSION['e_password'].'</div>';
								unset($_SESSION['e_password']);
							}
							?>
							<div class="form-group">
								<label for="repeat-password" class="sr-only">Password</label>
								<input type="password" id="repeat_password" name="repeat_password" class="form-control" placeholder="Powtórz hasło"/>
							</div>
							<div class="text-center">
								<input type="submit" class="btn btn-success" value="Zarejestruj"/>
								<input type="reset" class="btn btn-danger" value="Wyczyść"/>
							</div>
							<div class="text-center">
								<a href="login.html" class="btn btn-primary mt-3 px-5">Logowanie</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>