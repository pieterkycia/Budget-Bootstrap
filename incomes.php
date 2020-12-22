<?php
session_start();

if (!isset($_SESSION['user_id']))
{
	header('Location: register.php');
	exit();
}
else
{
	require_once 'database.php';

//**********Pobranie wszystkich kategorii przychodów**********
	$query = $db->query('SELECT id, name 
	FROM incomes_category_assigned_to_users 
	WHERE user_id = "'.$_SESSION['user_id'].'"');
	
	$categories = $query->fetchALL();
}

if (isset($_POST['amount']))
{
	require_once 'function.php';
	$is_OK = true;

//**********Sprawdzanie kwoty**********
	
	$amount = $_POST['amount'];
	if ($amount != '')
	{
		if ((is_numeric($amount)) == false)
		{
			$is_OK = false;
			$e_amount = "To nie jest liczba!";
		}
		else
		{
			if (!check_decimal_part($amount))
			{
				$is_OK = false;
				$e_amount = "Niepoprawna wartość!";
			}
		}
	}

//**********Sprawdzanie daty**********
	$income_date = $_POST['date'];
	if (check_date_format($income_date))
	{
		$full_date = explode('-', $income_date);
		$year = $full_date[0];
		$month = $full_date[1];
		$day = $full_date[2];
		
		if (!checkdate($month, $day, $year))
		{
			$is_OK = false;
			$e_date = "Niepoprawna data!";
		}
	}
	else
	{
		$is_OK = false;
		$e_date = "Niepoprawny format (yyyy-mm-dd)!";
	}

//**********Sprawdzanie radioboxa kategorii przychodów**********
	if (!isset($_POST['category']))
	{
		$is_OK = false;
		$e_category = "Wybierz jedną z opcji!";
	}

//**********Dodawanie przychodu do bazy**********
	if ($is_OK == true)
	{
		$query = $db->prepare('INSERT INTO incomes 
		VALUES (NULL, :id, :category, :amount, :date, :comment)');
		
		$query->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
		$query->bindValue(':category', $_POST['category'], PDO::PARAM_STR);
		$query->bindValue(':amount', $_POST['amount'], PDO::PARAM_STR);
		$query->bindValue(':date', $_POST['date'], PDO::PARAM_STR);
		$query->bindValue(':comment', $_POST['comment'], PDO::PARAM_STR);
		$query->execute();
		
		$add_info = true;
	}
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
				<a class="navbar-brand" href="menu.php">
					<i class="icon-money-1" style="color: green;"><strong>Budżet.pl</strong></i>
				</a>
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="menu">
					<ul class="navbar-nav pl-lg-5">
						<li class="nav-item px-2">
							<a class="nav-link active" href="incomes.php"><b>Dodaj przychód</b></a>
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

		<div class="container-fluid text-center my-2 p-2 bg-light" style="visibility:
		<?php
		if (isset($add_info))
			echo 'visible';
		else
			echo 'hidden';
		?>
		;">Dodano nowy przychód!</div>
		
		<div class="container">
			<div class="col-md-10 mx-auto">
				<div class="shadow-lg app-description p-3">
					<h2 class="pl-3">Dodawanie przychodu</h2>
					<form method="post">
	
						<div class="row pl-3 mt-3">
							<div class="pl-3">
								<label for="amount">Kwota:</label>
							</div>
							<div class="col-8 col-lg-5">
								<input type="number" id="amount" name="amount" class="form-control" step="0.01"/>
							</div>
						</div>
						<?php
						if (isset($e_amount))
						{
							echo '<div class="error ml-5 pl-5">'.$e_amount.'</div>';	
						}
						?>
						<div class="row pl-3 mt-3">
							<div class="pl-3">
								<label for="date">Data:</label>
							</div>	
							<div class="col-8 col-lg-5">
								<input type="date" id="date" name="date" class="form-control"/>
							</div>
						</div>
						<?php
						if (isset($e_date))
						{
							echo '<div class="error ml-5 pl-5">'.$e_date.'</div>';
						}
						?>		
						<div class="px-3 mt-3">
							<fieldset class="col shadow-xl rounded-xl">
								<legend class="w-auto p-2"> Kategoria </legend>
								<?php
								foreach ($categories as $category)
								{	
									echo '<div><label><input type="radio" name="category" value="'.$category['id'].'"/> '.$category['name'].'</label></div>';	
								}
								if (isset($e_category))
								{
									echo '<div class="error">'.$e_category.'</div>';
								}
								?>	
								<div class="mt-3"><label for="comment">Komentarz (opcjonalnie):</label></div> 
								<textarea class="form-control col-lg-11 rounded-xl mb-3" id="comment" name="comment" rows="5"></textarea>
							</fieldset>
						</div>
						
						<div class="pl-3 mt-3">
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