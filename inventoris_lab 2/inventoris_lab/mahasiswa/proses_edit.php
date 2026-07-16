<?php
include "../config/koneksi.php";

$id    = $_POST['id'];
$nim   = $_POST['nim'];
$nama  = $_POST['nama'];
$kelas = $_POST['kelas'];
$prodi = $_POST['prodi'];
$no_hp = $_POST['no_hp'];

$query = mysqli_query($koneksi, "UPDATE mahasiswa SET

nim='$nim',
nama='$nama',
kelas='$kelas',
prodi='$prodi',
no_hp='$no_hp'

WHERE id_mahasiswa='$id'");

if($query){

    echo "<script>

    alert('Data berhasil diubah');

    window.location='data_mahasiswa.php';

    </script>";

}else{

    echo "<script>

    alert('Data gagal diubah');

    window.location='edit_mahasiswa.php?id=$id';

    </script>";

}
?>