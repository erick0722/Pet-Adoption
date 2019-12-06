<?php 
    require '../db_connection.php';

    $rand_id  = mt_rand(100000, 999999);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $color = mysqli_real_escape_string($conn, $_POST["color"]);
    $d_id = mysqli_real_escape_string($conn, $_POST["d_id"]);
    $s_id = mysqli_real_escape_string($conn, $_POST["s_id"]);
    $mcondition = mysqli_real_escape_string($conn, $_POST["mcondition"]);
    $spec = mysqli_real_escape_string($conn, $_POST["spec"]);
    $sex = mysqli_real_escape_string($conn, $_POST["sex"]);
    $age = mysqli_real_escape_string($conn, $_POST["age"]);
    $breed = mysqli_real_escape_string($conn, $_POST["breed"]);
    $adopt = mysqli_real_escape_string($conn, $_POST["adopt"]);
    $check = true;
    if($sex == 'Male')
        $sex = 'M';
    else
        $sex = 'F';

    if($adopt == 'Yes')
        $adopt = 'Y';
    else
        $adopt = 'N';

    $result = $conn->query("SELECT ID FROM person WHERE ID = $d_id");
    $result2 = $conn->query("SELECT Snum FROM shelter WHERE Snum = $s_id");

    if($result != null)
    {
        if($result->num_rows == 0){
            echo "Donor not found.";
            $check = false;
        }
    }
    if($result2 != null)
    {
        if($result2->num_rows == 0){
            echo "Shelter not found.";
            $check = false;
        }

    }
    if($check == true){
        $sql = "INSERT INTO pet (Pet_id, Name, Sex, Age, Appearance, Conditions, Ready_to_adopt, Shelter_num) 
        VALUES ('$rand_id','$name','$sex','$age','$color','$mcondition','$adopt','$s_id')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header('Location: ../../pages/homepage.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if($d_id != null)
        {
            $sql2 = "INSERT INTO pet_donor (ID, Pet_id) 
            VALUES ('$d_id',  '$rand_id')";
            if ($conn->query($sql2) === TRUE) {
                echo "New record created successfully";
                header('Location: ../../pages/homepage.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $sql3 = "UPDATE pet SET donor_id = $d_id WHERE Pet_id = $rand_id";
            if ($conn->query($sql3) === TRUE) {
                echo "New record created successfully";
                header('Location: ../../pages/homepage.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }   
        if($spec == 'Dog')
        {
            $sql4 = "INSERT INTO dog (Pet_id, Breed) 
            VALUES ('$rand_id',  '$breed')";
        }
        else if($spec == 'Cat')
        {
            $sql4 = "INSERT INTO cat (Pet_id, Breed) 
            VALUES ('$rand_id',  '$breed')";
        }
        else
        {
            $sql4 = "INSERT INTO critter (Pet_id, Breed) 
            VALUES ('$rand_id',  '$breed')";
        }
        if ($conn->query($sql4) === TRUE) {
            echo "New record created successfully";
            header('Location: ../../pages/homepage.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    $conn->close();
?>
