<?php 
    require '../db_connection.php';
    session_start();

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $salary = mysqli_real_escape_string($conn, $_POST["salary"]);
    $vid = mysqli_real_escape_string($conn, $_POST["vid"]);
    
    if($vid != null){
            if($stmt = $conn->prepare('SELECT ID FROM volunteer WHERE ID = ?')){
                $stmt->bind_param("i", $vid);
                $stmt->execute();
                $stmt->get_result();
                if($stmt->num_rows == 0){
                    if ($stmt = $conn->prepare('UPDATE volunteer SET Super_id = ? WHERE ID = ?'))
                     {
                         $stmt->bind_param("ii", $id, $vid);
                         $stmt->execute();
                     }
                }else 
                    echo "Volunteer ID not found.";
        }
    }
    
    if($salary != null){
        if ($stmt = $conn->prepare('UPDATE supervisor SET salary = ? WHERE ID = ?'))
        {
            $stmt->bind_param("ii", $salary, $id);
            $stmt->execute();
        }
    }
    header('Location: ../../pages/profile/allSupervisor.php');
    $conn->close();
?>
