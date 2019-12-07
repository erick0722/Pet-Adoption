<?php 
  session_start(); 
require '../../php/db_connection.php';

$search = mysqli_real_escape_string($conn, $_POST["search"]);

$sresult1 = $conn->query("SELECT * FROM pet
WHERE (`Pet_id` LIKE '%".$search."%') OR (`Name` LIKE '%".$search."%') OR (`Sex` LIKE '%".$search."%') OR (`Age` LIKE '%".$search."%') 
OR (`Appearance` LIKE '%".$search."%') OR (`Conditions` LIKE '%".$search."%') OR (`Ready_to_adopt` LIKE '%".$search."%') 
OR (`Adopt_date` LIKE '%".$search."%') OR (`Donor_id` LIKE '%".$search."%') OR (`Shelter_num` LIKE '%".$search."%') 
OR (`Owner_id` LIKE '%".$search."%')");

$sresult2 = $conn->query("SELECT * FROM pet, shelter WHERE pet.Shelter_num = shelter.Snum AND (shelter.Name LIKE '%$search%')");
$sresult3 = $conn->query("(SELECT * FROM pet,dog WHERE pet.Pet_id = dog.Pet_id AND (dog.Breed LIKE '%$search%')) 
                        UNION (SELECT * FROM pet,cat WHERE pet.Pet_id = cat.Pet_id AND (cat.Breed LIKE '%$search%'))
                        UNION (SELECT * FROM pet,critter WHERE pet.Pet_id = critter.Pet_id AND (critter.Breed LIKE '%$search%'))");

if($sresult1->num_rows != 0)
  $result = $sresult1;
else if($sresult2->num_rows != 0)
  $result = $sresult2;
else
  $result = $sresult3;

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../../css/tables.css">
  <link rel="stylesheet" href="../../css/search.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
      crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
      crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
      crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
      crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
      crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
      crossorigin="anonymous"></script>
</head>
<div>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="../../pages/homepage.php">Pet Next Door</a>
      </nav>
    </div>
<body>  
<center>
<h2>All Pets</h2>
</center>

<form class="example" action="../../pages/pets/allPet.php" style="margin:auto;max-width:350px;" >
  <?php echo '<td><input type="text" placeholder="'.$search.'"/></td>'; ?>
  <button type="clear" class="btn btn-primary">Clear</button>
</form>
<br></br>

<table>
  <tr>
    <th>Reserve</th>
    <th>Pet Id</th>
    <th>Name</th>
    <th>Breed</th>
    <th>Sex</th>
    <th>Age</th>
    <th>Color/Pattern</th>
    <th>Medical Conditions</th>
    <th>Ready to Adopt</th>
    <th>Adopted date</th>
    <th>Donor</th>
    <th>Shelter</th>
    <th>Owner</th>
  </tr>
 
<?php
  
  $id_array = array();
  $n = 0;
while($row = mysqli_fetch_array($result))
  {
    $result1 = $conn->query("(SELECT * FROM dog WHERE pet_id = $row[Pet_id]) 
    UNION (SELECT * FROM cat WHERE pet_id = $row[Pet_id])
    UNION (SELECT * FROM critter WHERE pet_id = $row[Pet_id])");

    $row2 = mysqli_fetch_array($result1);

      array_push($id_array, $row['Pet_id']);

      $sql4 = "SELECT shelter.Name FROM pet, shelter WHERE pet.Pet_id = $row[Pet_id] AND shelter.Snum = pet.Shelter_num";
      $result4 = $conn->query($sql4);
      $row4 = mysqli_fetch_array($result4);

      echo "<tr>";
      echo '<td>  <a  href="../../pages/pets/reservePet.php?ID=' . $id_array[$n] . '" class="btn btn-primary"> Reserve </a></td>';
      echo "<td>" . $row['Pet_id'] . "</td>";
      echo "<td>" . $row['Name'] . "</td>";
      echo "<td>" . $row2['Breed'] . "</td>";
      echo "<td>" . $row['Sex'] . "</td>";
      echo "<td>" . $row['Age'] . "</td>";
      echo "<td>" . $row['Appearance'] . "</td>";
      echo "<td>" . $row['Conditions'] . "</td>";
      echo "<td>" . $row['Ready_to_adopt'] . "</td>";
      echo "<td>" . $row['Adopt_date'] . "</td>";
      echo "<td>" . $row['Donor_id'] . "</td>";
      echo "<td>" . $row4['Name'] . "</td>";
      echo "<td>" . $row['Owner_id'] . "</td>";
      echo "</tr>";
      $n++;

  }
  
  $conn->close();
  ?>
  </table>
