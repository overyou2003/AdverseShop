<?php
//1. เชื่อมต่อ database: 
include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
  
//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
    $id = $_POST["ID_PRO"];
	$name = $_POST["name"];
	$price = $_POST["price"];
	$detail = $_POST["detail"];
	
 
//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database 

// $sql = "update product set name = '$name',price = '$price',Detail = '$detail' where ID_PRO=$id";
	$sql = "UPDATE product SET  
			name='$name' ,
			price='$price' , 
			detail='$detail'
			WHERE ID_PRO='$id' ";
 
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
 
mysqli_close($con); //ปิดการเชื่อมต่อ database 

header("Location: ../Admin/management.php")
 

?>