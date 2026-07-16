<?php

include "../config/koneksi.php";

$id_mahasiswa = $_POST['id_mahasiswa'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$tanggal_rencana_kembali = $_POST['tanggal_rencana_kembali'];
$tanggal_dikembalikan = $_POST['tanggal_dikembalikan'];
$status = $_POST['status'];
$keterangan = $_POST['keterangan'];

$query = mysqli_query($koneksi,"
INSERT INTO peminjaman
(
id_mahasiswa,
tanggal_pinjam,
tanggal_rencana_kembali,
tanggal_dikembalikan,
status,
keterangan
)
VALUES
(
'$id_mahasiswa',
'$tanggal_pinjam',
'$tanggal_rencana_kembali',
'$tanggal_dikembalikan',
'$status',
'$keterangan'
)
");

if($query){

echo "<script>
alert('Data berhasil ditambahkan');
window.location='data_peminjaman.php';
</script>";

}else{

echo "<script>
alert('Data gagal ditambahkan');
window.location='tambah_peminjaman.php';
</script>";

}

?>