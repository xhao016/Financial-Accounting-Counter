<?php

include 'connect.php';

if(isset($_POST['submit'])){

  $month = $_POST['month'];
  $salaryInput = $_POST['salary'];
  $record_id = $_POST['record_id'];
  
  /* Processing your input */
  $salary = number_format((float)$salaryInput, 2, '.', '');
  $necessity = number_format($salary * 0.55, 2, '.', '');
  $financial = number_format($salary * 0.1, 2, '.', '');
  $education = number_format($salary * 0.1, 2, '.', '');
  $longTerm = number_format($salary * 0.1, 2, '.', '');
  $entertainment = number_format($salary * 0.1, 2, '.', '');
  $give = number_format($salary * 0.05, 2, '.', '');
  
 // Prepare the SQL query with placeholders, it will be more safe and prevent SQL injection
 $sql = "INSERT INTO `record_account` (date_record, amount_income) VALUES (?, ?)";
  
 // Create a prepared statement
 $stmt = $con->prepare($sql);

 // Bind the PHP variables to the placeholders in the SQL query
 $stmt->bind_param('sd', $month, $salaryInput);

 // Execute the SQL query
 if ($stmt->execute()) {
   $last_id = $con->insert_id;
   echo "<br><br>New record created successfully. Last inserted ID is: " . $last_id;
 } else {
   echo "Error: " . $stmt->error;
 }


  /* Retrieving the last inserted ID */
  $record_id = $con->insert_id;

  /* Preparing and executing the second SQL query */
  $sql = "INSERT INTO investment_type (record_id, necessity_account, financial_freedom, education_account, long_term_save, entertainment, give_account) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("idddddd", $record_id, $necessity, $financial, $education, $longTerm, $entertainment, $give);
  if ($stmt->execute()) {
    
    echo "Investment records created successfully";
    header('Location: salary.php');
    exit();
 } else {
    echo "Error: " . $stmt->error;
 }

 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <title>Calculate Financial</title>
</head>
<body>


  <form class="container index-container my-5 needs-validation" method="post" id="register_form" novalidate>
    <h1 class="text-center mb-5"> Calculate Financial</h1>
    <div class="mb-3">
      <label for="month" class="form-label " >Date</label>
      <input type="date" class="form-control " id="month" name="month" required>
      <div class="invalid-feedback">
        Please select date.
      </div>
    </div>

    <div class="mb-3">
        <label for="salary" class="form-label" >Salary</label>
        <div class="input-group">
        <span class="input-group-text">RM</span>
        <input type="number" class="form-control " id="salary" name="salary" step="any" maxlength="6" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
          <div class="invalid-feedback">
           Please input salary less than 100000.
          </div>
        </div>
      </div>
    

<div class="button-container d-flex justify-content-center ">
  <button type="submit" class="btn btn-primary w-100 mt-3" name="submit" id="submit">Calculate</button>
  <button type="button" class="btn btn-primary w-100 mt-3" id="reset">Reset</button>
</div>

</form>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="index.js"></script>
  <script>

// Disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

const resetButton = document.querySelector('#reset');
 const inputFields = document.querySelectorAll('input');

 resetButton.addEventListener('click', () => {
 inputFields.forEach((input) => {
     input.value = '';
 });
 });

//Display Only Date till today //

var dtToday = new Date();
var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
var day = dtToday.getDate();
var year = dtToday.getFullYear();
if(month < 10)
   month = '0' + month.toString();
if(day < 10)
   day = '0' + day.toString();

var maxDate = year + '-' + month + '-' + day;
$('#month').attr('max', maxDate);
</script>


</body>
</html>