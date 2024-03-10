<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    
    $con = mysqli_connect("localhost","root","","adverse") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // รับข้อมูลจากฟอร์ม
        $id_acc = $_POST["ID_ACC"];
        $id_pro = $_POST["ID_PRO"];
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $sql = "INSERT INTO orderlist (ID_ACC , ID_PRO) VALUES ('$id_acc', '$id_pro')";
        if ($con->query($sql) === TRUE) {
            echo "บันทึกข้อมูลสำเร็จ";
            header("Location: ../Admin/management.php");
        } else {
            echo "ผิดพลาด: " . $sql . "<br>" . $con->error;
        }
    }
    ?>
    
</body>
</html>