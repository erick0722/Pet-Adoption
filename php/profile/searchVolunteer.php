<?php 
  session_start(); 
require '../../php/db_connection.php';

$search = mysqli_real_escape_string($conn, $_POST["search"]);


$result = $conn->query(
"SELECT * FROM person as p, volunteer as v, specialization as s WHERE p.ID = v.ID AND s.ID = v.ID
AND ((`p.ID` LIKE '%".$search."%') 
OR (`p.Fname` LIKE '%".$search."%') 
OR (`p.Lname` LIKE '%".$search."%') 
OR (`p.Sex` LIKE '%".$search."%') 
OR (`s.Specialization` LIKE '%".$search."%') 
OR (`p.City` LIKE '%".$search."%') 
OR (`p.State` LIKE '%".$search."%') 
OR (`p.Country` LIKE '%".$search."%') 
OR (`p.Address` LIKE '%".$search."%') 
OR (`p.Bdate` LIKE '%".$search."%') 
OR (`p.Phone` LIKE '%".$search."%') 
OR (`p.Email` LIKE '%".$search."%'))");


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
<body>  
<center>
<h2>All Volunteers</h2>
</center>

<form class="example" action="../../pages/profile/allVolunteer.php" style="margin:auto;max-width:350px;" >
  <?php echo '<td><input type="text" placeholder="'.$search.'"/></td>'; ?>
  <button type="clear" class="btn btn-primary">Clear</button>
</form>
<br></br>

<table>
  <tr>
    <th>Action</th>
    <th>Id</th>
    <th>Name</th>
    <th>Sex</th>
    <th>Start Date</th>
    <th>Specialization</th>
    <th>City</th>
    <th>Address</th>
    <th>Birthday</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Supervisor Id</th>
    <th>Supervisor Name</th>
  </tr>
 
<?php
  

while($row = mysqli_fetch_array($result))
  {
    $result2 = $conn->query("SELECT p.Fname, p.Lname FROM person as p WHERE p.ID = $row[Super_id]");
    $row2 = mysqli_fetch_array($result2);
    $ID = $row['ID'];
    echo "<tr>";
    echo '<td>  <a  href="../../pages/profile/editVolunteer.php?ID=' . $ID . '" class="btn btn-primary"> Edit </a></td>';
    echo "<td>" . $row['ID'] . "</td>";
    echo "<td>" . $row['Fname'] ." ". $row['Lname'] . "</td>";
    echo "<td>" . $row['Sex'] . "</td>";
    echo "<td>" . $row['StartDate'] . "</td>";
    echo "<td>" . $row['Specialization'] . "</td>";
    echo "<td>" . $row['City'] . " ". $row['State']. " ". $row['Country'] . "</td>";
    echo "<td>" . $row['Address'] . "</td>";
    echo "<td>" . $row['Bdate'] . "</td>";
    echo "<td>" . $row['Phone'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td>" . $row['Super_id'] . "</td>";
    echo "<td>" . $row2['Fname'] ." ".$row2['Lname'] . "</td>";
    echo "</tr>";
  }
  
  $conn->close();
  ?>
  </table>
