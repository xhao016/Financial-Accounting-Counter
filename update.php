<?php
include 'connect.php';

$record_id = $_GET['updateid'];

$sql = "SELECT * FROM record_account WHERE record_id = $record_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$month= $row['date_record'];
$salaryInput = $row['amount_income'];;


if(isset($_POST['submit'])){

     // Get record id
  $record_id= $_GET['updateid'];
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
  
  // Prepare the SQL query with placeholders to UPDATE
  $sql = "UPDATE `record_account` SET date_record = ?, amount_income = ? WHERE record_id = ?";  // added WHERE clause to update a specific row
  
  // Create a prepared statement
  $stmt = $con->prepare($sql);

  // Bind the PHP variables to the placeholders in the SQL query
  $stmt->bind_param('sdi', $month, $salaryInput, $record_id);  // added $record_id variable here

  // Execute the SQL query
  if ($stmt->execute()) {
     echo "<br><br>Record updated successfully";
  } else {
     echo "Error: " . $stmt->error;
  }

  /* Preparing and executing the second SQL query to UPDATE investment_type table */
  $sql = "UPDATE investment_type SET necessity_account = ?, financial_freedom = ?, education_account = ?, long_term_save = ?, entertainment = ?, give_account = ? 
          WHERE record_id = ?"; // added WHERE clause to update a specific row
  $stmt = $con->prepare($sql);
  $stmt->bind_param("ddddddi", $necessity, $financial, $education, $longTerm, $entertainment, $give, $investment_id); // added $investment_id variable here
  $stmt->execute() or die("Error: ".$stmt->error);

  echo "Investment records updated successfully";
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <title>Edit Details</title>
</head>
<body>

  <!-- Modal -->
  <div class="modal-body">
    <!-- Put your data table here -->

  <div class="container edit-container w-25 my-5 border border-2 rounded py-3 shadow">
    <h2 class="text-center mb-4">Edit Details</h2>
  <form id="edit-form" method="POST" action="salary.php">
    <div class="mb-3">
      <div class="mb-3">
        <input type="date" class="form-control" id="month" name="month" value="<?php echo $month ?>" required>
      </div>
      <div class="input-group ">
      <span class="input-group-text">RM</span>
      <input type="number" class="form-control" id="salary" name="salary" step="any" value="<?php echo $salaryInput ?>"required>
        <div class="invalid-feedback">
         Please input salary.
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center">
    <button type="submit" name="submit" class="btn btn-primary w-25 mt-4">Save</button>
  </div> 
  </form>
</div>
</div>
</body>
</html>