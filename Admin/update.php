<?php
include('../Service/connection.php');

if (!isset($_GET["member_id"]) || empty($_GET["member_id"])) { 
    echo "<script type='text/javascript'>"; 
    echo "alert('Error Contact Admin !!');"; 
    echo "window.location = 'showmember.php'; "; 
    echo "</script>"; 
    exit; 
}

$member_id = mysqli_real_escape_string($con, $_GET['member_id']);

$sql = "SELECT * FROM product WHERE ID_PRO ='$member_id' ";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);

if (!$row) {
    echo "<script type='text/javascript'>"; 
    echo "alert('ไม่พบข้อมูล !!');"; 
    echo "window.location = 'showmember.php'; "; 
    echo "</script>"; 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-dark py-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        ADVERSE ADMIN PANEL
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto me-5">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">HOME</a>
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
        <h2 class="mt-5 mb-4 text-center">แก้ไขข้อมูลสมาชิก</h2>
        <form action="../Service/saveupdate.php" method="post" name="updateuser" id="updateuser">
            <input type="hidden" name="ID_PRO" value="<?php echo $member_id; ?>" />
            <div class="mb-3 row">
                <label for="ID" class="col-sm-2 col-form-label">ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ID" value="<?php echo $member_id; ?>" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?=$row['name'];?>" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label">Price:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="price" name="price" value="<?=$row["price"];?>" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="detail" class="col-sm-2 col-form-label">Detail:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="detail" name="detail" value="<?=$row["detail"];?>" required>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <input type="submit" class="btn btn-primary" name="Update" id="Update" value="Update">
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
