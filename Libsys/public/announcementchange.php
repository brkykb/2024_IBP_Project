<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");

if (isset($_POST["announcementchange"])) {

    $title = $_POST["title"]; /*ttitle */
    $choose="SELECT * FROM announcements WHERE title='$title'";
    $run=mysqli_query($connection,$choose);
    $registercounter=mysqli_num_rows($run);

    if($registercounter>0){

    $userinfo=mysqli_fetch_assoc($run);
    $old_title=$userinfo["title"];
    $old_description=$userinfo["description"];
    
   
        

    
    // Yeni verileri al
    $new_title = $_POST["new_title"];
    $new_description = $_POST["new_description"];
 

    // Kullanıcı adı değiştirme işlemi
    if (!empty($new_title)) {
        
        $update_title_sql = "UPDATE announcements SET titel = '$new_title' WHERE title = '$old_title'";
        mysqli_query($connection, $update_title_sql);
    }

    // E-posta değiştirme işlemi
    if (!empty($new_description)) {
        $update_description_sql = "UPDATE announcements SET description = '$new_description' WHERE description = '$old_description'";
        mysqli_query($connection, $update_description_sql);
    }

   

    // İşlem başarılıysa yönlendirme yapabilirsiniz
    header("Location: allannouncements.php");
    exit; // Kodun devam etmemesi için çıkış yapılıyor
}
else{
    echo '<div class="alert alert-danger" role="alert">
      Ttile not found!
    </div>';
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change announcement</title>
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
            <label for="exampleInputName1" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleInputauthor1" name="title"> <!--ttitle -->
            <div id="validationServer03Feedback" class="invalid-feedback">
            
            </div>
        </div>
            
        <div class="mb-3">
            <label for="exampleInputName1" class="form-label">New Title</label>
            <input type="text" class="form-control" id="exampleInputauthor1" name="new_title">
            <div id="validationServer03Feedback" class="invalid-feedback">
            
            </div>
        </div>

        

        <div class="mb-3">
            <label for="exampleInputauthor1" class="form-label">New description</label>
            <input type="author" class="form-control" id="exampleInputauthor1" name="new_description">
            <div id="validationServer03Feedback" class="invalid-feedback">
            
            </div>
        </div>

       

        <button type="submit" name="announcementchange" class="btn btn-primary bg-dark">Save Changes</button>
        </form>

    </div>
  </div>

  <footer>
    <p>&copy; 2024 Berkay Karabulut. All Rights Reserved.</p>
</footer>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
