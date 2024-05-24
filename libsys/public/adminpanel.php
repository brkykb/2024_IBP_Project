<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("connection.php");

session_start();




$username = $_SESSION['username'];
$query = "SELECT utype FROM stdregister WHERE username = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


if ($user['utype'] !== 'teacher') {
    echo "You do not have the necessary permissions to access this page.";
    exit();
}


$usernumber = "SELECT COUNT(*) AS userCount FROM stdregister;";
$result = $connection->query($usernumber);
$row = $result->fetch_assoc();
$userCount = $row['userCount'];

$booknumber = "SELECT COUNT(*) AS bookCount FROM books;";
$result = $connection->query($booknumber);
$row = $result->fetch_assoc();
$bookCount = $row['bookCount'];

$announcementnumber = "SELECT COUNT(*) AS announcementCount FROM announcements;";
$result = $connection->query($announcementnumber);
$row = $result->fetch_assoc();
$announcementCount = $row['announcementCount'];

$messagenumber = "SELECT COUNT(*) AS messageCount FROM messages;";
$result = $connection->query($messagenumber);
$row = $result->fetch_assoc();
$messageCount = $row['messageCount'];

?>

<style>




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

.info-box {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            background-color: #fff;
            display: flex;
            margin-bottom: 1rem;
            min-height: 100px;
            padding: 1rem;
            position: center;
            width: 100%;
            transition: transform 0.3s;
            align-items: center;
        }

        .info-box:hover {
            transform: scale(1.05);
            
        }

        .info-box-icon {
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 60px;
            width: 60px;
            font-size: 24px;
           
            
        }

.carousel-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 500px;
    }
    /* Carousel'ı yarı yarıya küçültmek için */
    .carousel {
      max-width: 65%;
    }
    /* Carousel'a kenar yumuşatma eklemek için */
    .carousel-inner img {
      border-radius: 20px;
    }
    /* Carousel kontrol düğmelerini yuvarlak yapmak için */
    .carousel-control-prev-icon, .carousel-control-next-icon {
      border-radius: 50%;
    }

    .info-box-content {
            margin-left: 1rem;
            flex: 1;
            
        }

        .info-box-text {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .info-box-number {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .container-fluid{
          align-items: center;
        }

</style>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    
  </head>

  <style>
      body {
        background: url('src/logo.jpeg') no-repeat center center fixed;
        background-size: cover;
      }

    
      
    </style>
  <body>
 
  <nav class="navbar bg-dark">
    
  <div class="container-fluid d-flex justify-content-start align-items-center">
    <!-- Buton -->
    <button class="btn btn-primary me-3 bg-white " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft">
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-card-list" viewBox="0 0 16 16">
        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
        <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
      </svg>
    </button>
    
    <!-- Logo ve Başlık -->
    <a class="navbar-brand d-flex align-items-center flex-grow-1 justify-content-center" href="#">
      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-book-fill me-3" viewBox="0 0 16 16">
        <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
      </svg>
      <p class="fs-2 mb-0 text-white">Library System Management</p>
    </a>


    <div class="btn-group position-relative">
  <button class="btn btn-secondary btn-lg dropdown-toggle bg-white text-black" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-person" viewBox="0 0 16 16">
      <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
    </svg>
  </button>
  <ul class="dropdown-menu dropdown-menu-end">
  <li><a id="logoutButton" class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg> Log out</a></li>
    
  </ul>
</div>

  </div>
</nav>

<div class="container-fluid p-0 carousel-container">
  <!-- Carousel başlangıcı -->
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="src/studentpage/1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="src/studentpage/2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="src/studentpage/3.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- Carousel bitişi -->
</div>

<div class="container-fluid ">
        <!-- Info boxes -->
        <div class="row justify-content-center text-center ">
            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box bg-dark text-white">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
</svg></span>
                    <div class="info-box-content">
                      
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number">
                        <p><span id="userCount"><?php echo($userCount); ?></span></p>

                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-2 ">
                <div class="info-box mb-3 bg-dark text-white">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
  <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Books</span>
                        <span class="info-box-number">
                        <p><span id="bookCount"><?php echo($bookCount); ?></span></p>

                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-3 bg-dark text-white">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-megaphone-fill" viewBox="0 0 16 16">
  <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0zm-1 .724c-2.067.95-4.539 1.481-7 1.656v6.237a25 25 0 0 1 1.088.085c2.053.204 4.038.668 5.912 1.56zm-8 7.841V4.934c-.68.027-1.399.043-2.008.053A2.02 2.02 0 0 0 0 7v2c0 1.106.896 1.996 1.994 2.009l.496.008a64 64 0 0 1 1.51.048m1.39 1.081q.428.032.85.078l.253 1.69a1 1 0 0 1-.983 1.187h-.548a1 1 0 0 1-.916-.599l-1.314-2.48a66 66 0 0 1 1.692.064q.491.026.966.06"/>
</svg></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Messages</span>
                        <span class="info-box-number">
                        <p><span id="messageCount"><?php echo($messageCount); ?></span></p>

                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-3 bg-dark text-white">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
  <path d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
</svg></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Announcements</span>
                        <span class="info-box-number">
                        <p><span id="announcementCount"><?php echo($announcementCount); ?></span></p>

                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
   


<!-- Offcanvas Menü -->
<div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
  <div class="offcanvas-header d-flex justify-content-center align-items-center flex-column">
    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="white" class="bi bi-person-circle mb-3" viewBox="0 0 16 16">
      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
    </svg>
    <h5 class="offcanvas-title text-white mb-0">Admin Panel</h5>
  </div>
  <div class="offcanvas-body">
    <!-- Butonlar -->
    <button id="usersButton" class="btn  btn-lg btn-block mb-2 d-block text-white"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
</svg> Users</button>
    <button id="booksButton" class="btn  btn-lg btn-block mb-2 d-block text-white"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bookshelf" viewBox="0 0 16 16">
  <path d="M2.5 0a.5.5 0 0 1 .5.5V2h10V.5a.5.5 0 0 1 1 0v15a.5.5 0 0 1-1 0V15H3v.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 .5-.5M3 14h10v-3H3zm0-4h10V7H3zm0-4h10V3H3z"/>
</svg> Books</button>
    <button id="announcementsButton" class="btn  btn-lg btn-block mb-2 d-block text-white"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
  <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 75 75 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0m-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233q.27.015.537.036c2.568.189 5.093.744 7.463 1.993zm-9 6.215v-4.13a95 95 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A61 61 0 0 1 4 10.065m-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68 68 0 0 0-1.722-.082z"/>
</svg> Announcements</button>
    <button id="messagesButton" class="btn  btn-lg btn-block mb-2 d-block text-white"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
  <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
</svg> Messages</button>
  </div>
</div>




  
    

<script>
  // Kullanıcılar butonu için yönlendirme işlemi
  document.getElementById("usersButton").onclick = function() {
    window.location.href = "allstd.php";
  };

  // Kitaplar butonu için yönlendirme işlemi
  document.getElementById("booksButton").onclick = function() {
    window.location.href = "allbooks.php";
  };

  // Duyurular butonu için yönlendirme işlemi
  document.getElementById("announcementsButton").onclick = function() {
    window.location.href = "allannouncements.php";
  };

  // Mesajlar butonu için yönlendirme işlemi
  document.getElementById("messagesButton").onclick = function() {
    window.location.href = "messages.php";
  };

  document.getElementById("logoutButton").onclick = function() {
    window.location.href = "index.php";
  };

  
</script>

<footer>
    <p>&copy; 2024 Berkay Karabulut. All Rights Reserved.</p>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </div>
  </body>
</html>