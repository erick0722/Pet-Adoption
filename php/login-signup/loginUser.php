<?php

if (isset($_POST['sb'])) {
    require '../db_connection.php';
    $emailuid= mysqli_real_escape_string($conn ,$_POST['email']);
    $password= mysqli_real_escape_string($conn ,$_POST['pw']);
 
        $sql="SELECT * FROM person WHERE Email=?;";
        $stmt= mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: loginPage.php?error=sqlErrorSelectAdmin");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"s", $emailuid);
            mysqli_stmt_execute($stmt);
        
            $response = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($response)){
                $pwdCheck = password_verify($password, $row['Password']);
                if ($pwdCheck == false) {
                    header("Location: loginPage.php?error=wrongpwd");
                    exit();
                }
                else {
                    session_start();
                    $_SESSION['id']      = $row['ID'];
                    $_SESSION['fname']   = $row['Fname'];
                    $_SESSION['lname']   = $row['Lname'];
                    $_SESSION['sex']     = $row['Sex'];
                    $_SESSION['country'] = $row['Country'];
                    $_SESSION['state']   = $row['State'];
                    $_SESSION['city']    = $row['City'];
                    $_SESSION['address'] = $row['address'];
                    $_SESSION['bdate']   = $row['Bdate'];
                    $_SESSION['phone']   = $row['Phone'];
                    $_SESSION['email']   = $row['Email'];

                    header("Location: ../../pages/homepage.php?login=success");
                    exit();
                }
            }
            else {
                header("Location: loginPage.php?error=noUser");
            exit();
            }
        }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
else {
    header("Location: ../index.php?error=NeedtoLogin");
    exit();
}