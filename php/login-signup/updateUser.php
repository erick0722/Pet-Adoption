<?php
    if (isset($_POST['sb'])) {
        session_start();
        require '../db_connection.php';
        $password= mysqli_real_escape_string($conn ,$_POST['OldPw']);
    
        $sql="SELECT * FROM person WHERE ID = $_SESSION[id]";
        $result = $conn->query($sql);
        $row = mysqli_fetch_array($result);
        if (!password_verify($password, $row['Password'])) {
            header("Location: ../../pages/profile/profile.php?error=wrongPw");
            exit();
        } else {
            if($_POST["sex"] == 'Male') {
                $sexcu = 'M';
            }
            else if($_POST["sex"] == 'Female') {
                $sexcu = 'F';
            }
            else{
                $sexcu = 'O';
            }

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

            $_SESSION['fname']   = $fname;
            $_SESSION['lname']   = $lname;
            $_SESSION['sex']     = $sexcu;
            $_SESSION['country'] = $country;
            $_SESSION['state']   = $state;
            $_SESSION['city']    = $city;
            $_SESSION['address'] = $address;
            $_SESSION['bdate']   = $birthday;
            $_SESSION['phone']   = $phone;
            $_SESSION['email']   = $email;

            $hash = password_hash($pw, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("UPDATE person 
            SET Password='$hash', 
            Fname=? , 
            Lname=? , 
            Sex='$sexcu', 
            Country=? , 
            State=? , 
            City=? , 
            Address=? , 
            Bdate=? , 
            Phone=? , 
            Email=? 
            WHERE ID=$_SESSION[id]");

            $stmt->bind_param('sssssssis', $fname, $lname, $country, $state, $city, $address, $birthday, $phone, $email); 
            $stmt->execute();
            header('Location: ../../pages/homepage.php?change=success');
            $conn->close();
        }
    }
?>