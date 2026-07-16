<?php
// 1. Hubungkan ke database
include "../config/koneksi.php";

// 2. Tangkap ID di baris paling atas dari URL
if (isset($_GET['id'])) {
    $id =$_GET['id'];

    // 3. Amankan variabel untuk mencegah SQL Injection
    $id = mysqli_real_escape_string($koneksi,$id);

    // 4. Jalankan perintah hapus
    $query = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang = '$id'");

    // 5. Cek apakah penghapusan berhasil
    if ($query) {
        echo "<script>
                alert('Data barang berhasil dihapus!');
                window.location.href = 'data_barang.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
                window.location.href = 'data_barang.php';
              </script>";
    }
} else {
    // Jika tidak ada ID di URL, kembalikan ke dashboard
    header("Location: data_barang.php");
    exit;
}
?>