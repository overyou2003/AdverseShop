<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign in</title>
</head>

<body>
    <h2>Sign in</h2>
    <form method="post" action="">
       
        <label for="productName">username:</label><br>
        <input type="text" id="username" name="username" placeholder="username"><br><br>

        <label for="productName">password:</label><br>
        <input type="text" id="password" name="password" placeholder="password"><br>

        <input type="hidden" id="role" name="role" value="user">
       
        <button type="submit" name="submit">OK</button>
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

    $username = mysqli_real_escape_string($conn, $_POST['username']); // ใช้ mysqli_real_escape_string เพื่อป้องกัน SQL Injection
    $password = mysqli_real_escape_string($conn, $_POST['password']); // ใช้ mysqli_real_escape_string เพื่อป้องกัน SQL Injection
    $role = mysqli_real_escape_string($conn, $_POST['role']); // ใช้ mysqli_real_escape_string เพื่อป้องกัน SQL Injection

    $insertSql = "INSERT INTO account (role ,username, password) VALUES ('$role', '$username', '$password')";

    if (mysqli_query($conn, $insertSql)) {
        echo "<p>เพิ่มข้อมูลสำเร็จ</p>";
        header("Location: login.php"); // ปรับเส้นทางไปยังไฟล์ login.php โดยตรง
        exit(); 
    } else {
        echo "<p>ผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($conn) . "</p>";
    }

    mysqli_close($conn);
}
?>


</body>

</html>
