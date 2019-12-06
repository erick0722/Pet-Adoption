<?php 
    require '../db_connection.php';

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $specialization = mysqli_real_escape_string($conn, $_POST["spec"]);
    $start_date = mysqli_real_escape_string($conn, $_POST["sd"]);
    $super_id = mysqli_real_escape_string($conn, $_POST["sid"]);
    $snum = mysqli_real_escape_string($conn, $_POST["snum"]);
    
    if ($stmt = $conn->prepare('SELECT ID FROM person WHERE ID = ?')) {

        $stmt->bind_param("i", $id);
    
        $stmt->execute();
        $result = $stmt->get_result();

        if ($stmt2 = $conn->prepare('SELECT ID FROM supervisor WHERE ID = ?')) {
            
            $stmt2->bind_param("i", $super_id);
        
            $stmt2->execute();
            $result2 = $stmt2->get_result();
    
            if($result->num_rows == 0) {
                echo "ID not found.";
            }else if($result2->num_rows ==0){
                echo "Supervisor ID not found.";
            }else {
                if ($stmt3 = $conn->prepare('INSERT INTO volunteer (ID, StartDate, Super_id) VALUES (?,?,?)')) {
                    $stmt3->bind_param("isi", $id, $start_date, $super_id);
                    $stmt3->execute();
                    if ($stmt4 = $conn->prepare('INSERT INTO specialization (ID, Specialization) VALUES (?,?)')) {
                        $stmt4->bind_param("is", $id, $specialization);
                        $stmt4->execute();
                        if ($stmt5 = $conn->prepare('INSERT INTO volunteer_at(ID,Snum) VALUES (?,?)')) {
                            $stmt5->bind_param("isi", $id, $start_date, $super_id);
                            $stmt5->execute();
                            header('Location: ../../pages/homepage.php?add=Success');
                        } 
                    }
                }
            }  
        }
    }
    header('Location: ../../pages/homepage.php?add=Failed');
    
    $conn->close();
?>
