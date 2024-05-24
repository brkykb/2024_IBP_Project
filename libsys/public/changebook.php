<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");

if (isset($_POST["changebookname"])) {

    $bookname = $_POST["bbookname"];
    $choose="SELECT * FROM books WHERE bookname='$bookname'";
    $run=mysqli_query($connection,$choose);
    $registercounter=mysqli_num_rows($run);

    if($registercounter>0){

    $userinfo=mysqli_fetch_assoc($run);
    $old_bookname=$userinfo["bookname"];
    $old_author=$userinfo["author"];
    $old_pages=$userinfo["pages"];
   
        

    
    // Yeni verileri al
    $new_bookname = $_POST["new_bookname"];
    $new_author = $_POST["new_author"];
    $new_pages = $_POST["new_pages"];

    // Kullanıcı adı değiştirme işlemi
    if (!empty($new_bookname)) {
        
        $update_bookname_sql = "UPDATE books SET bookname = '$new_bookname' WHERE bookname = '$old_bookname'";
        mysqli_query($connection, $update_bookname_sql);
    }

    // E-posta değiştirme işlemi
    if (!empty($new_author)) {
        $update_author_sql = "UPDATE books SET author = '$new_author' WHERE author = '$old_author'";
        mysqli_query($connection, $update_author_sql);
    }

    // Şifre değiştirme işlemi
    if (!empty($new_pages)) {
        $update_pages_sql = "UPDATE books SET pages = '$new_pages' WHERE pages = '$old_pages'";
        mysqli_query($connection, $update_pages_sql);
    }

    // İşlem başarılıysa yönlendirme yapabilirsiniz
    header("Location: index.php");
    exit; // Kodun devam etmemesi için çıkış yapılıyor
}
else{
    echo '<div class="alert alert-danger" role="alert">
      bookname not found!
    </div>';
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change bookname</title>
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
            <label for="exampleInputName1" class="form-label">Book Name</label>
            <input type="text" class="form-control" id="exampleInputauthor1" name="bbookname">
            <div id="validationServer03Feedback" class="invalid-feedback">
            
            </div>
        </div>
            
        <div class="mb-3">
            <label for="exampleInputName1" class="form-label">New Book Name</label>
            <input type="text" class="form-control" id="exampleInputauthor1" name="new_bookname">
            <div id="validationServer03Feedback" class="invalid-feedback">
            
            </div>
        </div>

        

        <div class="mb-3">
            <label for="exampleInputauthor1" class="form-label">New Author Name</label>
            <input type="author" class="form-control" id="exampleInputauthor1" name="new_author">
            <div id="validationServer03Feedback" class="invalid-feedback">
            
            </div>
        </div>

        <div class="mb-3">
            <label for="exampleInputpages1" class="form-label">New Pages</label>
            <input type="pages" class="form-control" id="exampleInputpages1" name="new_pages">
            
            <div id="validationServer03Feedback" class="invalid-feedback">
        
            </div>       
        </div>

        <button type="submit" name="changebookname" class="btn btn-primary">Save Changes</button>
        </form>

    </div>
  </div>

  <footer>
    <p>&copy; 2024 Berkay Karabulut. All Rights Reserved.</p>
</footer>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
