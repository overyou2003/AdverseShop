<?php
//1. เชื่อมต่อ database: 
include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
  
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
    $id = $_GET["ID_OR"];
	$sql = "SELECT * FROM orderlist WHERE ID_OR ='$id' ";
    $result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
    $row = mysqli_fetch_array($result);
    

//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 

// $sql = "update product set name = '$name',price = '$price',Detail = '$detail' where ID_PRO=$id";
	$sql = "DELETE FROM orderlist  
			WHERE ID_OR='$id' ";
 
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
 
mysqli_close($con); //ปิดการเชื่อมต่อ database 

header("Location: ../Admin/order.php");

?>