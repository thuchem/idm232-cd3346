// get the value and submit form on Change
function submitForm() {
    var fromCaloriesValue = document.getElementById("fromCalories").value;
    var toCaloriesValue = document.getElementById("toCalories").value;

    document.getElementById("caloriesForm").action = "index.php?fromCalories=" + fromCaloriesValue + "&toCalories=" + toCaloriesValue;

    // Submit the form
    document.getElementById("caloriesForm").submit();
}

function clearForm() {
    document.getElementById('toCalories').value= '';
    document.getElementById('fromCalories').value ='';
    submitForm();
}

function surpriseMe() {
    var randomToken = Math.random().toString(36).substr(2, 9);
    var url = 'index.php?filter=surprise&token=' + randomToken;
    window.location.href = url;
}


