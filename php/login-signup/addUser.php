<?php 
if (isset($_POST['sb'])) {
    require '../db_connection.php';
    $rand_id  = mt_rand(10000000, 99999999);
    $fname    = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname    = mysqli_real_escape_string($conn, $_POST["lname"]);
    $address  = mysqli_real_escape_string($conn, $_POST["address"]);
    $country  = mysqli_real_escape_string($conn, $_POST["country"]);
    $state    = mysqli_real_escape_string($conn, $_POST["state"]);
    $city     = mysqli_real_escape_string($conn, $_POST["city"]);
    $birthday = mysqli_real_escape_string($conn, $_POST["bd"]);
    $email    = mysqli_real_escape_string($conn, $_POST["email"]);
    $phone    = mysqli_real_escape_string($conn, $_POST["phone"]);
    $pw       = mysqli_real_escape_string($conn, $_POST["pw1"]);
    if($_POST["sex"] == 'Male') {
        $sexcu = 'M';
    }
    else if($_POST["sex"] == 'Female') {
        $sexcu = 'F';
    }
    else{
        $sexcu = 'O';
    }
    $hash = password_hash($pw, PASSWORD_DEFAULT);

    $sql = $conn->prepare("INSERT INTO person (ID, Password, Fname, Lname, Sex, Country, State, City, Address, Bdate, Phone, Email) 
    VALUES (?, ?, ?, ?, '$sexcu', ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param('issssssssis', $rand_id, $hash, $fname, $lname, $country, $state, $city, $address, $birthday, $phone, $email); 
    $sql->execute();
    header('Location: ../../loginPage.php');
    $conn->close();
}  
?>
