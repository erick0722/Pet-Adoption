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
  $conn->close();
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
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
        <link rel="stylesheet" href="../../css/login.css">
    </head>

    <body>
        <h3 id="title">Add Pet</h3>
        <div id="loginbox">
          <form action="../../php/pet/add_Pet.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Iggy">
            </div>
            <div class="form-group">
                <label for="color">Color/Pattern:</label>
                <input type="text" class="form-control" id="color" name="color" placeholder="">
            </div>
            <div class="form-group">
                <label for="d_id">Donor ID(If known):</label>
                <input type="number" class="form-control" id="d_id" name="d_id" placeholder="">
            </div>
            <div class="form-group">
                <label for="s_id">Shelter ID:</label>
                <input type="number" class="form-control" id="s_id" name="s_id" placeholder="">
            </div>
            <div class="form-group">
              <label for="mcondition">Medical Conditions(If any):</label>
              <input type="text" class="form-control" id="mcondition" name="mcondition" placeholder="">
          </div>
          
            <div class="row">
              <div class="col">
                <label for="spec">Species:</label>
                <select id="spec" name="spec" class="form-control">
                  <option>Dog</option>
                  <option>Cat</option>
                  <option>Critter</option>
                </select>
              </div>
              <div class="col">
                    <label for="breed">Breed:</label>
                    <input type="text" name="breed" class="form-control" id="breed" name="breed">
                </div>
                <div class="col">
                  <label for="sex">Sex:</label>
                  <select id="sex" name="sex" class="form-control">
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>   
                <div class="col">
                    <label for="age">Age:</label>
                    <input type="number" name="age" class="form-control" id="age" name="age" placeholder="Enter Age">
                </div>
                <div class="col">
                  <label for="adopt">Ready to Adopt?:</label>
                  <select id="adopt" name="adopt" class="form-control">
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>
              </div>
              <br><button type="submit" style="float: right;" class="btn btn-primary">Submit</button></br>
           
            
          </form>
        </div>
        <script src="" async defer></script>
    </body>
</html>