<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../config/koneksi.php";

// Cek apakah form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nim   = $_POST['nim'];
    $nama  = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $prodi = $_POST['prodi'];
    $no_hp = $_POST['no_hp'];

    $query = mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, nama, kelas, prodi, no_hp)
    VALUES ('$nim', '$nama', '$kelas', '$prodi', '$no_hp')");

    if ($query) {
        echo "<script>
            alert('Data mahasiswa berhasil ditambahkan');
            window.location='data_mahasiswa.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

} else {
    // Kalau file dibuka langsung
    header("Location: tambah_mahasiswa.php");
    exit;
}
?>