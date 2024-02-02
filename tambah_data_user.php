<?php
session_start();
include "config.php";

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fungsi untuk menyimpan data pengguna baru ke dalam database
function tambahDataUser($data) {
    global $conn;
    $username = $data['username'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Proses form jika ada request dari POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];
        tambahDataUser($data);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pengguna</title>

    <style>
        body {
            background: linear-gradient(to right, orange, green);
            text-align: center;
        }

        form {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="submit"] {
            background-color: green;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Tambah Data Pengguna</h2>

<form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <br>
    <input type="submit" name="add" value="Tambah Data Pengguna">
</form>

</body>
</html>