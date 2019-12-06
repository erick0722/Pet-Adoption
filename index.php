<?php 
  session_start(); 
  require './php/db_connection.php';
  date_default_timezone_set("Canada/Mountain");
  // remove all session variables
  session_unset();
  
  // destroy the session
  session_destroy();
?>
 
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  </head>
  <body>
    <h3 id="title">Signup to Pet Next Door</h3>
    <div id="loginbox">
      <form action="./php/login-signup/addUser.php" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col">
            <label for="fname">First name</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="John">
          </div>
          <div class="col">
            <label for="lname">Last name</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Smith">
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
              <input type="date" class="form-control" id="bd"  name="bd">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="country">Country</label>
              <input type="text" class="form-control" id="country" name="country" placeholder="Canada">
            </div>
            <div class="col">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" name="city" placeholder="Calgary">
            </div>
            <div class="col">
              <label for="state">State/Province</label>
              <input type="text" class="form-control" id="state" name="state" placeholder="Alberta">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="number" class="form-control" id="phone" name="phone" 
                 pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Enter phone number">
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="pw1">Password</label>
          <input type="password" class="form-control" id="pw1" name="pw1" oninput="check_pass()" placeholder="Enter password">
        </div>
        <div class="form-group">
          <label for="pw2">Confirm Password</label>
          <input type="password" class="form-control" id="pw2" name="pw2" oninput="check_pass()" placeholder="Re-enter password">
        </div>
        <p id="pw-error">Passwords must match.</p>
        <button type="submit" class="btn btn-primary" id="btn" name="sb" disabled="disabled">Submit</button>
      </form>
      <a href="./loginPage.php">Log in instead.</a>
    </div>
    <script type="text/javascript" src="./js/signup.js"></script>
  </body>
</html>
