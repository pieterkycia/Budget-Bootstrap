
function firstDayOfCurrentMonth(date)
{
	return (date.getFullYear() + "-" + (date.getMonth() + 1) + "-01");
}

function lastDayOfCurrentMonth(date)
{
	return (date.getFullYear() + "-" + (date.getMonth() + 1) + "-31");
}

function firstDayOfPreviousMonth(date)
{
	if (date.getMonth() == 0)
		return 	((date.getFullYear() - 1) + "-12-01");
	else
		return (date.getFullYear() + "-" + date.getMonth() + "-01");
}

function lastDayOfPreviousMonth(date)
{
	if (date.getMonth() == 0)
		return 	((date.getFullYear() - 1) + "-12-31");
	else
		return (date.getFullYear() + "-" + date.getMonth() + "-31");
}

function firstDayOfCurrentYear(date)
{
	return (date.getFullYear() + "-01-01");
}

function lastDayOfCurrentYear(date)
{
	return (date.getFullYear() + "-12-31");
}

function showBalance(date1, date2)
{
	$.post("incomes_balance_response.php", {date1: date1, date2: date2},function(data){
		$("#incomes").html(data);
	});	
	$.post("expenses_balance_response.php", {date1: date1, date2: date2},function(data){
		$("#expenses").html(data);
	});
}

function checkDateFormat(date)
{
	if ((date.length >= 8) && (date.length <= 10))
	{
		var fullYear = date.split("-");
		
		if (fullYear.length == 3)
		{	
			var year = parseInt(fullYear[0]);
			var month = parseInt(fullYear[1]);
			var day = parseInt(fullYear[2]);
			
			if ((!Number.isInteger(year)) || (!Number.isInteger(month)) || (!Number.isInteger(day)))
				return false;
			else
				return true;
		}
		else 
			return false;
	}
	else
		return false;
}
