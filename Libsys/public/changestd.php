<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");

if (isset($_POST["changestd"])) {

    $username = $_POST["busername"];
    $choose="SELECT * FROM stdregister WHERE username='$username'";
    $run=mysqli_query($connection,$choose);
    $registercounter=mysqli_num_rows($run);

    if($registercounter>0){

    $userinfo=mysqli_fetch_assoc($run);
    $old_username=$userinfo["username"];
    $old_email=$userinfo["email"];
    $old_password=$userinfo["password"];
    $usertype=$userinfo["utype"];
        if($usertype == "student"){

    
    // Yeni verileri al
    $new_username = $_POST["new_username"];
    $new_email = $_POST["new_email"];
    $new_password = $_POST["new_password"];

    // Kullanıcı adı değiştirme işlemi
    if (!empty($new_username)) {
        
        $update_username_sql = "UPDATE stdregister SET username = '$new_username' WHERE username = '$old_username'";
        mysqli_query($connection, $update_username_sql);
    }

    // E-posta değiştirme işlemi
    if (!empty($new_email)) {
        $update_email_sql = "UPDATE stdregister SET email = '$new_email' WHERE email = '$old_email'";
        mysqli_query($connection, $update_email_sql);
    }

    // Şifre değiştirme işlemi
    if (!empty($new_password)) {
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_password_sql = "UPDATE stdregister SET password = '$new_hashed_password' WHERE password = '$old_password'";
        mysqli_query($connection, $update_password_sql);
    }

    // İşlem başarılıysa yönlendirme yapabilirsiniz
    header("Location: index.php");
    exit; // Kodun devam etmemesi için çıkış yapılıyor
}
    else{
        echo '<div class="alert alert-danger" role="alert">
      You dont have permission!
    </div>';
    }
}
else{
    echo '<div class="alert alert-danger" role="alert">
      Username not found!
    </div>';
  }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Student</title>
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

        <form action="" method="POST" >

        <div class="mb-3">
            <label for="exampleInputName1" class="form-label">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="busername">
            <div id="validationServer03Feedback" class="invalid-feedback">
            
            </div>
        </div>
            
        <div class="mb-3">
            <label for="exampleInputName1" class="form-label">New Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="new_username">
            <div id="validationServer03Feedback" class="invalid-feedback">
            
            </div>
        </div>

        

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">New Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="new_email">
            <div id="validationServer03Feedback" class="invalid-feedback">
            
            </div>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">New Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="new_password">
            
            <div id="validationServer03Feedback" class="invalid-feedback">
        
            </div>       
        </div>

        <button type="submit" name="changestd" class="btn btn-primary">Save Changes</button>
        </form>

    </div>
  </div>


  <footer>
    <p>&copy; 2024 Berkay Karabulut. All Rights Reserved.</p>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
