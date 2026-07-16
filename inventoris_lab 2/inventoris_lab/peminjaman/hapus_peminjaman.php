<?php

include "../config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman='$id'");

if($query){

    echo "<script>

    alert('Data peminjaman berhasil dihapus');

    window.location='data_peminjaman.php';

    </script>";

}else{

    echo "<script>

    alert('Data peminjaman gagal dihapus');

    window.location='data_peminjaman.php';

    </script>";

}

?>