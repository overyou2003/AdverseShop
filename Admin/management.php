<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark py-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="management.php">
                        ADVERSE ADMIN PANEL
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto me-5">
                            <li class="nav-item">
                                <a class="nav-link" href="../index.php">HOME</a>
                            </li>
                        </ul>
                        <div class="d-flex">
                            <?php
                            session_start();

                            if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
                                echo('<a href="../login.php" class="btn btn-warning me-3">LOGIN</a>');
                            } else {
                                echo('<a href="../Service/logout.php" class="btn btn-danger"><img src="../assets/logout.svg" alt=""></a>');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1 class="mt-4 mb-4">Product List</h1>
        <a href="addproduct.php" class="btn btn-success"> + Add more products</a><br><br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Detail</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../Service/connection.php');

                $query = "SELECT * FROM product";
                $result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con));

                while ($row = mysqli_fetch_array($result)) { 
                    echo "<tr>";
                    echo "<td>" . $row["ID_PRO"] .  "</td> "; 
                    echo "<td>" . $row["type"] .  "</td> ";  
                    echo "<td>" . $row["name"] .  "</td> ";
                    echo "<td>" . $row["price"] .  "</td> ";
                    echo "<td>" . $row["detail"] .  "</td> ";
                    echo "<td><a href='update.php?member_id=" . $row["ID_PRO"] . "' class='btn btn-warning'>Edit</a></td>";
                    echo "<td><a href='../Service/delete.php?ID_PRO=" . $row["ID_PRO"] . "' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }

                mysqli_close($con);
                ?>
                
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
