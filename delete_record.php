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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM address_book WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<p style='margin-top: 20px; margin-left:600px;color:#fff;border-radius: 4px; background-color:green; width:300px; text-align:center;'>Record deleted successfully!</p>";
    }
    else {
        echo "<p style='margin-top: 20px; background-color: #f44336; color: red; padding: 10px; border-radius: 4px;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
header("Location: view_records.php");
exit;
?>