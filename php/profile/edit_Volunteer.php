<?php 
    require '../db_connection.php';
    session_start();

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $specialization = mysqli_real_escape_string($conn, $_POST["spec"]);
    $start_date = mysqli_real_escape_string($conn, $_POST["sd"]);
    $super_id = mysqli_real_escape_string($conn, $_POST["sid"]);
    $snum = mysqli_real_escape_string($conn, $_POST["snum"]);
    
    if($start_date != null){
        if ($stmt = $conn->prepare('UPDATE volunteer SET StartDate = ? WHERE ID = ?')) 
        {
            $stmt->bind_param("si", $start_date, $id); 
            $stmt->execute();
        }
    }
    if($super_id != null){
        if($stmt = $conn->prepare('SELECT ID FROM supervisor WHERE ID = ?')){
            $stmt->bind_param("i", $super_id);
            $stmt->execute();
            $stmt->get_result();
            if($stmt->num_rows ==0){
                 echo "Supervisor ID not found.";
            }else {
                if ($stmt = $conn->prepare('UPDATE volunteer SET Super_id = ? WHERE ID = ?'))
                {
                    $stmt->bind_param("ii", $super_id, $id);
                    $stmt->execute();
                }
            }
        }
    }
    if($snum != null){
        if($stmt = $conn->prepare('SELECT Snum FROM shelter WHERE Snum = ?')){
            $stmt->bind_param("i", $snum);
            $stmt->execute();
            $stmt->get_result();
            if($stmt->num_rows ==0){
                echo "Shelter not found.";
            }else {
               if ($stmt = $conn->prepare('UPDATE volunteer_at SET Snum = ? WHERE ID = ?'))
               {
                   $stmt->bind_param("ii", $snum, $id);
                   $stmt->execute();
               }
           }       
        }
    }
    if($specialization != null){
        if ($stmt = $conn->prepare('UPDATE specialization SET Specialization = ? WHERE ID = ?'))
        {
            $stmt->bind_param("si", $specialization, $id);
            $stmt->execute();
        }
    }
    header('Location: ../../pages/profile/allVolunteer.php');
    $conn->close();
?>
