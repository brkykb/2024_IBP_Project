<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");

$bookname_err = "";
$author_err = "";
$pages_err = "";
$file_err = "";

if (isset($_POST["bookadd"])) {

    if (empty($_POST["bookname"])) {
        $bookname_err = "Bookname can't be empty!";
    } else {
        $bookname = $_POST["bookname"];
    }

    if (empty($_POST["author"])) {
        $author_err = "Author can't be empty!";
    } else {
        $author = $_POST["author"];
    }

    if (empty($_POST["pages"])) {
        $pages_err = "Pages can't be empty!";
    } else {
        $pages = $_POST["pages"];
    }

    // Dosya yükleme işlemi
    if (isset($_FILES["bookfile"]) && $_FILES["bookfile"]["error"] == 0) {
        $allowed_types = ["application/pdf"];
        $file_type = $_FILES["bookfile"]["type"];
        if (in_array($file_type, $allowed_types)) {
            $file_name = basename($_FILES["bookfile"]["name"]);
            $target_directory = "pdfs/";
            $target_file = $target_directory . $file_name;
            if (!file_exists($target_directory)) {
                mkdir($target_directory, 0777, true);
            }
            if (move_uploaded_file($_FILES["bookfile"]["tmp_name"], $target_file)) {
                $file_path = $target_file;
            } else {
                $file_err = "There was an error uploading the file.";
            }
        } else {
            $file_err = "Only PDF files are allowed.";
        }
    } else {
        $file_err = "File upload failed or no file uploaded.";
    }

    if (empty($bookname_err) && empty($author_err) && empty($pages_err) && empty($file_err)) {
        $add = "INSERT INTO books (bookname, pages, author, bookfile) VALUES ('$bookname', '$pages', '$author', '$file_path')";

        $executeadd = mysqli_query($connection, $add);

        if ($executeadd) {
            echo '<div class="alert alert-primary" role="alert">
            Ekleme Basarili!
            </div>';
        } else {
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
    <title>Book Add</title>
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
        <form action="bookadd.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="exampleInputName1" class="form-label">Book Name</label>
            <input type="text" class="form-control <?php if(!empty($bookname_err)){ echo "is-invalid"; } ?>" id="exampleInputEmail1" name="bookname">
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?php echo $bookname_err; ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="exampleInputName1" class="form-label">Author</label>
            <input type="text" class="form-control <?php if(!empty($author_err)){ echo "is-invalid"; } ?>" id="exampleInputEmail1" name="author">
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?php echo $author_err; ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pages</label>
            <input type="number" class="form-control <?php if(!empty($pages_err)){ echo "is-invalid"; } ?>" id="exampleInputEmail1" name="pages">
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?php echo $pages_err; ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="exampleInputFile1" class="form-label">Book PDF</label>
            <input type="file" class="form-control <?php if(!empty($file_err)){ echo "is-invalid"; } ?>" id="exampleInputFile1" name="bookfile">
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?php echo $file_err; ?>
            </div>
          </div>

          <button type="submit" name="bookadd" class="btn btn-primary bg-dark">Add Book</button>
        </form>
      </div>
    </div>

    <footer>
    <p>&copy; 2024 Berkay Karabulut. All Rights Reserved.</p>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
