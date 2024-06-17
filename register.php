<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "user_management");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO registration (name, email, mobile, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $mobile, $password);

    if ($stmt->execute()) {
        $stmt = $conn->prepare("INSERT INTO user_login (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();

        echo "<p style='margin-top: 20px; margin-left:600px;color:#fff;border-radius: 4px; background-color:green; width:300px; text-align:center;'>Registration successful!</p>";
    } else {
        echo "<p style='margin-top: 20px; background-color: #f44336; color: #fff; padding: 10px; border-radius: 4px;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <style>
     /* General Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

input[type="text"],
input[type="email"],
input[type="password"],
textarea {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
textarea:focus {
    border-color: #4CAF50;
}

input[type="submit"],
button,
a {
    display: inline-block;
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s;
}

input[type="submit"]:hover,
button:hover,
a:hover {
    background-color: #45a049;
}

#register-form {
    width: 50%;
    margin: 0 auto;
}

    </style>
</head>
<body>
    <form method="post" action="" id="register-form">
        Name:<br> <input type="text" name="name" required><br>
        Email:<br> <input type="email" name="email" required><br>
        Mobile:<br> <input type="text" name="mobile" required><br>
        Password:<br> <input type="password" name="password" required><br><bR>
        <input type="submit" value="Register">
        <button  style=" padding:0px;margin-left:10px;"><a href="login.php">Login</a></button>
    </form>
</body>
</html>
