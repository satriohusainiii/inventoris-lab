<?php
include "../config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background:#f4f7fc;">

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header bg-warning text-dark">

            <h4>
                <i class="bi bi-pencil-square"></i>
                Edit Data Mahasiswa
            </h4>

        </div>

        <div class="card-body">

            <form action="proses_edit.php" method="POST">

                <input type="hidden" name="id" value="<?= $data['id_mahasiswa']; ?>">

                <div class="mb-3">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control"
                    value="<?= $data['nim']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Nama Mahasiswa</label>
                    <input type="text" name="nama" class="form-control"
                    value="<?= $data['nama']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control"
                    value="<?= $data['kelas']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Program Studi</label>
                    <input type="text" name="prodi" class="form-control"
                    value="<?= $data['prodi']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control"
                    value="<?= $data['no_hp']; ?>" required>
                </div>

                <button type="submit" class="btn btn-warning">

                    <i class="bi bi-save"></i>

                    Update

                </button>

                <a href="data_mahasiswa.php" class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>