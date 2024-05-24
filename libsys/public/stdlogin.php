<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("connection.php");
$username_err="";
$password_err="";
if (isset($_POST["login"])){
if(empty($_POST["username"])){
 $username_err="Username can't be empty!";
 }
else{
 $username=$_POST["username"];
 }
if(empty($_POST["password"])){
 $password_err="Password can't be empty!";
 }
else{
 $password=$_POST["password"];
 }
if(isset($username)&&isset($password) ){
 $choose="SELECT * FROM stdregister WHERE username='$username'";
 $run=mysqli_query($connection,$choose);
 $registercounter=mysqli_num_rows($run);
if($registercounter>0){
 $userinfo=mysqli_fetch_assoc($run);
 $hashedpassword=$userinfo["password"];
 $usertype=$userinfo["utype"];
if($usertype=="student"){
if(password_verify($password,$hashedpassword)){
session_start();
 $_SESSION["username"]=$userinfo["username"];
 $_SESSION["email"]=$userinfo["email"];
header("location:stdpage.php");
 }
else{
echo '<div class="alert alert-danger" role="alert">
 Password is wrong!
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
 }
mysqli_close($connection);
}
?>
<!doctype html>
<html lang="en">
 <head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Login</title>
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
 <form action="stdlogin.php" method="POST" >
 <div class="mb-3">
 <label for="exampleInputName1" class="form-label">Username</label>
 <input type="text" class="form-control
 <?php
 if(!empty($username_err)){
 echo "is-invalid";
 }
 ?>" id="exampleInputEmail1" name="username">
 <div id="validationServer03Feedback" class="invalid-feedback">
 <?php
 echo $username_err;
 ?>
 </div>
 </div>
 <div class="mb-3">
 <label for="exampleInputPassword1" class="form-label">Password</label>
 <input type="password" class="form-control <?php
 if(!empty($password_err)){
 echo "is-invalid";
 }
 ?>" id="exampleInputPassword1" name="password">
 <div id="validationServer03Feedback" class="invalid-feedback">
 <?php
 echo $password_err;
 ?>
 </div>
 </div>
 <button type="submit" name="login" class="btn btn-primary">Login</button>
 </form>
 <div class="mt-3">
 <!-- Forgot Password Link -->
 <a href="forgotpsw.php" class="text-primary">Forgot password?</a>
 </div>
 </div>
 </div>

 <footer>
    <p>&copy; 2024 Berkay Karabulut. All Rights Reserved.</p>
</footer>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 </body>
</html>