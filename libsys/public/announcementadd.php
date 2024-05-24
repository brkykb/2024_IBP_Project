<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
$title_err="";
$description_err="";


if (isset($_POST["announcementadd"])){

    if(empty($_POST["title"])){
      $title_err="Title can't be empty!";
    }
    else{
      $title=$_POST["title"];
    }

    if(empty($_POST["description"])){
        $description_err="Description can't be empty!";
      }
      else{
        $description=$_POST["description"];
      }

    


   
    
    if(isset($title)&&isset($description) ){

    $add="INSERT INTO announcements(title,description) VALUES ('$title','$description')";

    
    $executeadd = mysqli_query($connection,$add);

    

    if($executeadd){
        echo '<div class="alert alert-primary" role="alert">
        Ekleme Basarili!
      </div>';
    }
    else{
        echo '<div class="alert alert-danger" role="alert">
        Ekleme Basarisiz!
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
    <title>Announcement Add</title>
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

        <form action="announcementadd.php" method="POST" >
            
        <div class="mb-3">
            <label for="exampleInputName1" class="form-label text-white">Title</label>
            <input type="text" class="form-control
              <?php

              if(!empty($title_err)){
              echo "is-invalid";
              }             
            ?>" id="exampleInputName1" name="title">

            

            <div id="validationServer03Feedback" class="invalid-feedback">
            <?php
              echo $title_err; 
            ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="exampleInputName1" class="form-label text-white">Description</label>
            <input type="text" class="form-control
              <?php

              if(!empty($description_err)){
              echo "is-invalid";
              }             
            ?>" id="exampleInputName1" name="description">

            

            <div id="validationServer03Feedback" class="invalid-feedback">
            <?php
              echo $description_err; 
            ?>
            </div>
        </div>

        

     

  <button type="submit" name="announcementadd" class="btn btn-primary text-white">Add Announcement</button>
</form>

    </div>
  </div>

  <footer>
    <p>&copy; 2024 Berkay Karabulut. All Rights Reserved.</p>
</footer>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
