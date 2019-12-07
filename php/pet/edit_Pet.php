<?php 
    require '../db_connection.php';

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
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
        $sql = "SELECT * FROM pet WHERE Pet_id = $id";
                $result = $conn->query($sql);
                if($result->num_rows != 0)
                {
                    if ($stmt3 = $conn->prepare('UPDATE pet SET Name = ?, Sex = ?, Age = ?, Appearance = ?, Conditions = ?, Ready_to_adopt = ?, Shelter_num = ?
                    WHERE Pet_id = ?')){

                        $stmt3->bind_param("ssisssii", $name, $sex, $age, $color, $mcondition, $adopt, $s_id, $id);

                        $stmt3->execute();
                        if($d_id != null)
                        {  
                            $sql = "SELECT * FROM pet, pet_donor as pd WHERE pet.Owner_id = pd.ID AND pet.pet_id = $id";
                            $result = $conn->query($sql);
                            if($result->num_rows != 0)
                            {
                            if($stmt4 = $conn->prepare('UPDATE pet_donor SET Pet_id = ? WHERE ID = ?'))
                            {
                                $stmt4->bind_param("ii", $id, $d_id);
                                $stmt4->execute();

                            }
                        }
                        else
                        {
                            if($stmt4 = $conn->prepare('INSERT INTO pet_donor(ID,Pet_id) VALUES (?,?)'))
                            {
                                $stmt4->bind_param("ii", $d_id, $id);
                                $stmt4->execute();

                            }
                        }
                            if($stmt5 = $conn->prepare('UPDATE pet SET donor_id = ? WHERE Pet_id = ?'))
                            {
                                $stmt5->bind_param("ii", $d_id, $id);
                                $stmt5->execute();

                            }
                        }
                        
                        if($spec == 'Dog')
                        {
                            $sql = "SELECT * FROM dog WHERE pet_id = $id";
                            $result = $conn->query($sql);
                            if($result->num_rows == 0)
                            {
                                if($stmt6 = $conn->prepare('INSERT INTO dog (Pet_id, Breed) VALUES (?,?)'))
                                    {
                                         $stmt6->bind_param("is", $id, $breed);
                                         $stmt6->execute();
                                    
                                    }
                            }
                            else
                            {
                                if($stmt6 = $conn->prepare('UPDATE dog SET Breed = ? WHERE Pet_id = ?'))
                                    {
                                         $stmt6->bind_param("si", $breed, $id);
                                         $stmt6->execute();
                                    
                                    }
                            }
                        }
                        else if($spec == 'Cat')
                        {
                            $sql = "SELECT * FROM cat WHERE pet_id = $id";
                            $result = $conn->query($sql);
                            if($result->num_rows == 0)
                            {
                                if($stmt6 = $conn->prepare('INSERT INTO cat (Pet_id, Breed) VALUES (?,?)'))
                                    {
                                         $stmt6->bind_param("is", $id, $breed);
                                         $stmt6->execute();
                                    
                                    }
                            }
                            else
                            {
                                if($stmt6 = $conn->prepare('UPDATE cat SET Breed = ? WHERE Pet_id = ?'))
                                    {
                                         $stmt6->bind_param("si", $breed, $id);
                                         $stmt6->execute();
                                    
                                    }
                            }
                        }
                        else 
                        {
                            $sql = "SELECT * FROM critter WHERE pet_id = $id";
                            $result = $conn->query($sql);
                            if($result->num_rows == 0)
                            {
                                if($stmt6 = $conn->prepare('INSERT INTO critter (Pet_id, Breed) VALUES (?,?)'))
                                    {
                                         $stmt6->bind_param("is", $id, $breed);
                                         $stmt6->execute();
                                    
                                    }
                            }
                            else
                            {
                                if($stmt6 = $conn->prepare('UPDATE critter SET Breed = ? WHERE Pet_id = ?'))
                                    {
                                         $stmt6->bind_param("si", $breed, $id);
                                         $stmt6->execute();
                                    
                                    }
                            }
                        }
            
                    }
      
                }
    }
    
    header('Location: ../../pages/pets/allPet.php');
    
    $conn->close();
?>
