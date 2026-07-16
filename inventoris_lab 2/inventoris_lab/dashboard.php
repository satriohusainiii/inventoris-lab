<?php

include "config/koneksi.php";


$total_barang = mysqli_fetch_assoc(
    mysqli_query($koneksi, "
        SELECT COUNT(*) AS total
        FROM barang
    ")
);


$total_mahasiswa = mysqli_fetch_assoc(
    mysqli_query($koneksi, "
        SELECT COUNT(*) AS total
        FROM mahasiswa
    ")
);



$total_dipinjam = mysqli_fetch_assoc(
    mysqli_query($koneksi, "
        SELECT COUNT(*) AS total
        FROM peminjaman
        WHERE status='Dipinjam'
    ")
);

/* ==========================
   TOTAL TERSEDIA
========================== */

$total_tersedia = mysqli_fetch_assoc(
    mysqli_query($koneksi, "
        SELECT COUNT(*) AS total
        FROM barang
        WHERE status='Tersedia'
    ")
);
/* ==========================
   TRANSAKSI TERBARU
========================== */

$transaksi = mysqli_query($koneksi, "
SELECT
    p.id_peminjaman,
    m.nama,
    b.nama_barang,
    p.tanggal_pinjam,
    p.tanggal_rencana_kembali,
    p.status

FROM peminjaman p

INNER JOIN mahasiswa m
ON p.id_mahasiswa = m.id_mahasiswa

INNER JOIN detail_peminjaman dp
ON p.id_peminjaman = dp.id_peminjaman

INNER JOIN barang b
ON dp.id_barang = b.id_barang

ORDER BY p.id_peminjaman DESC

LIMIT 5
");

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inventaris Lab</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link rel="stylesheet" href="dist/css/style.css">
</head>


<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white p-4 sidebar">

                <h2 class="logo-title">
                    Inventaris Lab
                </h2>


                <div class="sidebar-menu">

                    <a href="dashboard.php" class="menu active-menu">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>

                    <a href="barang/data_barang.php" class="menu">
                        <i class="bi bi-box-seam"></i>
                        Data Barang
                    </a>

                    <a href="mahasiswa/data_mahasiswa.php" class="menu">
                        <i class="bi bi-people"></i>
                        Data Mahasiswa
                    </a>

                    <a href="peminjaman/data_peminjaman.php" class="menu">
                        <i class="bi bi-clipboard-check"></i>
                        Peminjaman
                    </a>

                    <a href="laporan/laporan.php" class="menu">
                        <i class="bi bi-file-earmark-text"></i>
                        Laporan
                    </a>

                    <div class="mt-auto">

                        <hr>

                        <a href="logout.php" class="menu logout-menu">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout
                        </a>

                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="col-md-10 p-0">

                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm px-4">

                    <!-- Kiri -->
                    <div class="d-flex align-items-center">

                        <button class="btn btn-light me-3">

                            <i class="bi bi-list fs-5"></i>

                        </button>

                        <h5 class="mb-0 fw-bold">

                            Dashboard

                        </h5>

                    </div>

                    <!-- Kanan -->
                    <div class="ms-auto d-flex align-items-center">

                        <button class="btn btn-light me-3">

                            <i class="bi bi-bell fs-5"></i>

                        </button>

                        <button class="btn btn-light">

                            <i class="bi bi-person-circle"></i>

                            Admin

                        </button>

                    </div>

                </nav>

                <div class="p-4">


                    <div class="row mt-4">

                        <!-- Card 1 -->
                        <div class="col-md-3 mb-3">

                            <div class="card border-0 shadow-sm">

                                <div class="card-body d-flex align-items-center">

                                    <div class="bg-primary text-white rounded p-3">

                                        <i class="bi bi-box fs-3"></i>

                                    </div>

                                    <div class="ms-3">

                                        <small class="text-muted">
                                            TOTAL BARANG
                                        </small>

                                        <h2 class="fw-bold mb-0">

                                            <?= $total_barang['total']; ?>

                                        </h2>

                                        <small class="text-muted">
                                            Semua barang
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Card 2 -->
                        <div class="col-md-3 mb-3">

                            <div class="card border-0 shadow-sm">

                                <div class="card-body d-flex align-items-center">

                                    <div class="bg-success text-white rounded p-3">

                                        <i class="bi bi-people-fill fs-3"></i>

                                    </div>

                                    <div class="ms-3">

                                        <small class="text-muted">
                                            MAHASISWA
                                        </small>

                                        <h2 class="fw-bold mb-0">
                                            <?= $total_mahasiswa['total']; ?>
                                        </h2>

                                        <small class="text-muted">
                                            Mahasiswa aktif
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Card 3 -->
                        <div class="col-md-3 mb-3">

                            <div class="card border-0 shadow-sm">

                                <div class="card-body d-flex align-items-center">

                                    <div class="bg-warning text-white rounded p-3">

                                        <i class="bi bi-cart-check fs-3"></i>

                                    </div>

                                    <div class="ms-3">

                                        <small class="text-muted">
                                            DIPINJAM
                                        </small>

                                        <h2 class="fw-bold mb-0">
                                            <?= $total_dipinjam['total']; ?>
                                        </h2>

                                        <small class="text-muted">
                                            Sedang dipinjam
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Card 4 -->
                        <div class="col-md-3 mb-3">

                            <div class="card border-0 shadow-sm">

                                <div class="card-body d-flex align-items-center">

                                    <div class="bg-secondary text-white rounded p-3">

                                        <i class="bi bi-check2-square fs-3"></i>

                                    </div>

                                    <div class="ms-3">

                                        <small class="text-muted">
                                            TERSEDIA
                                        </small>

                                        <h2 class="fw-bold mb-0">
                                            <?= $total_tersedia['total']; ?>
                                        </h2>

                                        <small class="text-muted">
                                            Barang tersedia
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="card border-0 shadow-sm mt-4">

                        <div class="card-header bg-white">

                            <div class="d-flex justify-content-between align-items-center">

                                <h5 class="mb-0 fw-bold">

                                    Transaksi Peminjaman Terbaru

                                </h5>

                                <button class="btn btn-primary btn-sm">

                                    Lihat Semua

                                </button>

                            </div>

                        </div>

                        <div class="card-body">

                            <table class="table table-hover align-middle">

                                <thead class="table-light">

                                    <tr>

                                        <th>No</th>
                                        <th>Mahasiswa</th>
                                        <th>Barang</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Aksi</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php

                                    $no = 1;

                                    while ($data = mysqli_fetch_assoc($transaksi)) {

                                    ?>

                                        <tr>

                                            <td><?= $no++; ?></td>

                                            <td><?= $data['nama']; ?></td>

                                            <td><?= $data['nama_barang']; ?></td>

                                            <td><?= date('d/m/Y', strtotime($data['tanggal_pinjam'])); ?></td>

                                            <td><?= date('d/m/Y', strtotime($data['tanggal_rencana_kembali'])); ?></td>

                                            <td>

                                                <?php if ($data['status'] == "Dipinjam") { ?>

                                                    <span class="badge bg-warning text-dark">

                                                        Dipinjam

                                                    </span>

                                                <?php } else { ?>

                                                    <span class="badge bg-success">

                                                        Dikembalikan

                                                    </span>

                                                <?php } ?>

                                            </td>

                                            <td>

                                                <a href="peminjaman/data_peminjaman.php"

                                                    class="btn btn-outline-primary btn-sm">

                                                    Detail

                                                </a>

                                            </td>

                                        </tr>

                                    <?php

                                    }

                                    ?>

                                </tbody>


                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        const menuLinks = document.querySelectorAll('.sidebar-menu .menu');
        const currentPath = window.location.pathname.split('/').pop();

        menuLinks.forEach(link => {
            const linkPath = link.getAttribute('href');
            if (linkPath === currentPath || linkPath === window.location.pathname) {
                menuLinks.forEach(item => item.classList.remove('active-menu'));
                link.classList.add('active-menu');
            }

            link.addEventListener('click', () => {
                menuLinks.forEach(item => item.classList.remove('active-menu'));
                link.classList.add('active-menu');
            });
        });
    </script>
</body>


</html>