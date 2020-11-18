
let dateObject = new Date();
			
let day = dateObject.getDate();
let month = dateObject.getMonth() + 1;
let year = dateObject.getFullYear();
let fullDate = "";
	
			
if (day < 10)
	day = "0" + day;
			
if (month < 10)
	month = "0" + month;
			
fullDate = year + "-" + month + "-" + day;
			
let inputDate = document.getElementById("date");
inputDate.value = fullDate;