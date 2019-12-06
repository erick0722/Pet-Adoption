<?php session_start(); 
require '../../php/db_connection.php';

$sql = "SELECT * FROM shelter";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../../css/tables.css">
</head>
<body>
<center>
<h2>All Pet Sheltes</h2>

<table>
  <tr>
    <th>Shelter Id</th>
    <th>Name</th>
    <th>City</th>
    <th>Address</th>
  </tr>
 
  <?php
  while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['Snum'] . "</td>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['City'] . " " . $row['State'] .  " " . $row['Country'] . "</td>";
    echo "<td>" . $row['Address'] . "</td>";
    echo "</tr>";
    }
    $conn->close();
  ?>
  </center>
  </table>
