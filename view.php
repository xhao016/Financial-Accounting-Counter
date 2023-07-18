<?php

include 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>
  <div class="container display-container my-5 border border-2 px-4 rounded py-3 shadow">
    <h2 class="text-center mb-4">Account List</h2>
    <div class="d-flex align-items-center gap-2">
      
      <button class="btn btn-primary" onclick="window.location.href = 'salary.php'"><< Back</button>
      <button class="btn btn-primary ms-auto print">Print</button>
      </div>
    <table id="usersalary" class="mt-3 table table-hover align-middle">
  <thead>
    <tr class="table-dark">
      <th scope="col">Accounts</th>
      <th scope="col">Amount (RM)</th>
    </tr>
  </thead>
  <tbody>

  <?php

  
$record_id = $_GET['viewid'];


$stmt = $con->prepare("SELECT * FROM investment_type WHERE record_id = ?");

// Bind the record_id parameter to the statement
$stmt->bind_param("i", $record_id);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    // Create array of categories and respective amounts
    $categories = [
        ['name' => 'Necessity (55%)', 'value' => $row["necessity_account"]],
        ['name' => 'Financial (10%)', 'value' => $row["financial_freedom"]],
        ['name' => 'Education (10%)', 'value' => $row["education_account"]],
        ['name' => 'Long Term (10%)', 'value' => $row["long_term_save"]],
        ['name' => 'Entertainment (10%)', 'value' => $row["entertainment"]],
        ['name' => 'Give (5%)', 'value' => $row["give_account"]]
    ];
  
    // Loop through the categories and add them to the table
    foreach ($categories as $index => $category) {
        // Tr class
      //  $trClass = ($index === 0) ? 'table-dark fw-bold' : '';
        echo  "<tr>
                   <th>{$category['name']}</th>
                   <td>{$category['value']}</td>
               </tr>";
    }
  }
}

// Close connection
$con->close();
  ?>
  
  </tbody>
</table>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
 <script>

//Print 
$(document).ready(function() {
  $('.print').click(function() {
    window.print();
  });
});

  </script>
</body>
</html>