<?php

include 'connect.php';

if(isset($_POST['submit'])){

  $month = $_POST['month'];
  $salaryInput = $_POST['salary'];
  
  /* Processing your input */
  $salary = number_format((float)$salaryInput, 2, '.', '');
  $necessity = number_format($salary * 0.55, 2, '.', '');
  $financial = number_format($salary * 0.1, 2, '.', '');
  $education = number_format($salary * 0.1, 2, '.', '');
  $longTerm = number_format($salary * 0.1, 2, '.', '');
  $entertainment = number_format($salary * 0.1, 2, '.', '');
  $give = number_format($salary * 0.05, 2, '.', '');
  
 // Prepare the SQL query with placeholders
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
  $stmt->execute() or die("Error: ".$stmt->error);

  echo "Investment records created successfully";
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


  <form class="container index-container my-5 requires-validation" action="salary.php" method="post" id="register_form" novalidate>
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
        <input type="number" class="form-control " id="salary" name="salary" step="any" required>
          <div class="invalid-feedback">
           Please input salary.
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

</body>
</html>