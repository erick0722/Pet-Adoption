<?php 
    require '../db_connection.php';

    $id = test_input($_POST["id"]);
    $specialization = test_input($_POST["spec"]);
    $start_date = test_input($_POST["sd"]);
    $super_id = test_input($_POST["sid"]);

    $result = $conn->query("SELECT ID FROM person WHERE ID = $id");
    $result2 = $conn->query("SELECT ID FROM supervisor WHERE ID = $super_id");
    if($result->num_rows == 0) {
        echo "ID not found.";
    }else if($result2->num_rows ==0){
        echo "Supervisor ID not found.";
    }else {
        $sql = "INSERT INTO volunteer (ID, StartDate, Super_id) 
        VALUES ('$id', '$start_date' ,'$super_id')";

        $sql2 = "INSERT INTO specialization (ID, Specialization)
        VALUES ('$id', '$specialization')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header('Location: ../../pages/homepage.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if ($conn->query($sql2) === TRUE) {
            echo "New record created successfully";
            header('Location: ../../pages/homepage.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    $conn->close();
    ?>
