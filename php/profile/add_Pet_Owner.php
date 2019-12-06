<?php 
    require '../db_connection.php';

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $pet_id = mysqli_real_escape_string($conn, $_POST["pid"]);
    
    if ($stmt = $conn->prepare('SELECT ID FROM person WHERE ID = ?')) {
            
        $stmt->bind_param("i", $id);
    
        $stmt->execute();
        $result = $stmt->get_result();

        if ($stmt2 = $conn->prepare('SELECT Pet_id FROM pet WHERE Pet_id = ?')) {
            
            $stmt2->bind_param("i", $pet_id);
        
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if($result->num_rows == 0) {
                echo "ID not found.";
            } else if($result2->num_rows == 0){
                echo "Pet ID not found.";
            } else {
                if ($stmt3 = $conn->prepare('INSERT INTO pet_owner (ID, Pet_id) VALUES (?,?)')) {
                    
                    $stmt3->bind_param("ii", $id, $pet_id);
                
                    $stmt3->execute();
                    if ($stmt4 = $conn->prepare('UPDATE pet SET Owner_id = $id WHERE Pet_id = ?')) {
                    
                        $stmt4->bind_param("i", $pet_id);
                    
                        $stmt4->execute();
                    }
                }
            }
        }
    }
    header('Location: ../../pages/homepage.php');
    $conn->close();
    ?>

