<!DOCTYPE html>
<html lang="en">
<head>
    <title>LisSys</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <style>
        body {
            background: url(src/logo.jpeg) no-repeat left center fixed;
            background-size: cover;
        }
        .navbar-brand {
            font-weight: bold;
            text-align: center; /* Bold */
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 90vh; /* Screen height size adjustment */
        }
        .btn-group {
            margin-bottom: 20px; /* Space between button groups */
            margin-top: -250px; /* Move buttons up */
        }
        .dropdown-toggle {
            border-radius: 20%;
            width: 200px; /* Button size increased 3 times */
            height: 100px;
            font-size: 35px;
        }
        .title {
            font-size: 50px;
            margin-bottom: 20px; /* Space between navbar title and buttons */
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
    <div class="text-white title text-center mt-auto">LibSys</div>
    <div class="container text-center mt-4"> <!-- mt-4 class added -->
        <div class="d-flex"> <!-- d-flex class to align button groups side by side -->
            <div class="btn-group mr-5 "> <!-- mr-2 class for space between the button and the one on the right -->
                <button type="button" class="btn btn-secondary dropdown-toggle bg-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Student
                </button>
                <div class="dropdown-menu bg-dark ">
                    <a class="dropdown-item text-white" href="register.php">Student register</a>
                    <a class="dropdown-item text-white" href="stdlogin.php">Student login</a>
                </div>
            </div>
            <div class="btn-group"> <!-- Other button group -->
                <button type="button" class="btn btn-secondary dropdown-toggle bg-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Teacher
                </button>
                <div class="dropdown-menu bg-dark">
                    <a class="dropdown-item bg-dark text-white " href="adminlogin.php">Teacher login</a>
                </div>
            </div>
        </div>
    </div>

    <footer>
    <p>&copy; 2024 Berkay Karabulut. All Rights Reserved.</p>
</footer>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>