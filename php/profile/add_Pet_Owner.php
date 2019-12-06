<?php 
    require '../db_connection.php';

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $pet_id = mysqli_real_escape_string($conn, $_POST["pid"]);
    $adopt_date = mysqli_real_escape_string($conn, $_POST["ad"]);
    
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
                $sql = "SELECT * FROM person WHERE ID = $id";
                $result = $conn->query($sql);
                if($result->num_rows != 0)
                {
                    if ($stmt3 = $conn->prepare('INSERT INTO pet_owner (ID, Pet_id) VALUES (?,?)')) {

                        $stmt3->bind_param("ii", $id, $pet_id);
                    
                        $stmt3->execute();
                        if ($stmt4 = $conn->prepare('UPDATE pet SET Owner_id = ? WHERE Pet_id = ?')) {
                        
                            $stmt4->bind_param("ii", $id, $pet_id);
                        
                            $stmt4->execute();
                            if ($stmt5 = $conn->prepare('UPDATE pet SET Adopt_date = ? WHERE Pet_id = ?')) {
                        
                                $stmt5->bind_param("si", $adopt_date, $pet_id);
                            
                                $stmt5->execute();
                            }
                        }
                    }
                }   
            }
        }
    }
    header('Location: ../../pages/profile/allPetOwner.php');
    $conn->close();
    ?>

