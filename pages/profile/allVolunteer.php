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
<h2>All Volunteers</h2>
</center>
<br>
<table>
  <tr>
    <th>Action</th>
    <th>Id</th>
    <th>Name</th>
    <th>Sex</th>
    <th>Start Date</th>
    <th>Specialization</th>
    <th>Volunteers At</th>
    <th>City</th>
    <th>Address</th>
    <th>Birthday</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Supervisor Id</th>
    <th>Supervisor Name</th>
    
  </tr>
 
<?php  
  $sql = "SELECT DISTINCT p.ID, p.Fname,p.Lname,p.Sex,p.City,p.State,p.Country,p.Address,p.Bdate,p.Phone,p.Email,v.Super_id, sh.Name, v.StartDate, s.Specialization 
  FROM person as p, volunteer as v, specialization as s, shelter as sh, volunteer_at as va 
  WHERE p.ID = v.ID AND s.ID = v.ID AND va.ID = v.ID AND va.Snum = sh.Snum";
  $result = $conn->query($sql);

  

$id_array = array();
$n = 0;
while($row = mysqli_fetch_array($result))
  { 
    $sql2 = "SELECT p.Fname, p.Lname FROM person as p 
    WHERE p.ID IN (SELECT v.Super_id FROM person as p, volunteer as v WHERE $row[ID] = v.ID)";
    $result2 = $conn->query($sql2);

    $row2 = mysqli_fetch_array($result2);
    array_push($id_array, $row['ID']);
    
    echo "<tr>"; 
    echo '<td>  <a  href="editVolunteer.php?ID=' . $id_array[$n] . '" class="btn btn-primary"> Edit </a></td>';
    echo "<td>" . $id_array[$n] . "</td>";
    echo "<td>" . $row['Fname'] ." ". $row['Lname'] . "</td>";
    echo "<td>" . $row['Sex'] . "</td>";
    echo "<td>" . $row['StartDate'] . "</td>";
    echo "<td>" . $row['Specialization'] . "</td>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['City'] . ", ". $row['State']. ", ". $row['Country'] . "</td>";
    echo "<td>" . $row['Address'] . "</td>";
    echo "<td>" . $row['Bdate'] . "</td>";
    echo "<td>" . $row['Phone'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td>" . $row['Super_id'] . "</td>";
    echo "<td>" . $row2['Fname'] ." ".$row2['Lname'] . "</td>";
    echo "</tr>";
    $n++;
  }

  $_SESSION['$id_array'] = $id_array;
  
  $conn->close();
  ?>
  </table>


     
