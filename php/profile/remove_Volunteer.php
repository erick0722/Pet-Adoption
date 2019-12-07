<?php 
if (isset($_POST['delete'])) {
    require '../db_connection.php';
  
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    if($id != null){
        if ($stmt = $conn->prepare('DELETE FROM volunteer WHERE ID = ?')) {
            $stmt->bind_param("i", $id); 
            $stmt->execute();

            header('Location: ../../pages/profile/allVolunteer.php?delete=success');
        } else header('Location: ../../pages/homepage.php?delete=failed');
    } else header('Location: ../../pages/homepage.php?delete=failed');
} else header('Location: ../../pages/homepage.php?delete=failed');

?>
