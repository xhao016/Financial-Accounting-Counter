<?php

include 'connect.php';

if(isset($_GET['deleteid'])){
    $record_id = mysqli_real_escape_string($con, $_GET['deleteid']);

    // Delete patient information from the database

    
    $sql = "DELETE FROM investment_type WHERE record_id = $record_id";
    mysqli_query($con, $sql);

    
    $sql = "DELETE FROM record_account WHERE record_id = $record_id";
    $result = mysqli_query($con, $sql);
    if($result){
        header('location: salary.php?deleted=true'); // Redirect to salary.php with a parameter
    }else{
        die(mysqli_error($con));
    }
    
}

?>