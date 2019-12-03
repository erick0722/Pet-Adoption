<?php session_start(); 
require '../../php/db_connection.php';

$sql = "SELECT * FROM pet";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../../css/tables.css">
</head>
<body>  
<center>
<h2>All Pets</h2>
</center>

<table>
  <tr>
    <th>Pet Id</th>
    <th>Name</th>
    <th>Sex</th>
    <th>Age</th>
    <th>Color/Pattern</th>
    <th>Ready to Adopt</th>
    <th>Adopted date</th>
    <th>Donor</th>
    <th>Shelter</th>
    <th>Owner</th>
  </tr>
 
<?php
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Pet_id'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Sex'] . "</td>";
  echo "<td>" . $row['Age'] . "</td>";
  echo "<td>" . $row['Appearance'] . "</td>";
  echo "<td>" . $row['Ready_to_adopt'] . "</td>";
  echo "<td>" . $row['Adopt_date'] . "</td>";
  echo "<td>" . $row['Donor_id'] . "</td>";
  echo "<td>" . $row['Shelter_num'] . "</td>";
  echo "<td>" . $row['Owner_id'] . "</td>";
  echo "</tr>";
  }
  $conn->close();
  ?>
  </table>
