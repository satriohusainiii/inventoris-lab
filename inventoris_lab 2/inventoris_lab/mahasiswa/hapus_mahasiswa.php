<?php
include "../config/koneksi.php";

// Ambil ID dari URL
$id = $_GET['id'];

// Query hapus data
$query = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mahasiswa='$id'");

// Cek hasil
if ($query) {
    echo "<script>
        alert('Data mahasiswa berhasil dihapus!');
        window.location='data_mahasiswa.php';
    </script>";
} else {
    echo "<script>
        alert('Data mahasiswa gagal dihapus!');
        window.location='data_mahasiswa.php';
    </script>";
}
?>