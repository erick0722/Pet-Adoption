<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
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
        <link rel="stylesheet" href="../../css/login.css">
    </head>

    <body>
        <h3 id="title">Edit Pet</h3>
        <div id="loginbox">
          <form action="../../php/pet/edit_Pet.php" method="post">
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
                <label for="o_id">Owner ID(If known):</label>
                <input type="number" class="form-control" id="o_id" name="o_id" placeholder="">
            </div>
            <div class="form-group">
              <label for="mcondition">Medical Conditions(If any):</label>
              <input type="text" class="form-control" id="mcondition" name="mcondition" placeholder="">
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col">
                <label for="spec">Species:</label>
                <select id="spec" name="spec" class="form-control">
                  <option>Dog</option>
                  <option>Cat</option>
                  <option>Critter</option>
                </select>
              </div>
            <div class="form-group">
              <div class="row">
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
                  <label for="adopt_date">Adoption Date:</label>
                  <input type="date" class="form-control" name="adopt_date" id="adopt_date">
                </div>
              </div>
              <br><button type="submit" style="float: right;" class="btn btn-primary">Submit</button></br>
            </div>
            
          </form>
        </div>
        <script src="" async defer></script>
    </body>
</html>