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


$sql = "SELECT * FROM reserve as r ,pet as p WHERE p.Pet_id = r.Pet_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Pet next Door</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <link rel="stylesheet" href="../../css/tables.css">
</head>
<div>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="../homepage.php">Pet Next Door</a>
      </nav>
    </div>
<body>
<center>
<h2>All Reserved Pets</h2>

<table>
  <tr>
    <th>Pet ID</th>
    <th>Pet Name</th>
    <th>Reserver ID</th>
    <th>Reserver Name</th>
    <th>Reserve Date</th>
    <th>Pet Breed</th>
    <th>Sex</th>
    <th>Age</th>
    <th>Color/Pattern</th>
    <th>Shelter</th>
  </tr>
 
  <?php
  while($row = mysqli_fetch_array($result))
    {

      $result1 = $conn->query("(SELECT * FROM dog WHERE pet_id = $row[Pet_id]) 
      UNION (SELECT * FROM cat WHERE pet_id = $row[Pet_id])
      UNION (SELECT * FROM critter WHERE pet_id = $row[Pet_id])");


    $row2 = mysqli_fetch_array($result1);

    $p_result = $conn->query("SELECT * FROM person WHERE ID = $row[ID]");

    if($p_result->num_rows != 0)
        $row3 = mysqli_fetch_array($p_result);

    echo "<tr>";
    echo "<td>" . $row['Pet_id'] . "</td>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['ID'] .  "</td>";
    echo "<td>" . $row3['Fname'] ." ". $row3['Lname']."</td>";
    echo "<td>" . $row['Reserve_date'] . "</td>";
    echo "<td>" . $row2['Breed'] . "</td>";
    echo "<td>" . $row['Sex'] . "</td>";
    echo "<td>" . $row['Age'] . "</td>";
    echo "<td>" . $row['Appearance'] . "</td>";
    echo "<td>" . $row['Shelter_num'] . "</td>";
    echo "</tr>";
    }
    $conn->close();
  ?>
  </center>
  </table>
