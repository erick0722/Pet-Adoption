<?php 
  session_start(); 
  require '../php/db_connection.php';

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
      <link rel="stylesheet" href="../css/universal.css">
    </head>
    <body>
      <div>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="homepage.php">Pet Next Door</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
          <li class="nav-item">
              <a class="nav-link" href="./shelter/allShelters.php">All Shelters</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Browse Pets
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="./pets/allCats.php">Cats</a>
                <a class="dropdown-item" href="./pets/allDogs.php">Dogs</a>
                <a class="dropdown-item" href="./pets/allCritters.php">Critters</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="./pets/allPet.php">All Pets</a>
                <a class="dropdown-item" href="./pets/listReservedPets.php">All Reserved Pets</a>
              </div>
            </li>
            <?php if($_SESSION["volunteer"]) { ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Add/Edit Pets
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="./pets/addPet.php">Add Pet</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="./pets/editPet.php">Edit Pet</a>
                  <a class="dropdown-item" href="./pets/deletePet.php">Delete Pet</a>
                </div>
              </li>
            <?php } ?>
            <?php
              if($_SESSION["volunteer"]) { ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Add/Edit People
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="./profile/addPetOwner.php">Add Pet Owner</a>
                    <a class="dropdown-item" href="./profile/allPetOwner.php">All Pet Owners</a>
                <?php  
                  if($_SESSION["admin"]) { ?>
                    <div class="dropdown-divider"></div> 
                    <a class="dropdown-item" href="./profile/allPerson.php">All Users</a> 
                    <a class="dropdown-item" href="./profile/allVolunteer.php">All Volunteers</a> 
                    <a class="dropdown-item" href="./profile/allSupervisor.php">All Supervisors</a>
                    <div class="dropdown-divider"></div> 
                    <a class="dropdown-item" href="./profile/addVolunteer.php">Add Volunteer</a> 
                    <a class="dropdown-item" href="./profile/addSupervisor.php">Add Supervisor</a>
                    <div class="dropdown-divider"></div> 
                    <a class="dropdown-item" href="./profile/removeVolunteer.php">Remove Volunteer</a> 
                <?php } ?>
                </div>
              </li>
            <?php } ?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Donations
                </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="./donation/makeDonation.php">Make Donation</a>
                <a class="dropdown-item" href="./donation/allDonations.php">All Donations</a>
              </div>
            </li>
          </ul>
          <div>
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="./profile/profile.php">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../php/logout.php">Log out</a>
            </li>
          </ul>
          </div>
        </div>
      </nav>
      </div>
    <div class="outer-container"
     >  
     <div  style=" 
    background-image: url('../assets/pets_big.png');
    height: 730px;
    width: 100%;
    background-repeat: no-repeat;
    background-size: 90%;
    color: rgb(250, 246, 246);">
     </div>
    </div>
  </body>
</html>