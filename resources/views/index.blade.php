<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Card Distribution</title>
</head>
<body>
<h1>Card Distribution</h1>
<label for="numPeople">Number of People:</label>
<input type="number" id="numPeople" min="1">
<button onclick="distributeCards()">Distribute Cards</button>
<div id="output"></div>

<script>
function distributeCards() {
    var numPeople = document.getElementById("numPeople").value;
    var outputDiv = document.getElementById("output");

    // Check if the input value is valid
    if (numPeople < 1) {
        outputDiv.textContent = "Input value does not exist or value is invalid";
        return;
    }

    // Fetch data from backend PHP script
    fetch("http://localhost:80/api/distribute-cards?num_people=" + numPeople)
    .then(response => response.text())
    .then(data => {
        outputDiv.textContent = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
</body>
</html>
