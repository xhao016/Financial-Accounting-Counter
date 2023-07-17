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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    

</head>

<body>
  <style>

  </style>
  <div class="container salary-container my-5 border border-2 px-4 rounded py-3 shadow">
    <h2 class="text-center mb-4">Salary List</h2>
    <div class="d-flex align-items-center gap-2">
<button class="btn btn-primary" onclick="window.location.href = 'index.php'">Calculate</button>
<input type="text" name="search_box" id="search" class="form-control" placeholder="Search date..." onfocus="this.value=''" >
<button class="btn btn-primary ms-auto print">Print</button>

</div>

<table id="usersalary" class=" mt-3 table table-hover text-center align-middle">
  <thead>
    <tr class="table-dark">
      <th scope="col" >Date</th>
      <th scope="col">Salary</th>
      <th scope="col" >Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    // SQL query to select data from database
    $sql = "SELECT * FROM record_account";
    $result = $con->query($sql);
    $con->close();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $row['date_record']; ?></td>
            <td><?php echo $row['amount_income']; ?></td>
            <td>
            <a href="view.php?view_id=<?php echo $row['record_id']; ?>" class="btn btn-success view-button">View</a>
            <a href="update.php?updateid=<?php echo $row['record_id']; ?>" class="btn btn-primary edit-button">Edit</a>
            <a href="delete.php?deleteid=<?php echo $row['record_id']; ?>" class="btn btn-danger delete-button">Delete</a>
            </td>
          </tr>
    <?php   }
    } else {
        echo "No results found";
    }
  ?>
  </tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>

</script>
</body>
</html>