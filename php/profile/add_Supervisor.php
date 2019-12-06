<?php 
    require '../db_connection.php';

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $salary = mysqli_real_escape_string($conn, $_POST["salary"]);
    
    if ($stmt = $conn->prepare('SELECT ID FROM person WHERE ID = ?')) {

        $stmt->bind_param("i", $id);
    
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 0) {
            echo "ID not found.";
        }else{
            if($stmt2 = $conn->prepare('INSERT INTO supervisor (ID, Salary) VALUES (?, ?)')){
                $stmt2->bind_param("ii", $id, $salary);
                $stmt2->execute();
            }
        }
    }
    header('Location: ../../pages/profile/allSupervisor.php');
    
    
    $conn->close();
?>

