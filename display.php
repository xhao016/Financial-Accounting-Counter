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
    <table id="usersalary" class="mt-3 table table-hover text-center align-middle">
  <thead>
    <tr class="table-dark">
      <th scope="col">Record ID</th>
      <th scope="col">Necessity Account</th>
      <th scope="col">Financial Freedom</th>
      <th scope="col">Education Account</th>
      <th scope="col">Long Term Save</th>
      <th scope="col">Entertainment</th>
      <th scope="col">Give Account</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    // SQL query to select data from database
    $sql = "SELECT * FROM investment_type";
    $result = $con->query($sql);
    $con->close();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $row['record_id']; ?></td>
            <td><?php echo $row['necessity_account']; ?></td>
            <td><?php echo $row['financial_freedom']; ?></td>
            <td><?php echo $row['education_account']; ?></td>
            <td><?php echo $row['long_term_save']; ?></td>
            <td><?php echo $row['entertainment']; ?></td>
            <td><?php echo $row['give_account']; ?></td>
            <td> <!-- Action button placing area --> </td>
          </tr>
    <?php   }
    } else {
        echo "No results found";
    }
  ?>
  </tbody>
</table>
  </div>
</body>
</html>