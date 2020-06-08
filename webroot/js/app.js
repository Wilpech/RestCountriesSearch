//Write your javascript here, or roll your own. It's up to you.
//Make your ajax call to http://localhost:8765/api/index.php here

function countryTransfer() {
	document.getElementById("input").display = 'none';
	var data = document.getElementbyId("input").value;
	
	//once submission has cleared, we will assemble the table on
	//the server side and pass it into the index.html page
	if(data != "") {
		var request = new XMLHttpRequest();
		request.open("GET", "http://localhost:8765/api/index.php?function=searchAPI&input=" + data, false);
		request.send();
		document.getElementById("countriesTable").innerHTML = request.responseText;
	}
	else {
		window.alert("Your search has no input, please try again with search values entered.")
	}
}