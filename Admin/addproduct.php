<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสินค้า</title>
</head>

<body>
    <h2>เพิ่มสินค้า</h2>
    <form method="post" action="">
        <input type="checkbox" id="1" name="productType[]" value="1">
        <label for="vehicle1"> keyboard</label><br>
        <input type="checkbox" id="2" name="productType[]" value="2">
        <label for="vehicle2"> mouse</label><br>
        <input type="checkbox" id="3" name="productType[]" value="3">
        <label for="vehicle3"> headphone</label><br><br>

        <label for="productName">ชื่อสินค้า:</label><br>
        <input type="text" id="productName" name="productName" placeholder="ชื่อสินค้า"><br><br>

        <label for="productName">ราคา:</label><br>
        <input type="text" id="productPrice" name="productPrice" placeholder="ราคา"><br>

        <label for="productName">รายละเอียด:</label><br>
        <input type="text" id="productDetail" name="productDetail" placeholder="รายละเอียด"><br>

        <button type="submit" name="submit">เพิ่มสินค้า</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "adverse";

        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("การเชื่อมต่อล้มเหลว: " . mysqli_connect_error());
        }

        mysqli_query($conn, "set character_set_connection=utf8mb4");
        mysqli_query($conn, "set character_set_client=utf8mb4");
        mysqli_query($conn, "set character_set_results=utf8mb4");

        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productDetail = $_POST['productDetail'];

        // ตรวจสอบว่ามีการเลือกสินค้าหรือไม่
        if(isset($_POST['productType'])) {
            $productType = $_POST['productType'][0]; // ใช้ตัวแรกใน array สำหรับประเภทสินค้า
        } else {
            $productType = ""; // ถ้าไม่ได้เลือกสินค้าก็เก็บเป็นค่าว่าง
        }

        $insertSql = "INSERT INTO product (type, name, price, detail) VALUES ('$productType', '$productName', '$productPrice', '$productDetail')";

        if (mysqli_query($conn, $insertSql)) {
            echo "<p>เพิ่มข้อมูลสำเร็จ</p>";
            header("Location: ../index.php"); 
            exit(); 
        } else {
            echo "<p>ผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($conn) . "</p>";
        }

        mysqli_close($conn);
    }
    ?>

</body>

</html>
