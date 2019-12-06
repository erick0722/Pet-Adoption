<?php 
if (isset($_POST['delete'])) {
    require '../db_connection.php';
  
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    if($id != null) {
        if ($stmt = $conn->prepare('DELETE FROM pet WHERE Pet_id = ?')) {
            $stmt->bind_param("i", $id); 
            $stmt->execute();
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                header('Location: ../../pages/homepage.php?delete=success');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                header('Location: ../../pages/homepage.php?delete=failed-queryFailed');
            }
        }
    } else header('Location: ../../pages/homepage.php?delete=failed-idNull');
} else header('Location: ../../pages/homepage.php?delete=failed-formBroken');
?>
