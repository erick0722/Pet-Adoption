<?php 
  session_start(); 
  require '../../php/db_connection.php';

  $badPage = true;
  $sql = "SELECT ID FROM person";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          if($_SESSION["id"] == $row["ID"]) {
            $badPage = false;
          }
      }
  }
  if($badPage) {
    // remove all session variables
    session_unset();
  
    // destroy the session
    session_destroy();
  
    header("Location: ../index.php");
  }
?>


<?php 
  $_SESSION["admin"]     = false;
  $_SESSION["volunteer"] = false;
  $sql = "SELECT ID FROM supervisor";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          if($_SESSION["id"] == $row["ID"]) {
            $_SESSION["admin"]     = true;
            $_SESSION["volunteer"] = true;
          }
      }
  }

  $sql = "SELECT ID FROM volunteer";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          if($_SESSION["id"] == $row["ID"]) {
            $_SESSION["volunteer"] = true;
          }
      }
  }

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
        <a class="navbar-brand" href="../homepage.php">Pet Next Door</a>
      </nav>
    </div>
<body>  
<center>
  <h2>All Pets</h2>
</center>



<form class="example"  action="../../php/pet/searchPet.php" method="post" style="margin:auto;max-width:350px;" >
<input type="text" class="form-control" id="search" name="search" placeholder="Search by keyword">
  <button type="search" class="btn btn-primary">Search</button>
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
  $sql = "SELECT * FROM pet";
  $result = $conn->query($sql);

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
      echo '<td>  <a  href="reservePet.php?ID=' . $id_array[$n] . '" class="btn btn-primary"> Reserve </a></td>';
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
  $_SESSION['id_array'] = $id_array;
  $conn->close();
  ?>
  </table>
