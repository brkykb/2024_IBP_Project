<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("connection.php");

session_start();



// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "You need to log in to send or view messages.";
    exit();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Announcements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        
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

<!-- dosya adları değişicek-->

<div class="container p-5 d-flex justify-content-center">
  <form action="announcementadd.php" method="get">
    <button type="submit" class="btn btn-dark btn-lg me-3">Add Announcement</button>
  </form>
  <form action="announcementchange.php" method="get">
    <button type="submit" class="btn btn-dark btn-lg me-3">Edit Announcement</button>
  </form>
  <form action="announcementdelete.php" method="get">
    <button type="submit" class="btn btn-dark btn-lg">Delete Announcement</button>
  </form>
</div>




<div class="container p-5">
  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Description</th>
       
      </tr>
    </thead>
    <tbody id="tableBody">
    <?php
include("connection.php");

$sql = "SELECT * FROM announcements";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["title"]. "</td>";
        echo "<td>" . $row["description"]. "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>0 results</td></tr>";
}

mysqli_close($connection);
?>
<script>
document.getElementById('searchInput').addEventListener('input', function () {
  var searchText = this.value.toLowerCase();
  var rows = document.querySelectorAll('#tableBody tr');
  
  rows.forEach(function (row) {
    var cells = row.querySelectorAll('td');
    var found = false;
    cells.forEach(function (cell) {
      var cellText = cell.textContent.toLowerCase();
      if (cellText.indexOf(searchText) !== -1) {
        found = true;
      }
    });
    if (found) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});
</script>
    </tbody>
  </table>
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
    window.location.href = "announcements.php";
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