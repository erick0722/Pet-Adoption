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
<br>
<center>
<h2>All Donations</h2>
</center>

<br>
<table>
  <tr>
    <th>Donor ID</th>
    <th>Donor Name</th>
    <th>Amount</th>
    <th>Donation Date</th>
    <th>Donor Email</th>
    <th>Donor Phone</th>
    <th>Shelter ID</th>
    <th>Shelter Name</th>
    <th>Message</th>
  </tr>
 
<?php
  
  $sql = "SELECT * FROM person as p, donate_to as d, shelter as s WHERE p.ID = d.ID AND d.Snum = s.Snum";
  $result = $conn->query($sql);
  
while($row = mysqli_fetch_array($result))
  {
    echo "<tr>";
    echo "<td>" . $row['ID'] . "</td>";
    echo "<td>" . $row['Fname'] . " " . $row['Lname'] . "</td>";
    echo "<td>" . $row['Donation_amount'] . "</td>";
    echo "<td>" . $row['Donation_date'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td>" . $row['Phone'] . "</td>";
    echo "<td>" . $row['Snum'] . "</td>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['Message'] . "</td>";
    echo "</tr>";
  }
  
  $conn->close();
  ?>
  </table>
