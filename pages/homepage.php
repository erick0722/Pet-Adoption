<?php 
  session_start(); 
  require '../php/db_connection.php';
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
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="">Pet Next Door</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Browse Pets
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="./pets/allCats.php">Cats</a>
                  <a class="dropdown-item" href="./pets/allDogs.php">Dogs</a>
                  <a class="dropdown-item" href="./pets/allCritters#">Critters</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="./pets/allPet.php">All Pets</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Add/Edit Pets
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="./pets/addPet.html">Add Pet</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="./pets/addMedicalHistory.html">Edit Medical History</a>
                </div>
              </li>
              <li class="nav-item">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Add people/pets
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="./profile/addVolunteer.php">Add Volunteer</a>
                  <a class="dropdown-item" href="./profile/addSupervisor.php">Add Supervisor</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="./profile/addPetOwner.php">Add Pet Owner</a>
                </div>
              </li>
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./donation/MakeDonation.html">Make Donation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./profile/profile.php">Profile</a>
              </li>
            </ul>
          </div>
        </nav>
        <p>
          <?php 
            $_SESSION["admin"]     = false;
            $_SESSION["volunteer"] = false;
            echo "Greetings " . $_SESSION["fname"] . " " . $_SESSION["lname"] . "! <br>";
            $sql = "SELECT ID FROM supervisor";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($_SESSION["id"] == $row["ID"]) {
                      $_SESSION["admin"]     = true;
                      $_SESSION["volunteer"] = true;
                    }
                }
            } else {
                echo "0 results";
            }

            $sql = "SELECT ID FROM volunteer";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($_SESSION["id"] == $row["ID"]) {
                      $_SESSION["volunteer"] = true;
                    }
                }
            } else {
                echo "0 results";
            }
            $conn->close();
          ?>
            <br>
            <?php 
              if($_SESSION["admin"] == true) 
                echo "you have admin permisions. <br>";  
              else if($_SESSION["volunteer"] == true) 
                echo "you have volunteer permisions. <br>";
              else 
                echo "you are el personerino.";?>
            <br>
            makeReservation - do on browse pet screen
            <br>
            requestSearch - do on browse pets
            <br>
            updateProfile - do on profile
        </p>
        <script src="" async defer></script>
    </body>
</html>