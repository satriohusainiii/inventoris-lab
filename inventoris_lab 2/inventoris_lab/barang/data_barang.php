<?php
include "../config/koneksi.php";

if (isset($_GET['cari'])) {
    $keyword = $_GET['keyword'];
    $query = mysqli_query($koneksi, "
        SELECT *
        FROM barang
        WHERE kode_barang LIKE '%$keyword%'
        OR nama_barang LIKE '%$keyword%'
        OR kategori LIKE '%$keyword%'
        OR lokasi LIKE '%$keyword%'
    ");
} else {
    $query = mysqli_query($koneksi, "
        SELECT *
        FROM barang
        ORDER BY id_barang DESC
    ");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../dist/css/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-dark text-white p-4 sidebar">
                <h2 class="logo-title">Inventaris Lab</h2>
                <div class="sidebar-menu">
                    <a href="../dashboard.php" class="menu"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    <a href="data_barang.php" class="menu active-menu"><i class="bi bi-box-seam"></i> Data Barang</a>
                    <a href="../mahasiswa/data_mahasiswa.php" class="menu"><i class="bi bi-people"></i> Data Mahasiswa</a>
                    <a href="../peminjaman/data_peminjaman.php" class="menu"><i class="bi bi-clipboard-check"></i> Peminjaman</a>
                    <a href="../laporan/laporan.php" class="menu"><i class="bi bi-file-earmark-text"></i> Laporan</a>
                    <div class="mt-auto">
                        <hr>
                        <a href="../logout.php" class="menu logout-menu"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    </div>
                </div>
            </div>

            <div class="col-md-10 p-0">
                <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm px-4">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-light me-3"><i class="bi bi-list fs-5"></i></button>
                        <h5 class="mb-0 fw-bold">Data Barang</h5>
                    </div>
                    <div class="ms-auto d-flex align-items-center">
                        <button class="btn btn-light me-3"><i class="bi bi-bell fs-5"></i></button>
                        <button class="btn btn-light"><i class="bi bi-person-circle"></i> Admin</button>
                    </div>
                </nav>

                <div class="p-4">
                    <div class="mb-4">
                        <h2 class="fw-bold">Data Barang</h2>
                        <p class="text-muted">Kelola seluruh data inventaris laboratorium.</p>
                    </div>

                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">
                                    <i class="bi bi-box-seam-fill text-primary"></i> Data Barang
                                </h5>
                                <a href="tambah_barang.php" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Tambah Barang
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="GET">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <input type="text" name="keyword" class="form-control" placeholder="Cari Kode Barang, Nama Barang..." value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" name="cari" class="btn btn-primary w-100">
                                            <i class="bi bi-search"></i> Cari
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="data_barang.php" class="btn btn-secondary w-100">Reset</a>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover align-middle">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th style="width: 50px;">No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Lokasi</th>
                                            <th style="width: 150px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        // Cek apakah ada data hasil query
                                        if (mysqli_num_rows($query) > 0) {
                                            // Lakukan perulangan untuk mengeluarkan data dari database
                                            while ($row = mysqli_fetch_assoc($query)) { 
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="fw-bold text-center"><?= htmlspecialchars($row['kode_barang']); ?></td>
                                            <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                                            <td><?= htmlspecialchars($row['kategori']); ?></td>
                                            <td class="text-center"><?= htmlspecialchars($row['jumlah'] ?? '0'); ?></td>
                                            <td><?= htmlspecialchars($row['lokasi']); ?></td>
                                            <td class="text-center">
                                                <a href="edit_barang.php?id=<?= $row['id_barang']; ?>" class="btn btn-sm btn-warning text-white">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="hapus_barang.php?id=<?= $row['id_barang']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                            } 
                                        } else { 
                                        ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">Data barang tidak ditemukan atau masih kosong.</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>