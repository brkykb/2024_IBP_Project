<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");

$check_username_err="";
$check_email_err="";
$check_newpassword_err="";


if (isset($_POST["changepwd"])){

    if(empty($_POST["username"])){
      $check_username_err="Username can't be empty!";
    }
    else{
      $check_username=$_POST["username"];
    }

    
    if(empty($_POST["email"])){
      $check_email_err="Email can't be empty!";
    }
    else{
      $check_email=$_POST["email"];
    }

    if(empty($_POST["newpassword"])){
        $check_newpassword_err="New Password can't be empty!";
      }
      else{
        $newpassword=$_POST["newpassword"];
      }
    
    if(isset($check_username) && isset($check_email) && isset($newpassword) ){

      // Güvenli SQL sorgusu için hazır ifadeler kullanın
      $choose = "SELECT * FROM stdregister WHERE username=?";
      $stmt = mysqli_prepare($connection, $choose);
      mysqli_stmt_bind_param($stmt, "s", $check_username);
      mysqli_stmt_execute($stmt);
      $run = mysqli_stmt_get_result($stmt);
      $forgotcounter = mysqli_num_rows($run);

      if($forgotcounter > 0){
  
        $userinfo = mysqli_fetch_assoc($run);
  
        $username = $userinfo["username"];
        $email = $userinfo["email"];
        $old_password = $userinfo["password"];
        $usertype = $userinfo["utype"];

        if(($email == $check_email) && ($username == $check_username)){
            $hashed_newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $update_password_sql = "UPDATE stdregister SET password = ? WHERE username = ?";
            $stmt = mysqli_prepare($connection, $update_password_sql);
            mysqli_stmt_bind_param($stmt, "ss", $hashed_newpassword, $check_username);
            mysqli_stmt_execute($stmt);
        
            header("location:stdlogin.php");
            exit;
        }
        else{
          echo '<div class="alert alert-danger" role="alert">
          Email is wrong!
        </div>';
        }
  
      }
      else{
          echo '<div class="alert alert-danger" role="alert">
              You dont have permission!
            </div>';
          }
      }
      else{
        echo '<div class="alert alert-danger" role="alert">
          Username is wrong!
        </div>';
      }
  

mysqli_close($connection);
}
?>

<!-- HTML form kısmı -->
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgotpsw</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <style>
      body {
        background: url('src/logo.jpeg') no-repeat center center fixed;
        background-size: cover;
      }
      footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            transition: bottom 0.3s ease-in-out;
        }

        footer:hover {
            bottom: -50px; /* Adjust this value as needed to hide the footer */
        }
      
    </style>

  </head>
  <body>

  <div class="container p-5">
    <div class="card p-5 bg-dark text-white">
        <form action="forgotpsw.php" method="POST" >
            
        <div class="mb-3">
            <label for="exampleInputName1" class="form-label">Username</label>
            <input type="text" class="form-control <?php if(!empty($check_username_err)) echo "is-invalid"; ?>" id="exampleInputEmail1" name="username">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?php echo $check_username_err; ?>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control <?php if(!empty($check_email_err)) echo "is-invalid"; ?>" id="exampleInputemail1" name="email">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?php echo $check_email_err; ?>
            </div>       
        </div>

        <div class="mb-3">
            <label for="exampleInputnewpassword1" class="form-label">New Password</label>
            <input type="password" class="form-control <?php if(!empty($check_newpassword_err)) echo "is-invalid"; ?>" id="exampleInputPassword1" name="newpassword">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?php echo $check_newpassword_err; ?>
            </div>       
        </div>

        <button type="submit" name="changepwd" class="btn btn-primary">Change Password</button>
    </form>
    </div>
  </div>
  <footer>
    <p>&copy; 2024 Berkay Karabulut. All Rights Reserved.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
