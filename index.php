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
                <a href="#"><li>LOCATION</li></a>
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
        <div class="sale-item-container">
            <div class="sale-item-description">
            <?php 

            $sql = "SELECT * FROM product WHERE type = 3 ORDER BY RAND()";
            $result = mysqli_query($conn, $sql);

            $rs = mysqli_fetch_array($result);
            echo '<h1>'.$rs[2].'</h1>';
            echo '<p>'.$rs[4].'</p><br>';
            echo '<button class="buy-btn">Buy Now</button>';
            echo '</div>';
            echo '<div class="sale-item-img">';
            echo    '<img src="pictures/'.$rs[5].'" alt="">';
            echo '</div>';
            ?>

        </div>


        <div class="submenu-container">
            <nav class="submenu">
                <ul>
                    <li><a href="shop_keyboard.php"><img src="assets/keyboard-test.png" alt="" class="submenu-keyboard-img"><br>Keyboard</a></li>
                    <li><a href="shop_mouse.php"><img src="assets/mouse-test.png" alt="" class="submenu-mouse-img"><br>Mouse</a></li>
                    <li><a href="shop_headphone.php"><img src="assets/headphone-test.png" alt="" class="submenu-headphone-img"><br>Headphone</a></li>
                </ul>
            </nav>
        </div>

        <div class="main-shop-container">
            <div class="grid-container">
                <?php 

                    $sql = "SELECT * FROM product ORDER BY RAND()";
                    $result = mysqli_query($conn, $sql);
                
                    while ($rs = mysqli_fetch_array($result)) {

                        echo '<div class="card">';
                        echo '<div class="imgBox">';
                        echo '<img src="pictures/'.$rs[5].'" alt="mouse corsair" class="item-img">';
                        echo '</div>';
                        echo '';
                        echo '<div class="contentBox">';
                        echo '<h4>'.$rs[2].'</h4>';
                        echo '<h3 class="price">'.$rs[3].' ฿</h3>';
                        echo '<a href="#" class="buy">Buy Now</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
        
    </article>

    <footer>

    </footer>
    <?php 
        mysqli_close($conn);
    ?>
</body>
</html>