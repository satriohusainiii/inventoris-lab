<?php
include "../config/koneksi.php";

if(isset($_GET['cari'])){

    $keyword = $_GET['keyword'];

    $query = mysqli_query($koneksi,"
    SELECT *
    FROM peminjaman
    INNER JOIN mahasiswa
    ON peminjaman.id_mahasiswa=mahasiswa.id_mahasiswa
    WHERE
        mahasiswa.nama LIKE '%$keyword%'
        OR mahasiswa.nim LIKE '%$keyword%'
        OR peminjaman.status LIKE '%$keyword%'
        OR peminjaman.tanggal_pinjam LIKE '%$keyword%'
    ORDER BY id_peminjaman DESC
    ");

}else{

    $query = mysqli_query($koneksi,"
    SELECT *
    FROM peminjaman
    INNER JOIN mahasiswa
    ON peminjaman.id_mahasiswa=mahasiswa.id_mahasiswa
    ORDER BY id_peminjaman DESC
    ");

}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../dist/css/style.css">
    <style>
        body {
            background: #f4f7fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Pengaturan Layout Sidebar & Konten */
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 24px;
        }
        
        .main-content {
            margin-left: 16.666667%; /* Menyesuaikan lebar col-md-2 agar tidak tertimpa fixed sidebar */
        }

        .logo-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 30px;
            color: #fff;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            height: calc(100vh - 100px);
        }

        .menu {
            display: block;
            padding: 12px 15px;
            color: #c2c7d0;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.3s;
        }

        .menu:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .menu i {
            margin-right: 10px;
        }

        /* Menu Peminjaman Aktif */
        .active-menu {
            background-color: #0d6efd !important;
            color: white !important;
            font-weight: 500;
        }

        .logout-menu {
            color: #dc3545;
        }

        .logout-menu:hover {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,.08);
        }

        /* Posisi Khusus Header Card agar mendukung posisi absolut tombol */
        .card-header-custom {
            position: relative; /* Menjadi patokan koordinat tombol */
            background-color: #0d6efd !important;
            color: white !important;
            padding: 15px 20px;
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
        }

        /* TOMBOL TAMBAH MEKSO KANAN (Sesuai Titik Panah Merah) */
        .btn-tambah-kanan {
            position: absolute;
            right: 20px; /* Jarak presisi dari tepi kanan */
            top: 50%;
            transform: translateY(-50%); /* Menyeimbangkan posisi vertikal di tengah */
            z-index: 10;
        }

        .table thead {
            background: #0d6efd;
            color: white;
        }

        .table tbody tr:hover {
            background: #f1f7ff;
        }

        .btn {
            border-radius: 8px;
        }

        h3 {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-2 sidebar text-white">
                <h2 class="logo-title">Inventaris Lab</h2>
                <div class="sidebar-menu">
                    <a href="../dashboard.php" class="menu">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="../barang/data_barang.php" class="menu">
                        <i class="bi bi-box-seam"></i> Data Barang
                    </a>
                    <a href="../mahasiswa/data_mahasiswa.php" class="menu">
                        <i class="bi bi-people"></i> Data Mahasiswa
                    </a>
                    <a href="data_peminjaman.php" class="menu active-menu">
                        <i class="bi bi-clipboard-check"></i> Peminjaman
                    </a>
                    <a href="../laporan/laporan.php" class="menu">
                        <i class="bi bi-file-earmark-text"></i> Laporan
                    </a>
                    
                    <div class="mt-4">
                        <hr>
                        <a href="../logout.php" class="menu logout-menu">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-10 main-content p-0">
                
                <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm px-4 py-3">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-light me-3"><i class="bi bi-list fs-5"></i></button>
                        <h5 class="mb-0 fw-bold">Data Peminjaman</h5>
                    </div>
                    <div class="ms-auto d-flex align-items-center">
                        <button class="btn btn-light me-3"><i class="bi bi-bell fs-5"></i></button>
                        <button class="btn btn-light"><i class="bi bi-person-circle"></i> Admin</button>
                    </div>
                </nav>

                <div class="p-4">
                    
                    <div class="mb-4">
                        <h2 class="fw-bold text-dark">Data Peminjaman</h2>
                        <p class="text-muted">Kelola seluruh transaksi peminjaman barang laboratorium.</p>
                    </div>

                    <div class="card">
                        <div class="card-header-custom d-flex align-items-center">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-clipboard-check-fill me-2"></i> Data Peminjaman
                            </h5>
                            <a href="tambah_peminjaman.php" class="btn btn-light text-primary fw-bold btn-tambah-kanan">
                                <i class="bi bi-plus-circle-fill"></i> Tambah Peminjaman
                            </a>
                        </div>

                        <div class="card-body">
                            <form method="GET">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <input type="text" name="keyword" class="form-control" placeholder="Cari Nama, NIM, Status..." value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" name="cari" class="btn btn-primary w-100">
                                            <i class="bi bi-search"></i> Cari
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="data_peminjaman.php" class="btn btn-secondary w-100">Reset</a>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover align-middle">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th style="width: 50px;">No</th>
                                            <th>Mahasiswa</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Rencana Kembali</th>
                                            <th>Tanggal Dikembalikan</th>
                                            <th>Status</th>
                                            <th style="width: 120px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (mysqli_num_rows($query) > 0) {
                                            while($data = mysqli_fetch_assoc($query)){
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($data['nama']); ?></td>
                                            <td class="text-center"><?= htmlspecialchars($data['tanggal_pinjam']); ?></td>
                                            <td class="text-center"><?= htmlspecialchars($data['tanggal_rencana_kembali']); ?></td>
                                            <td class="text-center"><?= htmlspecialchars($data['tanggal_dikembalikan'] ?? '-'); ?></td>
                                            <td class="text-center">
                                                <?php if($data['status'] == "Dipinjam") { ?>
                                                    <span class="badge bg-primary">Dipinjam</span>
                                                <?php } else { ?>
                                                    <span class="badge bg-success">Dikembalikan</span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="edit_peminjaman.php?id=<?= $data['id_peminjaman']; ?>" class="btn btn-warning btn-sm text-white">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="hapus_peminjaman.php?id=<?= $data['id_peminjaman']; ?>" onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                            } 
                                        } else { 
                                        ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">Tidak ada data peminjaman yang ditemukan.</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div> </div> </div> </div> </div> </div> </div> </body>
</html>