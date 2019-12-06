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
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="../../css/login.css">
    </head>
    <div>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="../homepage.php">Pet Next Door</a>
      </nav>
    </div>
    <body>
    <h3 id="title">Edit your info</h3>
    <div id="loginbox">
      <form action="../../php/login-signup/updateUser.php" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col">
            <label for="fname">First name</label>
            <?php echo "<input type=\"text\" class=\"form-control\" id=\"fname\" name=\"fname\" value=" . $_SESSION['fname'] . ">"; ?>
           
          </div>
          <div class="col">
            <label for="lname">Last name</label>
            <?php echo "<input type=\"text\" class=\"form-control\" id=\"lname\" name=\"lname\" value=" . $_SESSION['lname'] . ">"; ?>
          </div>
        </div>
      </div>
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="sex">Sex</label>
              <select id="sex" name="sex" class="form-control">
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
              </select>
            </div>
            <div class="col">
              <label for="bd">Birthdate</label>
              <?php echo "<input type=\"date\" class=\"form-control\" id=\"bd\" name=\"bd\" value=" . $_SESSION['bdate'] . ">"; ?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="country">Country</label>
              <?php echo "<input type=\"text\" class=\"form-control\" id=\"country\" name=\"country\" value=" . $_SESSION['country'] . ">"; ?>
            </div>
            <div class="col">
              <label for="city">City</label>
              <?php echo "<input type=\"text\" class=\"form-control\" id=\"city\" name=\"city\" value=" . $_SESSION['city'] . ">"; ?>
            </div>
            <div class="col">
              <label for="state">State/Province</label>
              <?php echo "<input type=\"text\" class=\"form-control\" id=\"state\" name=\"state\" value=" . $_SESSION['state'] . ">"; ?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <?php echo "<input type=\"text\" class=\"form-control\" id=\"address\" name=\"address\" value=" . $_SESSION['address'] . ">"; ?>
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <?php echo "<input type=\"number\" class=\"form-control\" id=\"phone\" name=\"phone\" value=" . $_SESSION['phone'] . ">"; ?>
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <?php echo "<input type=\"text\" class=\"form-control\" id=\"email\" name=\"email\" value=" . $_SESSION['email'] . ">"; ?>
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="OldPw">Old Password</label>
          <input type="password" class="form-control" id="OldPw" name="OldPw" placeholder="Enter old password">
        </div>
        <div class="form-group">
          <label for="pw1">New Password</label>
          <input type="password" class="form-control" id="pw1" name="pw1" oninput="check_pass()" placeholder="Enter new password">
        </div>
        <div class="form-group">
          <label for="pw2">Confirm New Password</label>
          <input type="password" class="form-control" id="pw2" name="pw2" oninput="check_pass()" placeholder="Re-enter new password">
        </div>
        <p id="pw-error">New Passwords must match.</p>
        <button type="submit" class="btn btn-primary" id="btn" name="sb" disabled="disabled">Submit</button>
      </form>
    </div>
    </body>
    <script type="text/javascript" src="../../js/signup.js"></script>
</html>