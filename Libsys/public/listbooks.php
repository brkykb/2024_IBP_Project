<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Books</title>
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
        <!-- Logo ve Başlık -->
        <a class="navbar-brand d-flex align-items-center flex-grow-1 justify-content-center" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-book-fill me-3" viewBox="0 0 16 16">
                <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
            </svg>
            <p class="fs-2 mb-0 text-white">Library System Management</p>
        </a>
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
            <th>Books File</th>
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
        echo "<td><a href='" . $row["bookfile"] . "' target='_blank'>" . $row["bookfile"] . "</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>0 results</td></tr>";
}

mysqli_close($connection);
?>

        </tbody>
    </table>
</div>
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
<footer>
    <p>&copy; 2024 Berkay Karabulut. All Rights Reserved.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>