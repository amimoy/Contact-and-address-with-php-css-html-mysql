<!DOCTYPE html>
<html>
<head>
    <title>View Records</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            margin-top:100px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .record-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .record-table th,
        .record-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .record-table th {
            background-color: #4CAF50;
            color: white;
        }

        .record-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .record-table tr:hover {
            background-color: #ddd;
        }
        .lnktodsb{
            color: blue;
            font-size: 20px;
            background-color: aqua;
        }
    </style>
</head>
<body>
    <div class="container">
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

        $stmt = $conn->prepare("SELECT id FROM registration WHERE email = ?");
        $stmt->bind_param("s", $_SESSION['user']);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();

        $stmt = $conn->prepare("SELECT id, name, mobile, address FROM address_book WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $mobile, $address);

        echo "<table class='record-table'>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>";

        while ($stmt->fetch()) {
            echo "<tr>
                    <td>$name</td>
                    <td>$mobile</td>
                    <td>$address</td>
                    <td>
                        <a href='update_record.php?id=$id'>Update</a>
                        <a href='delete_record.php?id=$id'>Delete</a>
                    </td>
                </tr>";
        }

        echo "</table>";

        $stmt->close();
        $conn->close();
        ?>
    </div>
   <center><a href="dashboard.php" class="lnktodsb">Go to Dashboard</a></center>
</body>
</html>

