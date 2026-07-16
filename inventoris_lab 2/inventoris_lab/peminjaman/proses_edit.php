<?php

include "../config/koneksi.php";

$id = $_POST['id_peminjaman'];
$id_mahasiswa = $_POST['id_mahasiswa'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$tanggal_rencana_kembali = $_POST['tanggal_rencana_kembali'];
$tanggal_dikembalikan = $_POST['tanggal_dikembalikan'];
$status = $_POST['status'];
$keterangan = $_POST['keterangan'];

$query = mysqli_query($koneksi,"
UPDATE peminjaman SET

id_mahasiswa='$id_mahasiswa',
tanggal_pinjam='$tanggal_pinjam',
tanggal_rencana_kembali='$tanggal_rencana_kembali',
tanggal_dikembalikan='$tanggal_dikembalikan',
status='$status',
keterangan='$keterangan'

WHERE id_peminjaman='$id'
");

if($query){

echo "<script>

alert('Data berhasil diubah');

window.location='data_peminjaman.php';

</script>";

}else{

echo "<script>

alert('Data gagal diubah');

window.location='edit_peminjaman.php?id=$id';

</script>";

}

?>