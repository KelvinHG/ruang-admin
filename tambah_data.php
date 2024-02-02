<?php
session_start();

include "config.php";

function sanitizeData($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

function tambahData($data) {
    global $conn;

    $nama = sanitizeData($data['nama']);
    $departemen = sanitizeData($data['departemen']);
    $hari = sanitizeData($data['hari']);
    $tanggal = sanitizeData($data['tanggal']);
    $lokasi = sanitizeData($data['lokasi']);
    $keterangan = sanitizeData($data['keterangan']);
    $jam_berangkat = sanitizeData($data['jam_berangkat']);
    $jam_pulang = sanitizeData($data['jam_pulang']);
    $menugaskan = sanitizeData($data['menugaskan']);

    $sql = "INSERT INTO surat_tugas (nama, departemen, hari, tanggal, lokasi, keterangan, jam_berangkat, jam_pulang, menugaskan) 
            VALUES ('$nama', '$departemen', '$hari', '$tanggal', '$lokasi', '$keterangan', '$jam_berangkat', '$jam_pulang', '$menugaskan')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $data = [
        'nama' => $_POST['nama'],
        'departemen' => $_POST['departemen'],
        'hari' => $_POST['hari'],
        'tanggal' => $_POST['tanggal'],
        'lokasi' => $_POST['lokasi'],
        'keterangan' => $_POST['keterangan'],
        'jam_berangkat' => $_POST['jam_berangkat'],
        'jam_pulang' => $_POST['jam_pulang'],
        'menugaskan' => $_POST['menugaskan']
    ];
    tambahData($data);
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Data Surat Tugas</title>

        <style>
            body {
                background: linear-gradient(to right, white, white);
                text-align: center;
            }

            form {
                width: 70%;
                margin: 90px auto;
                padding: 100px;
                background: linear-gradient(to right, orange, green);
                border-radius: 80px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            input[type="submit"] {
                background-color: green;
                color: white;
                padding: 10px 16px;
                border: none;
                border-radius: 40px;
                cursor: pointer;
            }
            label {
                font-size: 150%;
            }

            table {
                width: 100%;
                margin: 60px auto;
                border-collapse: collapse;
            }

        table, th, td {
            border: 70px solid black;
        }

        th, td {
            padding: 50px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Tambah Data Surat Tugas</h2>

<!-- Formulir untuk menambahkan data baru -->
<form method="POST" action="">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" required style="width: 100%; height: 50px;">
    <br>
    <label for="departemen">Departemen:</label>
    <input type="text" name="departemen" required style="width: 100%; height: 50px;">
    <br>
    <label for="hari">Hari:</label>
    <input type="text" name="hari" required style="width: 100%; height: 50px;">
    <br>
    <label for="tanggal">Tanggal:</label>
    <input type="date" name="tanggal" required style="width: 100%; height: 50px;">
    <br>
    <label for="lokasi">Lokasi:</label>
    <input type="text" name="lokasi" required style="width: 100%; height: 50px;">
    <br>
    <label for="keterangan">Keterangan:</label>
    <textarea name="keterangan" required style="width: 100%; height: 50px;"></textarea>
    <br>
    <label for="jam_berangkat">Jam Berangkat:</label>
    <input type="time" name="jam_berangkat" required style="width: 100%; height: 50px;">
    <br>
    <label for="jam_pulang">Jam Pulang:</label>
    <input type="time" name="jam_pulang" required style="width: 100%; height: 50px;">
    <br>
    <label for="menugaskan">Menugaskan:</label>
    <input type="text" name="menugaskan" required style="width: 100%; height: 50px;">
    <br>
    <input type="submit" name="add" value="Tambah Data">
</form>

</body>
</html>
