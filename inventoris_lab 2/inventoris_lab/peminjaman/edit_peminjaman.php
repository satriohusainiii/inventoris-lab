<?php
include "../config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($koneksi,"
SELECT *
FROM peminjaman
WHERE id_peminjaman='$id'
");

$data = mysqli_fetch_assoc($query);

$mahasiswa = mysqli_query($koneksi,"SELECT * FROM mahasiswa ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<title>Edit Peminjaman</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:#f4f7fc;
}

.card{
    border:none;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.card-header{
    background:#0d6efd;
    color:white;
}

</style>

</head>

<body>

<div class="container py-5">

<div class="card">

<div class="card-header">

<h3>

<i class="bi bi-pencil-square"></i>

Edit Peminjaman

</h3>

</div>

<div class="card-body">

<form action="proses_edit.php" method="POST">

<input
type="hidden"
name="id_peminjaman"
value="<?= $data['id_peminjaman']; ?>">

<div class="mb-3">

<label>Mahasiswa</label>

<select
name="id_mahasiswa"
class="form-select"
required>

<?php
while($m=mysqli_fetch_assoc($mahasiswa)){
?>

<option
value="<?= $m['id_mahasiswa']; ?>"

<?= ($m['id_mahasiswa']==$data['id_mahasiswa']) ? "selected" : ""; ?>>

<?= $m['nim']; ?> - <?= $m['nama']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Tanggal Pinjam</label>

<input
type="date"
name="tanggal_pinjam"
class="form-control"
value="<?= $data['tanggal_pinjam']; ?>"
required>

</div>

<div class="mb-3">

<label>Rencana Kembali</label>

<input
type="date"
name="tanggal_rencana_kembali"
class="form-control"
value="<?= $data['tanggal_rencana_kembali']; ?>"
required>

</div>

<div class="mb-3">

<label>Tanggal Dikembalikan</label>

<input
type="date"
name="tanggal_dikembalikan"
class="form-control"
value="<?= $data['tanggal_dikembalikan']; ?>">

</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option value="Dipinjam"
<?= ($data['status']=="Dipinjam") ? "selected" : ""; ?>>
Dipinjam
</option>

<option value="Dikembalikan"
<?= ($data['status']=="Dikembalikan") ? "selected" : ""; ?>>
Dikembalikan
</option>

</select>

</div>

<div class="mb-3">

<label>Keterangan</label>

<textarea
name="keterangan"
class="form-control"
rows="3"><?= $data['keterangan']; ?></textarea>

</div>

<button
class="btn btn-primary">

<i class="bi bi-save"></i>

Update

</button>

<a
href="data_peminjaman.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</body>
</html>