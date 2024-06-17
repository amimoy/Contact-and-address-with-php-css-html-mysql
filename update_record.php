<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "user_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE address_book SET name = ?, mobile = ?, address = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $mobile, $address, $id);

    if ($stmt->execute()) {
        echo "<p style='margin-top: 20px; margin-left:600px;color:#fff;border-radius: 4px; background-color:green; width:300px; text-align:center;'>Record updated successfully!</p>";
    } else {
        echo "<p style='margin-top: 20px; background-color: #f44336; color: red; padding: 10px; border-radius: 4px;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    header("Location: view_records.php");
    exit;
} else {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT name, mobile, address FROM address_book WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($name, $mobile, $address);
    $stmt->fetch();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record</title>
    <style>
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

#update-form {
    width: 50%;
    margin: 0 auto;
}

    </style>
</head>
<body>
    <form method="post" action="" id="update-form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        Name: <br><input type="text" name="name" value="<?php echo $name; ?>" required><br>
        Mobile: <br><input type="text" name="mobile" value="<?php echo $mobile; ?>" required><br>
        Address:<br> <textarea name="address" required><?php echo $address; ?></textarea><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
