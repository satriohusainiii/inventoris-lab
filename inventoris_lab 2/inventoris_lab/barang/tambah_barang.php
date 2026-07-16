<?php
// 1. Hubungkan ke database
include "../config/koneksi.php";

// 2. Proses Insert ketika Form di-Submit
if (isset($_POST['simpan'])) {
    $kode_barang = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $kategori    = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $jumlah      = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    $kondisi     = mysqli_real_escape_string($koneksi, $_POST['kondisi']);
    $status      = mysqli_real_escape_string($koneksi, $_POST['status']);
    $lokasi      = mysqli_real_escape_string($koneksi, $_POST['lokasi']);

    // Cek apakah kode barang sudah ada sebelumnya
    $cek_kode = mysqli_query($koneksi, "SELECT kode_barang FROM barang WHERE kode_barang = '$kode_barang'");
    if (mysqli_num_rows($cek_kode) > 0) {
        echo "<script>alert('Kode barang sudah terdaftar! Gunakan kode lain.');</script>";
    } else {
        // Query Insert Data
        $insertQuery = mysqli_query($koneksi, "INSERT INTO barang (kode_barang, nama_barang, kategori, jumlah, kondisi, status, lokasi) 
                        VALUES ('$kode_barang', '$nama_barang', '$kategori', '$jumlah', '$kondisi', '$status', '$lokasi')");

        if ($insertQuery) {
            echo "<script>
                    alert('Data barang berhasil ditambahkan!');
                    window.location.href = 'data_barang.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "');
                  </script>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Barang - Inventaris</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; background-color: #2d3436; color: white; padding-top: 50px; }
    .card { color: #333; }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header bg-success text-white">
          <h5 class="mb-0">Form Tambah Barang Baru</h5>
        </div>
        <div class="card-body">
          <form action="" method="POST">
            
            <div class="mb-3">
              <label class="form-label">Kode Barang</label>
              <input type="text" name="kode_barang" class="form-control" placeholder="Contoh: BRG001" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Nama Barang</label>
              <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Kategori</label>
              <input type="text" name="kategori" class="form-control" placeholder="Kategori (Elektronik, ATK, dll)" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Jumlah / Stok</label>
              <input type="number" name="jumlah" class="form-control" min="0" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Kondisi</label>
              <select name="kondisi" class="form-select" required>
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Status</label>
              <select name="status" class="form-select" required>
                <option value="Tersedia">Tersedia</option>
                <option value="Dipinjam">Dipinjam</option>
                <option value="Perawatan">Perawatan</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Lokasi</label>
              <input type="text" name="lokasi" class="form-control" placeholder="Lokasi Penyimpanan" required>
            </div>

            <div class="d-flex justify-content-between">
              <a href="data_barang.php" class="btn btn-secondary">Kembali</a>
              <button type="submit" name="simpan" class="btn btn-success">Simpan Barang</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>