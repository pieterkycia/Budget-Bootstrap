<?php
//**********Funkcja sprawdzająca ilość miejsc po przecinku**********	
function check_decimal_part($number) {
	$decimal_part = round(($number - floor($number)), 3) * 100;
	if ((strlen($decimal_part) > 2))
		return false;
	else
		return true;
}

//**********Funkcja sprawdzająca format daty**********
function check_date_format($date) {
	if (preg_match('/^[1-9]{1}[0-9]{3}-[0-9]{1,2}-[0-9]{1,2}$/', $date))
		return true;
	else
		return false;
}

?>