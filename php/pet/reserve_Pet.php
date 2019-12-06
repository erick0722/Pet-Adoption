<?php 
session_start();
if (isset($_POST['reserve'])) {
    require '../db_connection.php';
  
    $rd = mysqli_real_escape_string($conn, $_POST["rd"]);
    $p_id = mysqli_real_escape_string($conn, $_POST["id"]);

    $result = $conn->query("SELECT * FROM reserve WHERE Pet_id = $p_id");
    if($result->num_rows == 0)
    {
        $sql = $conn->prepare("INSERT INTO reserve (ID, Pet_id, Reserve_date) VALUES ($_SESSION[id],?,?)");
        $sql->bind_param("is", $p_id, $rd);
        $sql->execute();
        header('Location: ../../pages/homepage.php?reserve=success');
    }
    else
        header('Location: ../../pages/homepage.php?reserve=failed');
    exit();
}
$conn->close();
?>