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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

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

<table id="salary" class=" mt-3 table table-hover text-center align-middle">
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
            <a href="view.php?viewid=<?php echo $row['record_id']; ?>" class="btn btn-success view-button">View</a>
            <a href="update.php?updateid=<?php echo $row['record_id']; ?>" class="btn btn-primary edit-button">Edit</a>
            <button class="btn btn-danger delete-button" id="delete" data-deleteid="<?php echo $row['record_id']; ?>">Delete</button>
            <!-- <a href="delete.php?deleteid=<?php echo $row['record_id']; ?>" class="btn btn-danger delete-button">Delete</a> -->
            </td>
          </tr>
    <?php   }
    } else {
        echo '<p class="text-center mt-2"> Data is empty.</p>';
    }
  ?>
  </tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.min.css
" rel="stylesheet">
<script>

//Print 
$(document).ready(function() {
  $('.print').click(function() {
    window.print();
  });
  

  $('#delete').on('click', function () {

    var el = event.target || event.srcElement;
    var deleteid = el.getAttribute('data-deleteid');

    //custom delete confirmation
    //  stack ref: https://stackoverflow.com/questions/72284633/how-to-send-custom-value-to-sweetalert-javascript-code-from-php
Swal.fire({
// title: 'Are you sure?',
showClass: {
    popup: 'animate__animated animate__fadeIn animate__faster'
  },
  hideClass: {
    popup: 'animate__animated animate__fadeOut animate__faster'
  },
text: "Delete this record?",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href = "delete.php?deleteid=" + deleteid;
}
})
});


});




// Get the input element
var input = document.getElementById('search');

// Add an event listener to the input element
input.addEventListener('input', function() {
  // Get the table rows
  var rows = document.querySelectorAll('#salary tbody tr');

  // Get the search term
  var searchTerm = input.value.toLowerCase();

  // Loop through the rows and hide/show them based on the search term
  rows.forEach(function(row) {
    var cells = row.querySelectorAll('td');
    var match = false;
    cells.forEach(function(cell) {
      if (cell.textContent.toLowerCase().indexOf(searchTerm) > -1) {
        match = true;
      }
    });
    if (match) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});
</script>
</body>
</html>