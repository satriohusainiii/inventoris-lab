<?php
// 1. Hubungkan ke database
include "../config/koneksi.php";

// Menghindari garis merah visual di VS Code
/** @var mysqli $koneksi */

// 2. Ambil kode_barang dari URL untuk mengambil data yang mau diedit
if (isset($_GET['kode_barang'])) {
    $kode_barang_lama = mysqli_real_escape_string($koneksi, $_GET['kode_barang']);
    
    // Query untuk mengambil data barang berdasarkan kode
    $result = mysqli_query($koneksi, "SELECT * FROM barang WHERE kode_barang = '$kode_barang_lama'");
    
    // Jika data ditemukan, masukkan ke dalam variabel $data
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>
                alert('Data barang tidak ditemukan!');
                window.location.href = 'data_barang.php';
              </script>";
        exit;
    }
} else {
    // Jika tidak ada parameter kode_barang di URL, kembalikan ke halaman utama
    header("Location: data_barang.php");
    exit;
}

// 3. Proses Update ketika Form di-Submit
if (isset($_POST['update'])) {
    $kode_barang = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $kategori    = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $jumlah      = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    $kondisi     = mysqli_real_escape_string($koneksi, $_POST['kondisi']);
    $status      = mysqli_real_escape_string($koneksi, $_POST['status']);
    $lokasi      = mysqli_real_escape_string($koneksi, $_POST['lokasi']);

    // Query Update Data berdasarkan kode barang lama
    $updateQuery = mysqli_query($koneksi, "UPDATE barang SET 
                    kode_barang = '$kode_barang',
                    nama_barang = '$nama_barang',
                    kategori = '$kategori',
                    jumlah = '$jumlah',
                    kondisi = '$kondisi',
                    status = '$status',
                    lokasi = '$lokasi'
                    WHERE kode_barang = '$kode_barang_lama'");

    if ($updateQuery) {
        echo "<script>
                alert('Data barang berhasil diperbarui!');
                window.location.href = 'data_barang.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');
              </script>";
    }
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Barang - Inventaris</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; background-color: #2d3436; color: white; padding-top: 50px; }
    .card { color: #333; }
  </style>
</head>
<body>

<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header bg-warning text-dark">
          <h5 class="mb-0 fw-semibold">Form Edit Data Barang</h5>
        </div>
        <div class="card-body">
          <form action="" method="POST">
            
            <div class="mb-3">
              <label class="form-label">Kode Barang</label>
              <input type="text" name="kode_barang" class="form-control" value="<?= htmlspecialchars($data['kode_barang']); ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Nama Barang</label>
              <input type="text" name="nama_barang" class="form-control" value="<?= htmlspecialchars($data['nama_barang']); ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Kategori</label>
              <input type="text" name="kategori" class="form-control" value="<?= htmlspecialchars($data['kategori']); ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Jumlah / Stok</label>
              <input type="number" name="jumlah" class="form-control" min="0" value="<?= htmlspecialchars($data['jumlah']); ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Kondisi</label>
              <select name="kondisi" class="form-select" required>
                <option value="Baik" <?= ($data['kondisi'] == 'Baik') ? 'selected' : ''; ?>>Baik</option>
                <option value="Rusak" <?= ($data['kondisi'] == 'Rusak') ? 'selected' : ''; ?>>Rusak</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Status</label>
              <select name="status" class="form-select" required>
                <option value="Tersedia" <?= ($data['status'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                <option value="Dipinjam" <?= ($data['status'] == 'Dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
                <option value="Perawatan" <?= ($data['status'] == 'Perawatan') ? 'selected' : ''; ?>>Perawatan</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Lokasi</label>
              <input type="text" name="lokasi" class="form-control" value="<?= htmlspecialchars($data['lokasi']); ?>" required>
            </div>

            <div class="d-flex justify-content-between">
              <a href="data_barang.php" class="btn btn-secondary">Kembali</a>
              <button type="submit" name="update" class="btn btn-warning text-dark fw-medium">Update Barang</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>