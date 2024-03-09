<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสินค้า</title>
</head>

<body>
    <h2>เพิ่มสินค้า</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="checkbox" id="1" name="productType[]" value="1">
        <label for="vehicle1"> keyboard</label><br>
        <input type="checkbox" id="2" name="productType[]" value="2">
        <label for="vehicle2"> mouse</label><br>
        <input type="checkbox" id="3" name="productType[]" value="3">
        <label for="vehicle3"> headphone</label><br><br>

        <label for="productName">ชื่อสินค้า:</label><br>
        <input type="text" id="productName" name="productName" placeholder="ชื่อสินค้า"><br><br>

        <label for="productPrice">ราคา:</label><br>
        <input type="text" id="productPrice" name="productPrice" placeholder="ราคา"><br>

        <label for="productDetail">รายละเอียด:</label><br>
        <input type="text" id="productDetail" name="productDetail" placeholder="รายละเอียด"><br>

        <label for="productImage">รูปภาพ:</label><br>
        <input type="file" id="productImage" name="productImage"><br><br>

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

        

        // เช็คว่ามีไฟล์รูปหรือไม่
        if(isset($_FILES["productImage"]) && $_FILES["productImage"]["error"] == UPLOAD_ERR_OK) {
            $target_dir = "../pictures/"; // โฟลเดอร์ที่จะเก็บรูป
            $target_file = $target_dir . basename($_FILES["productImage"]["name"]); // เอาชื่อไฟล์

            $filename = basename($_FILES["productImage"]["name"]);

            if(move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
                echo "<p>อัพโหลดรูปสำเร็จ</p>";
            } else {
                echo "<p>อัพโหลดรูปไม่สำเร็จ</p>";
            }
        } else {
            echo "<p>โปรดเลือกไฟล์รูป</p>";
            exit();
        }

        $insertSql = "INSERT INTO product (type, name, price, detail, image) VALUES ('$productType', '$productName', '$productPrice', '$productDetail', '$filename')";

        if (mysqli_query($conn, $insertSql)) {
            echo "<p>เพิ่มข้อมูลสำเร็จ</p>";
            // ทำการ redirect หลังจากการเพิ่มข้อมูล
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