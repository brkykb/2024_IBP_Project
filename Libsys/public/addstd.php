<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
$username_err = "";
$email_err = "";
$password_err = "";
$cfmpassword_err = "";

if (isset($_POST["register"])) {

    if (empty($_POST["username"])) {
        $username_err = "Username can't be empty!";
    } else {
        $username = $_POST["username"];
    }

    if (empty($_POST["email"])) {
        $email_err = "Email can't be empty!";
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["password"])) {
        $password_err = "Password can't be empty!";
    }

    if (empty($_POST["cfmpassword"])) {
        $cfmpassword_err = "Confirm Password can't be empty!";
    } else if ($_POST["password"] != $_POST["cfmpassword"]) {
        $cfmpassword_err = "Passwords don't match";
    } else {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    }

    if (isset($username) && isset($email) && isset($password)) {
        $add = "INSERT INTO stdregister(username,email,password) VALUES ('$username','$email','$password')";
        $executeadd = mysqli_query($connection, $add);

        if ($executeadd) {
            echo '<div class="alert alert-primary" role="alert">
            Register Completed Successfully!
          </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Register Failed!
          </div>';
        }
        mysqli_close($connection);
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
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
      <div class="card p-5 bg-dark">

        <form action="register.php" method="POST">
          <div class="mb-3">
            <label for="exampleInputName1 " class="form-label text-white">Username</label>
            <input type="text" class="form-control <?php if (!empty($username_err)) echo "is-invalid"; ?>" id="exampleInputName1" name="username">
            <div class="invalid-feedback">
              <?php echo $username_err; ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label text-white">Email address</label>
            <input type="email" class="form-control <?php if (!empty($email_err)) echo "is-invalid"; ?>" id="exampleInputEmail1" name="email">
            <div class="invalid-feedback">
              <?php echo $email_err; ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label text-white">Password</label>
            <input type="password" class="form-control <?php if (!empty($password_err)) echo "is-invalid"; ?>" id="exampleInputPassword1" name="password">
            <div class="invalid-feedback">
              <?php echo $password_err; ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label text-white">Confirm Password</label>
            <input type="password" class="form-control <?php if (!empty($cfmpassword_err)) echo "is-invalid"; ?>" id="exampleInputPassword1" name="cfmpassword">
            <div class="invalid-feedback">
              <?php echo $cfmpassword_err; ?>
            </div>
          </div>

          <button type="submit" name="register" class="btn btn-primary text-white bg-dark">Add Student</button>
        </form>
      </div>
    </div>

    <footer>
    <p>&copy; 2024 Berkay Karabulut. All Rights Reserved.</p>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
