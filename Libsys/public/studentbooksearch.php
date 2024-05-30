

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  


    
    
  </ul>
</div>

  </div>
</nav>





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
 
  </style>
 </head>
 <body>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <div class="container-fluid">
 <a class="navbar-brand" href="#">LibraSys</a>
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
 <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarNav">
 <ul class="navbar-nav">
 <li class="nav-item">
 <a class="nav-link active" aria-current="page" href="#">Home</a>
 </li>
 <li class="nav-item">
 <a class="nav-link" href="#bookSearch">Book Search</a>
 </li>
 <li class="nav-item">
 <a class="nav-link" href="#messages">Messages</a>
 </li>
 <li class="nav-item">
 <a class="nav-link" href="#announcements">Announcements</a>
 </li>
 </ul>

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
 </div>
 </div>
 </nav>




<div class="container p-5">
  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
  <table class="table">
    <thead>
      <tr>
        <th>Book Name</th>
        <th>Author</th>
        <th>Pages</th>
      </tr>
    </thead>
    <tbody id="tableBody">
    <?php
include("connection.php");

$sql = "SELECT * FROM books";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["bookname"]. "</td>";
        echo "<td>" . $row["author"]. "</td>";
        echo "<td>" . $row["pages"]. "</td>";
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
    window.location.href = "announcement.php";
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