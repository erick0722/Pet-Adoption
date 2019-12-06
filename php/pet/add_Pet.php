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

    if($d_id != null)
    {
        if ($stmt = $conn->prepare('SELECT ID FROM person WHERE ID = ?')) {
            $stmt->bind_param("i", $d_id);
            
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 0){
                echo "Donor not found.";
                $check = false;
            }
        }
    }
    if($s_id != null)
    {
        if ($stmt2 = $conn->prepare('SELECT Snum FROM shelter WHERE Snum = ?')) {
            $stmt2->bind_param("i", $s_id);
            
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            if($result2->num_rows == 0){
                echo "Shelter not found.";
            $check = false;
            }
        }
    }
    if($check == true)
    {
        $sql = "SELECT * FROM pet WHERE Pet_id = $rand_id";
                $result = $conn->query($sql);
                if($result->num_rows == 0)
                {
        if ($stmt3 = $conn->prepare('INSERT INTO pet (Pet_id, Name, Sex, Age, Appearance, Conditions, Ready_to_adopt, Shelter_num) 
        VALUES (?,?,?,?,?,?,?,?)')) {
            $stmt3->bind_param("ississsi", $rand_id, $name, $sex, $age, $color, $mcondition, $adopt, $s_id);
            
            $stmt3->execute();
            if($d_id != null)
            {
                if($stmt4 = $conn->prepare('INSERT INTO pet_donor (ID, Pet_id) 
                VALUES (?,?)'))
                {
                    $stmt4->bind_param("ii", $d_id, $rand_id);
                    $stmt4->execute();
                    
                }
                if($stmt5 = $conn->prepare('UPDATE pet SET donor_id = ? WHERE Pet_id = ?'))
                {
                    $stmt5->bind_param("ii", $d_id, $rand_id);
                    $stmt5->execute();
                    
                }
            }
            
            if($spec == 'Dog')
            {
                if($stmt6 = $conn->prepare('INSERT INTO dog (Pet_id, Breed) VALUES (?,?)'))
                    {
                         $stmt6->bind_param("is", $rand_id, $breed);
                         $stmt6->execute();
                    
                    }
            }
            else if($spec == 'Cat')
            {
                if($stmt6 = $conn->prepare('INSERT INTO cat (Pet_id, Breed) VALUES (?,?)'))
                    {
                         $stmt6->bind_param("is", $rand_id, $breed);
                         $stmt6->execute();
                    
                    }
            }
            else 
            {
                if($stmt6 = $conn->prepare('INSERT INTO critter (Pet_id, Breed) VALUES (?,?)'))
                    {
                         $stmt6->bind_param("is", $rand_id, $breed);
                         $stmt6->execute();
                    
                    }
            }

            header('Location: ../../pages/pets/allPet.php');
            
        }
      
    }
    
}
    
    
    $conn->close();
?>
