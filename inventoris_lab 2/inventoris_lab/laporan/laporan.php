<?php
include "../config/koneksi.php";

$query = mysqli_query($koneksi, "
SELECT
    p.id_peminjaman,
    m.nama,
    b.nama_barang,
    p.tanggal_pinjam,
    p.tanggal_rencana_kembali,
    p.tanggal_dikembalikan,
    p.status

FROM peminjaman p

INNER JOIN mahasiswa m
ON p.id_mahasiswa=m.id_mahasiswa

INNER JOIN detail_peminjaman dp
ON p.id_peminjaman=dp.id_peminjaman

INNER JOIN barang b
ON dp.id_barang=b.id_barang

ORDER BY p.id_peminjaman DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Laporan</title>

    <link rel="stylesheet"
        href="../bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet"
        href="../dist/css/adminlte.min.css">

    <link rel="stylesheet"
        href="../dist/css/style.css">

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

                    <a href="../dashboard.php" class="menu">

                        <i class="bi bi-speedometer2"></i>

                        Dashboard

                    </a>

                    <a href="../barang/data_barang.php" class="menu">

                        <i class="bi bi-box-seam"></i>

                        Data Barang

                    </a>

                    <a href="../mahasiswa/data_mahasiswa.php" class="menu">

                        <i class="bi bi-people"></i>

                        Data Mahasiswa

                    </a>

                    <a href="../peminjaman/data_peminjaman.php" class="menu">

                        <i class="bi bi-clipboard-check"></i>

                        Peminjaman

                    </a>

                    <a href="laporan.php"
                        class="menu active-menu">

                        <i class="bi bi-file-earmark-text"></i>

                        Laporan

                    </a>

                    <div class="mt-auto">

                        <hr>

                        <a href="../logout.php"
                            class="menu logout-menu">

                            <i class="bi bi-box-arrow-right"></i>

                            Logout

                        </a>

                    </div>

                </div>

            </div>

            <!-- Content -->

            <div class="col-md-10 p-0">

                <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm px-4">

                    <div class="d-flex align-items-center">

                        <button class="btn btn-light me-3">

                            <i class="bi bi-list fs-5"></i>

                        </button>

                        <h5 class="mb-0 fw-bold">

                            Laporan

                        </h5>

                    </div>

                    <div class="ms-auto d-flex align-items-center">

                        <button class="btn btn-light me-3">

                            <i class="bi bi-bell"></i>

                        </button>

                        <button class="btn btn-light">

                            <i class="bi bi-person-circle"></i>

                            Admin

                        </button>

                    </div>

                </nav>

                <div class="p-4">
                    <!-- Judul Halaman -->
                    <div class="mb-4">

                        <h2 class="fw-bold">
                            Laporan
                        </h2>

                        <p class="text-muted">
                            Kelola laporan peminjaman barang laboratorium.
                        </p>

                    </div>

                    <!-- Card -->
                    <div class="card shadow-sm border-0">

                        <!-- Header Card -->
                        <div class="card-header bg-white">

                            <div class="d-flex justify-content-between align-items-center">

                                <h5 class="fw-bold mb-0">

                                    <i class="bi bi-file-earmark-text-fill text-primary me-2"></i>

                                    Data Laporan

                                </h5>

                                <div>

                                    <a href="export_excel.php" class="btn btn-success">

                                        <i class="bi bi-file-earmark-excel"></i>

                                        Excel

                                    </a>

                                    <a href="export_pdf.php" class="btn btn-danger">

                                        <i class="bi bi-file-earmark-pdf"></i>

                                        PDF

                                    </a>

                                </div>

                            </div>

                        </div>

                        <!-- Body Card -->
                        <div class="card-body">

                            <form method="GET">

                                <div class="row g-3 mb-4">

                                    <div class="col-md-3">

                                        <label class="form-label fw-semibold">

                                            Status

                                        </label>

                                        <select class="form-select" name="status">

                                            <option value="">Semua Status</option>

                                            <option value="Dipinjam">Dipinjam</option>

                                            <option value="Dikembalikan">Dikembalikan</option>

                                        </select>

                                    </div>

                                    <div class="col-md-3">

                                        <label class="form-label fw-semibold">

                                            Tanggal Awal

                                        </label>

                                        <input
                                            type="date"
                                            class="form-control"
                                            name="tgl_awal">

                                    </div>

                                    <div class="col-md-3">

                                        <label class="form-label fw-semibold">

                                            Tanggal Akhir

                                        </label>

                                        <input
                                            type="date"
                                            class="form-control"
                                            name="tgl_akhir">

                                    </div>

                                    <div class="col-md-3 d-flex align-items-end">

                                        <button
                                            type="submit"
                                            class="btn btn-primary w-100">

                                            <i class="bi bi-search"></i>

                                            Tampilkan

                                        </button>

                                    </div>

                                </div>

                            </form>
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover align-middle">

                                    <thead class="table-light text-center">

                                        <tr>

                                            <th width="60">No</th>

                                            <th>Nama Mahasiswa</th>

                                            <th>Nama Barang</th>

                                            <th>Tanggal Pinjam</th>

                                            <th>Rencana Kembali</th>

                                            <th>Tanggal Dikembalikan</th>

                                            <th>Status</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                        if (mysqli_num_rows($query) > 0) {

                                            $no = 1;

                                            while ($data = mysqli_fetch_assoc($query)) {

                                        ?>

                                                <tr>

                                                    <td class="text-center">

                                                        <?= $no++; ?>

                                                    </td>

                                                    <td>

                                                        <?= htmlspecialchars($data['nama']); ?>

                                                    </td>

                                                    <td>

                                                        <?= htmlspecialchars($data['nama_barang']); ?>

                                                    </td>

                                                    <td class="text-center">

                                                        <?= date('d-m-Y', strtotime($data['tanggal_pinjam'])); ?>

                                                    </td>

                                                    <td class="text-center">

                                                        <?= date('d-m-Y', strtotime($data['tanggal_rencana_kembali'])); ?>

                                                    </td>

                                                    <td class="text-center">

                                                        <?php

                                                        if (empty($data['tanggal_dikembalikan'])) {

                                                            echo "-";
                                                        } else {

                                                            echo date('d-m-Y', strtotime($data['tanggal_dikembalikan']));
                                                        }

                                                        ?>

                                                    </td>

                                                    <td class="text-center">

                                                        <?php

                                                        if ($data['status'] == "Dipinjam") {

                                                        ?>

                                                            <span class="badge bg-warning text-dark">

                                                                Dipinjam

                                                            </span>

                                                        <?php

                                                        } else {

                                                        ?>

                                                            <span class="badge bg-success">

                                                                Dikembalikan

                                                            </span>

                                                        <?php

                                                        }

                                                        ?>

                                                    </td>

                                                </tr>

                                            <?php

                                            }
                                        } else {

                                            ?>

                                            <tr>

                                                <td colspan="7" class="text-center text-muted py-4">

                                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                                                    Belum ada data laporan peminjaman.

                                                </td>

                                            </tr>

                                        <?php

                                        }

                                        ?>

                                    </tbody>

                                </table>

                            </div>
                            <hr>

                            <div class="d-flex justify-content-end gap-2">

                                <a href="export_excel.php" class="btn btn-success">

                                    <i class="bi bi-file-earmark-excel"></i>

                                    Export Excel

                                </a>

                                <a href="export_pdf.php" class="btn btn-danger">

                                    <i class="bi bi-file-earmark-pdf"></i>

                                    Export PDF

                                </a>

                            </div>

                        </div> <!-- card-body -->

                    </div> <!-- card -->

                </div> <!-- p-4 -->

            </div> <!-- col-md-10 -->

        </div> <!-- row -->

    </div> <!-- container-fluid -->

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>