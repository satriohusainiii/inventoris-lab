<?php
include "../config/koneksi.php";

if (isset($_GET['cari'])) {

    $keyword = $_GET['keyword'];

    $query = mysqli_query($koneksi, "
        SELECT * FROM mahasiswa
        WHERE nim LIKE '%$keyword%'
        OR nama LIKE '%$keyword%'
        OR kelas LIKE '%$keyword%'
        OR prodi LIKE '%$keyword%'
        OR no_hp LIKE '%$keyword%'
    ");
} else {

    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <link rel="stylesheet" href="../dist/css/style.css">
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

                    <!-- Dashboard -->
                    <a href="../dashboard.php" class="menu">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>

                    <!-- Data Barang -->
                    <a href="../barang/data_barang.php" class="menu">
                        <i class="bi bi-box-seam"></i>
                        Data Barang
                    </a>

                    <!-- Data Mahasiswa -->
                    <a href="../mahasiswa/data_mahasiswa.php" class="menu active-menu">
                        <i class="bi bi-people"></i>
                        Data Mahasiswa
                    </a>

                    <!-- Peminjaman -->
                    <a href="../peminjaman/data_peminjaman.php" class="menu">
                        <i class="bi bi-clipboard-check"></i>
                        Peminjaman
                    </a>

                    <!-- Laporan -->
                    <a href="../laporan/laporan.php" class="menu">
                        <i class="bi bi-file-earmark-text"></i>
                        Laporan
                    </a>

                    <!-- Logout -->
                    <div class="mt-auto">

                        <hr>

                        <a href="../logout.php" class="menu logout-menu">
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

                            Data Mahasiswa

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

                    <div class="mb-4">

                        <h2 class="fw-bold">
                            Data Mahasiswa
                        </h2>

                        <p class="text-muted">
                            Kelola seluruh data mahasiswa laboratorium.
                        </p>

                    </div>
                    <div class="card shadow-sm border-0">

                        <div class="card-header bg-white">

                            <div class="d-flex justify-content-between align-items-center">

                                <h5 class="fw-bold mb-0">
                                    <i class="bi bi-people-fill text-primary"></i>
                                    Data Mahasiswa
                                </h5>

                                <a href="tambah_mahasiswa.php" class="btn btn-primary">

                                    <i class="bi bi-plus-circle"></i>
                                    Tambah Mahasiswa

                                </a>

                            </div>

                        </div>

                        <div class="card-body">
                            <form method="GET">

                                <div class="row mb-4">

                                    <div class="col-md-6">

                                        <input type="text" name="keyword" class="form-control"
                                            placeholder="Cari NIM, Nama, Kelas..."
                                            value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">

                                    </div>

                                    <div class="col-md-2">

                                        <button type="submit" name="cari" class="btn btn-primary w-100">

                                            <i class="bi bi-search"></i>
                                            Cari

                                        </button>

                                    </div>

                                    <div class="col-md-2">

                                        <a href="data_mahasiswa.php" class="btn btn-secondary w-100">

                                            Reset

                                        </a>

                                    </div>

                                </div>

                            </form>
                            <div class="table-responsive">

                                <table class="table table-hover align-middle">

                                    <thead class="table-light">

                                        <tr>

                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Program Studi</th>
                                            <th>No HP</th>
                                            <th class="text-center">Aksi</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php
                                        $no = 1;
                                        while ($data = mysqli_fetch_assoc($query)) {
                                            ?>

                                            <tr>

                                                <td><?= $no++; ?></td>

                                                <td><?= $data['nim']; ?></td>

                                                <td><?= $data['nama']; ?></td>

                                                <td><?= $data['kelas']; ?></td>

                                                <td><?= $data['prodi']; ?></td>

                                                <td><?= $data['no_hp']; ?></td>

                                                <td class="text-center">

                                                    <a href="edit_mahasiswa.php?id=<?= $data['id_mahasiswa']; ?>"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <a href="hapus_mahasiswa.php?id=<?= $data['id_mahasiswa']; ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus data?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>

                                                </td>

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

    </div>

</body>


</html>