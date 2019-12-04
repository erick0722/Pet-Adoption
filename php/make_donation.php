<?php 
    if (isset($_POST['sb'])) {
        require '../db_connection.php';
        $donation    = mysqli_real_escape_string($conn, $_POST["donation"]);

        $sql = "INSERT INTO person (ID, Password, Fname, Lname, Sex, Country, State, City, Address, Bdate, Phone, Email) 
        VALUES ('$rand_id', '$hash', '$fname', '$lname', '$sexcu', '$country', '$state', '$city', '$address', '$birthday', '$phone', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header('Location: ./loginPage.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    } else {
        echo "shit broke my mans";
    }  
?>