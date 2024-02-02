<?php
include "config.php";

// Fungsi untuk mendapatkan data dari database
function getData() {
    global $conn;
    $sql = "SELECT * FROM surat_tugas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Fungsi untuk mendapatkan data berdasarkan ID
function getDataById($id) {
    global $conn;
    $sql = "SELECT * FROM surat_tugas WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Fungsi untuk mengupdate data berdasarkan ID
function updateData($id, $data) {
    global $conn;
    $no = $data['no'];
    $nama = $data['nama'];
    $departemen = $data['departemen'];
    $hari = $data['hari'];
    $tanggal = $data['tanggal'];
    $lokasi = $data['lokasi'];
    $keterangan = $data['keterangan'];
    $jam_berangkat = $data['jam_berangkat'];
    $jam_pulang = $data['jam_pulang'];
    $menugaskan = $data['menugaskan'];

    $sql = "UPDATE surat_tugas SET 
            no='$no', nama='$nama', departemen='$departemen', hari='$hari', tanggal='$tanggal', 
            lokasi='$lokasi', keterangan='$keterangan', jam_berangkat='$jam_berangkat', 
            jam_pulang='$jam_pulang', menugaskan='$menugaskan' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk menghapus data berdasarkan ID
function deleteData($id) {
    global $conn;

    $sql = "DELETE FROM surat_tugas WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['update'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $data = [
        'no' => isset($_POST['no']) ? $_POST['no'] : '',
        'nama' => isset($_POST['nama']) ? $_POST['nama'] : '',
        'departemen' => isset($_POST['departemen']) ? $_POST['departemen'] : '',
        'hari' => isset($_POST['hari']) ? $_POST['hari'] : '',
        'tanggal' => isset($_POST['tanggal']) ? $_POST['tanggal'] : '',
        'lokasi' => isset($_POST['lokasi']) ? $_POST['lokasi'] : '',
        'keterangan' => isset($_POST['keterangan']) ? $_POST['keterangan'] : '',
        'jam_berangkat' => isset($_POST['jam_berangkat']) ? $_POST['jam_berangkat'] : '',
        'jam_pulang' => isset($_POST['jam_pulang']) ? $_POST['jam_pulang'] : '',
        'menugaskan' => isset($_POST['menugaskan']) ? $_POST['menugaskan'] : ''
    ];
    updateData($id, $data);
} elseif (isset($_POST['delete'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    deleteData($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Surat Tugas</title>
</head>
      
<style>
    body {
        background: linear-gradient(to right, orange, green);
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 80%;
        margin: 20px auto;
        background-color: white;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #333;
        color: white;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    form {
        display: inline-block;
    }
    body {
            background: linear-gradient(to right, orange, green);
            text-align: center;
        }

        form {
            margin: 20px;
        }

        button {
            background-color: black;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
</style>

<body>

<h2>Data Surat Tugas</h2>
<form action="tambah_data.php" method="post">
    <button type="submit">Tambah Data</button>
</form><table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Departemen</th>
        <th>Hari</th>
        <th>Tanggal</th>
        <th>Lokasi</th>
        <th>Keterangan</th>
        <th>Jam Berangkat</th>
        <th>Jam Pulang</th>
        <th>Menugaskan</th>
        <th>Action</th>
    </tr>
    <?php
    $dataList = getData();
    foreach ($dataList as $data) :
    ?>
        <tr>
            <td><?= $data['id']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['departemen']; ?></td>
            <td><?= $data['hari']; ?></td>
            <td><?= $data['tanggal']; ?></td>
            <td><?= $data['lokasi']; ?></td>
            <td><?= $data['keterangan']; ?></td>
            <td><?= $data['jam_berangkat']; ?></td>
            <td><?= $data['jam_pulang']; ?></td>
            <td><?= $data['menugaskan']; ?></td>
            <td>
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                    <input type="hidden" name="nama" value="<?= $data['nama']; ?>">
                    <input type="hidden" name="departemen" value="<?= $data['departemen']; ?>">
                    <input type="hidden" name="hari" value="<?= $data['hari']; ?>">
                    <input type="hidden" name="tanggal" value="<?= $data['tanggal']; ?>">
                    <input type="hidden" name="lokasi" value="<?= $data['lokasi']; ?>">
                    <input type="hidden" name="keterangan" value="<?= $data['keterangan']; ?>">
                    <input type="hidden" name="jam_berangkat" value="<?= $data['jam_berangkat']; ?>">
                    <input type="hidden" name="jam_pulang" value="<?= $data['jam_pulang']; ?>">
                    <input type="hidden" name="menugaskan" value="<?= $data['menugaskan']; ?>">
                    <input type="submit" name="edit" value="Edit">
                    <input type="submit" name="delete" value="Delete">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
// Tampilkan form edit jika tombol "Edit" diklik
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $data = getDataById($id);
    ?>
    <h2>Edit Data Surat Tugas</h2>
    <form method="POST" action="">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required>
        <br>
        <label for="departemen">Departemen:</label>
        <input type="text" name="departemen" value="<?= $data['departemen']; ?>" required>
        <br>
        <label for="hari">Hari:</label>
        <input type="text" name="hari" value="<?= $data['hari']; ?>" required>
        <br>
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" value="<?= $data['tanggal']; ?>" required>
        <br>
        <label for="lokasi">Lokasi:</label>
        <input type="text" name="lokasi" value="<?= $data['lokasi']; ?>" required>
        <br>
        <label for="keterangan">Keterangan:</label>
        <textarea name="keterangan" required><?= $data['keterangan']; ?></textarea>
        <br>
        <label for="jam_berangkat">Jam Berangkat:</label>
        <input type="time" name="jam_berangkat" value="<?= $data['jam_berangkat']; ?>" required>
        <br>
        <label for="jam_pulang">Jam Pulang:</label>
        <input type="time" name="jam_pulang" value="<?= $data['jam_pulang']; ?>" required>
        <br>
        <label for="menugaskan">Menugaskan:</label>
        <input type="text" name="menugaskan" value="<?= $data['menugaskan']; ?>" required>
        <br>
        <input type="submit" name="update" value="Update">
    </form>
    <?php
}
?>

</body>
</html>
