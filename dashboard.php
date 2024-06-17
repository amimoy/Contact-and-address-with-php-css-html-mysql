<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

echo "<p style='margin-top: 20px; color:green; margin-left:600px;'>Welcome, " . $_SESSION['user'] . "!</p>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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

.dashboard-links {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
}
    </style>
</head>
<body>

<a href='insert_record.php' style='display: inline-block; background-color: #4CAF50; margin-left:550px; color: #fff; padding: 10px 20px; margin-top: 10px; text-decoration: none; border-radius: 4px;'>Insert new record</a>
<a href='view_records.php' style='display: inline-block; background-color: #4CAF50;margin-left:50px; color: #fff; padding: 10px 20px; margin-top: 10px; text-decoration: none; border-radius: 4px;'>View records</a>

</body>
</html>
