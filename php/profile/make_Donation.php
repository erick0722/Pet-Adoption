<?php 
    require '../db_connection.php';
    session_start();

 
    $sname = mysqli_real_escape_string($conn, $_POST["sname"]);
    $amount = mysqli_real_escape_string($conn, $_POST["amount"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    if ($stmt = $conn->prepare('SELECT Snum FROM shelter WHERE Name = ?')) {

    $stmt->bind_param("s", $sname); // 's' specifies the variable type => 'string'

    $stmt->execute();
    $result = $stmt->get_result();
    
    date_default_timezone_set("Canada/Mountain");
    $date = date("Y-m-d") ;

    $result = $conn->query("SELECT Snum FROM shelter WHERE Name = '$sname'");
    $row = $result->fetch_assoc();

    if($result->num_rows == 0) {
        header('Location: ../../pages/donation/makeDonation.php?error=shelterNotFound');
    } else {
        $stmt2 = $conn->prepare("INSERT INTO donate_to (ID, Snum, Donation_date, Donation_amount, Message) VALUES ($_SESSION[id],$row[Snum],'$date',?,?)");
        $stmt2->bind_param("is", $amount, $message);
        
        $stmt2->execute();    

        header('Location: ../../pages/homepage.php');
    }
}
else {
    echo "your mom";
}
    
    $conn->close();
    ?>

