<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>calcumalatin...</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/login.css">
    </head>

    <body>
        Processing...
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

            $sql = "INSERT INTO person (ID, Password, Fname, Lname, Sex, Country, State, City, Address, Bdate, Phone, Email) 
            VALUES ('$rand_id', '$hash', '$fname', '$lname', '$sexcu', '$country', '$state', '$city', '$address', '$birthday', '$phone', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                header('Location: ./loginPage.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        } 
        else {
            echo "shit broke my mans";
        }  
        ?>
        <script src="" async defer></script>
    </body>
</html>