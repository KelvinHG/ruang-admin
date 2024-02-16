<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Delete the record with the specified ID
        $queryDelete = "DELETE FROM surat_tugas WHERE id = $id";
        if (mysqli_query($koneksi, $queryDelete)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($koneksi);
        }
    }
}
?>
