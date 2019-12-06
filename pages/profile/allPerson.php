<?php session_start(); 
require '../../php/db_connection.php';

$sql = "SELECT * FROM person";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../../css/tables.css">
</head>
<body>
<center>
<h2>All Users</h2>

<table>
  <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Sex</th>
    <th>City</th>
    <th>Address</th>
    <th>Birthdate</th>
    <th>Phone</th>
    <th>Email</th>
  </tr>
 
  <?php
  while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['ID'] . "</td>";
    echo "<td>" . $row['Fname'] . " " . $row['Lname']  . "</td>";
    echo "<td>" . $row['Sex'] . "</td>";
    echo "<td>" . $row['City'] . " " . $row['State'] .  " " . $row['Country'] . "</td>";
    echo "<td>" . $row['Address'] . "</td>";
    echo "<td>" . $row['Bdate'] . "</td>";
    echo "<td>" . $row['Phone'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "</tr>";
    }
    $conn->close();
  ?>
  </center>
  </table>
