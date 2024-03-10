<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <title>Adverse</title>
</head>
<style>
.shop-container {
    margin-top: 2em;
    display: grid;
    grid-template-columns: repeat(3, minmax(250px, 1fr)); /* This will create as many columns as possible with a minimum width of 250px */
    gap: 20px; /* Gap between grid items */
    justify-items: center; /* Center items horizontally */
}

.person {
    text-align: center; /* Center text inside each person container */
    color: white;
}


.person img {
    width: 300px;
    height: auto;
}
</style>

<?php
session_start();

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "adverse";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("การเชื่อมต่อล้มเหลว: " . mysqli_connect_error());
}


mysqli_query($conn,"set character_set_connection=utf8mb4");
mysqli_query($conn,"set character_set_client=utf8mb4");
mysqli_query($conn,"set character_set_results=utf8mb4");



?>

<body>
    <header class="menu-container">
        <nav class="menu">
            <span class="logo-name">AD<span class="logo-name2">VERSE</span></span>
            <ul>
                <a href="index.php"><li>HOME</li></a>
                <a href="shop_keyboard.php"><li>SHOP</li></a>
                <a href="contact.php"><li>CONTACT</li></a>
            </ul>

            <div class="nav-actionbar">
            <?php 

            if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
                echo('<a href="login.php"><button class="login-btn">LOGIN</button></a>');
            }

            else {
                if ($_SESSION['role'] == 'admin') {
                    echo('<a href="Admin/management.php" class="management-btn">MANANGMENT</a>');
                    echo('<h3>'.$_SESSION['username'].'</h3>');
                    echo('<a href="Service/logout.php" class="logout-btn"><img src="assets/logout.svg" alt=""></a>');
                } else {
                    echo('<h3>'.$_SESSION['username'].'</h3>');
                    echo('<a href="Service/logout.php" class="logout-btn"><img src="assets/logout.svg" alt=""></a>');
                }
            }
            ?>
            </div>
        </nav>
    </header>

    <article class="shop-container">
        <div class="person">
            <img src="assets/โน่.jpg" alt="">
            <h3>นายธีรดนย์ ศรีวารี</h3>
            <h5>6506021630020</h5>
        </div>
        <div class="person">
            <img src="assets/บอส.jpg" alt="">
            <h3>นายธนวัฒน์ เเก้วคำไสย์</h3>
            <h5>6506021630011</h5>
        </div>
        <div class="person">
            <img src="assets/อั้ม.jpg" alt="">
            <h3>นายวณิชานนท์ แซ่ลี้</h3>
            <h5>6506021610045</h5>
        </div>
        <div class="person">
            <img src="assets/เก้า.jpg" alt="">
            <h3>นายวิริทธิ์พล ประสงค์</h3>
            <h5>6506021622094</h5>
        </div>
        <div class="person">
            <img src="assets/พี.jpg" alt="">
            <h3>นายนายธนกร ฤกษ์งาม</h3>
            <h5>6506021620059</h5>
        </div>
        <div class="person">
            <img src="assets/ดรีม.jpg" alt="">
            <h3>นายปฏิพัทธ์ บุญอนันต์</h3>
            <h5>6506021620032</h5>
        </div>


    </article>

    <footer>
    </footer>
    <?php 
        mysqli_close($conn);
    ?>
</body>
</html>