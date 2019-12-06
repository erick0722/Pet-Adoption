<?php 
  session_start(); 
  require '../../php/db_connection.php';

  $badPage = true;
  $sql2 = "SELECT ID FROM person";
  $result = $conn->query($sql2);
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
  $sql = "SELECT * FROM person";
  $result = $conn->query($sql);

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
