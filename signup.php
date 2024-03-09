<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Sign Up</title>
</head>

<body>
    <div class="login-container">
        <h2>Sign Up</h2>
        <form method="post" action="">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" placeholder="Enter username"><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Enter password"><br>

            <input type="hidden" id="role" name="role" value="user">

            <button type="submit" name="submit">OK</button>
        </form>
        <a href="login.php">Already have an account? Login here</a>
    </div>

    <?php
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
        $role = mysqli_real_escape_string($conn, $_POST['role']);

        $insertSql = "INSERT INTO account (role ,username, password) VALUES ('$role', '$username', '$password')";

        if (mysqli_query($conn, $insertSql)) {
            echo "<p>Account created successfully!</p>";
            header("Location: login.php");
            exit();
        } else {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }

        mysqli_close($conn);
    }
    ?>
</body>

</html>
