// get the value and submit form on Change
function submitForm() {
    document.getElementById("caloriesForm").submit();
    console.log("submit");
}

function clearForm() {
    document.getElementById('toCalories').value= '';
    document.getElementById('fromCalories').value ='';
    submitForm(); // Optionally, you can submit the form after resetting to update the search results.
}

function surpriseMe() {
    var randomToken = Math.random().toString(36).substr(2, 9);
    var url = 'index.php?filter=surprise&token=' + randomToken;
    window.location.href = url;
}