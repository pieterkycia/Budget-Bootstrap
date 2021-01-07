
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

function createChart(chartLabels, chartValues) {
	new Chart($('#chart'), {
		type: 'pie',
		data: {
			labels: chartLabels,
			datasets: [{
				data: chartValues,
				backgroundColor: [
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)',
					'rgba(255, 206, 86, 0.5)',
					'rgba(75, 192, 192, 0.5)',
					'rgba(153, 102, 255, 0.5)',
					'rgba(255, 159, 64, 0.5)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			title: {
				display: true,
				text: 'Twoje wydatki',
				fontSize: 20
			}
		}
	});	
}

function showChart(date1, date2) {
	$.post("chart_data_response.php", {date1: date1, date2: date2},function(data) {
		var chartData = JSON.parse(data);
		var chartLabels = [];
		var chartValues = [];
		
		for (i in chartData) {
			chartLabels.push(chartData[i].name);
			chartValues.push(chartData[i].amount);
		}
		$('#chart').remove();
		$('#chart-parent').append('<canvas id="chart" width="200" height="80"></canvas>');
		if (chartData.length <= 0) {
			chartLabels.push('Brak wydatków');
			chartValues.push('100');
		}
		createChart(chartLabels, chartValues);
	});
}

function showBalance(date1, date2) {
	$.post("incomes_balance_response.php", {date1: date1, date2: date2},function(data) {
		$("#incomes").html(data);	
	});	
	$.post("expenses_balance_response.php", {date1: date1, date2: date2},function(data) {
		$("#expenses").html(data);
	});
	showChart(date1, date2);
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

