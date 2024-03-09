<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" placeholder="Enter username"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" placeholder="Enter password"><br><br>
        <button type="submit" name="submit">Login</button>

        <a href="signup.php">sign up</a>
    </form>

    <?php
    session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "adverse";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_query($conn, "set character_set_connection=utf8mb4");
    mysqli_query($conn, "set character_set_client=utf8mb4");
    mysqli_query($conn, "set character_set_results=utf8mb4");

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM account WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);



    if (mysqli_num_rows($result) == 1) {

        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user_data['username']; 
        $_SESSION['role'] = $user_data['role']; 
        header("Location: index.php");
        exit();
    } else {
        header("Location: signup.php");
    }

    mysqli_close($conn);
}
?>
</body>
</html>
