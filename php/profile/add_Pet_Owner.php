<?php 
    require '../db_connection.php';

    $id = test_input($_POST["id"]);
    $pet_id = test_input($_POST["pid"]);
    
    $result = $conn->query("SELECT ID FROM person WHERE ID = $id");
    $result2 = $conn->query("SELECT Pet_id FROM pet WHERE Pet_id = $pet_id");

    if($result->num_rows == 0) {
        echo "ID not found.";
    } else if($result2->num_rows == 0){
        echo "Pet ID not found.";
    } else {
        $sql = "INSERT INTO pet_owner (ID, Pet_id) 
        VALUES ('$id', '$pet_id')";

        $sql2 = "UPDATE pet SET Owner_id = $id WHERE Pet_id = $pet_id";

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

