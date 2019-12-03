<?php 
    require '../db_connection.php';

    $id = test_input($_POST["id"]);
    $salary = test_input($_POST["salary"]);
    
    $result = $conn->query("SELECT ID FROM person WHERE ID = $id");

    if($result->num_rows == 0) {
        echo "ID not found.";
    }else {
        $sql = "INSERT INTO supervisor (ID, Salary) 
        VALUES ('$id', '$salary')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header('Location: ../../pages/homepage.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    $conn->close();
    ?>

