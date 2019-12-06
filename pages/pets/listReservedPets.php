<?php session_start(); 
require '../../php/db_connection.php';

$sql = "SELECT * FROM reserve as r ,pet as p WHERE p.Pet_id = r.Pet_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../../css/tables.css">
</head>
<body>
<center>
<h2>All Reserved Pets</h2>

<table>
  <tr>
    <th>Pet Id - Name</th>
    <th>Reserved By ID - Name</th>
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

    $result1 = $conn->query("SELECT * FROM dog WHERE pet_id = $row[Pet_id]");
    $result2 = $conn->query("SELECT * FROM cat WHERE pet_id = $row[Pet_id]");
    $result3 = $conn->query("SELECT * FROM critter WHERE pet_id = $row[Pet_id]");

    if($result1->num_rows != 0) 
      $row2 = mysqli_fetch_array($result1);
    else if($result2->num_rows != 0) 
      $row2 = mysqli_fetch_array($result2);
    else
      $row2 = mysqli_fetch_array($result3);

    $p_result = $conn->query("SELECT * FROM person WHERE ID = $row[ID]");

    if($p_result->num_rows != 0)
        $row3 = mysqli_fetch_array($p_result);

    echo "<tr>";
    echo "<td>" . $row['Pet_id'] . " - " . $row['Name'] . "</td>";
    echo "<td>" . $row['ID'] . " - " . $row3['Fname'] . " " . $row3['Lname'] .  "</td>";
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
