<?php
include "../config/koneksi.php";

// mengambil data mahasiswa
$mahasiswa = mysqli_query($koneksi,"SELECT * FROM mahasiswa ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tambah Peminjaman</title>

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

.btn{
    border-radius:8px;
}

</style>

</head>
<body>

<div class="container py-5">

<div class="card">

<div class="card-header">

<h3>
<i class="bi bi-plus-circle"></i>
Tambah Peminjaman
</h3>

</div>

<div class="card-body">

<form action="proses_tambah.php" method="POST">

<div class="mb-3">

<label class="form-label">Mahasiswa</label>

<select name="id_mahasiswa" class="form-select" required>

<option value="">-- Pilih Mahasiswa --</option>

<?php while($m=mysqli_fetch_assoc($mahasiswa)){ ?>

<option value="<?= $m['id_mahasiswa']; ?>">

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
required>

</div>

<div class="mb-3">

<label>Rencana Kembali</label>

<input
type="date"
name="tanggal_rencana_kembali"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Tanggal Dikembalikan</label>

<input
type="date"
name="tanggal_dikembalikan"
class="form-control">

</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option value="Dipinjam">Dipinjam</option>

<option value="Dikembalikan">Dikembalikan</option>

</select>

</div>

<div class="mb-3">

<label>Keterangan</label>

<textarea
name="keterangan"
class="form-control"
rows="3"></textarea>

</div>

<button class="btn btn-primary">

<i class="bi bi-save"></i>

Simpan

</button>

<a href="data_peminjaman.php" class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</body>
</html>