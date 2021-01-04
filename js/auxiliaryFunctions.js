
function firstDayOfCurrentMonth(date) {
	return (date.getFullYear() + "-" + (date.getMonth() + 1) + "-01");
}

function lastDayOfCurrentMonth(date) {
	return (date.getFullYear() + "-" + (date.getMonth() + 1) + "-31");
}

function firstDayOfPreviousMonth(date) {
	if (date.getMonth() == 0)
		return 	((date.getFullYear() - 1) + "-12-01");
	else
		return (date.getFullYear() + "-" + date.getMonth() + "-01");
}

function lastDayOfPreviousMonth(date) {
	if (date.getMonth() == 0)
		return 	((date.getFullYear() - 1) + "-12-31");
	else
		return (date.getFullYear() + "-" + date.getMonth() + "-31");
}

function firstDayOfCurrentYear(date) {
	return (date.getFullYear() + "-01-01");
}

function lastDayOfCurrentYear(date) {
	return (date.getFullYear() + "-12-31");
}

function showBalance(date1, date2) {
	$.post("incomes_balance_response.php", {date1: date1, date2: date2},function(data) {
		$("#incomes").html(data);	
	});	
	$.post("expenses_balance_response.php", {date1: date1, date2: date2},function(data) {
		$("#expenses").html(data);
	});
}

function checkDates(date1, date2) { 
	$.post("check_date_response.php", {date: date1},function(data) {
		if (data == "true") {
			$.post("check_date_response.php", {date: date2},function(data) {
				if (data == "true" && date1 <= date2) {
					showBalance(date1, date2);
					$('#myModal').modal("hide");
				} else
					$('#date-error').text('Niepoprawna data!');
			});
		} else
			$('#date-error').text('Niepoprawna data!');
	});
}

function getTodayDate() {
	var dateObject = new Date();
				
	var day = dateObject.getDate();
	var month = dateObject.getMonth() + 1;
	var year = dateObject.getFullYear();
	
	if (day < 10)
		day = "0" + day;			
	if (month < 10)
		month = "0" + month;
				
	var fullDate = year + "-" + month + "-" + day;			
	return fullDate;
}

