<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
        if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin"){
            require_once("../ui/header.php");
            require_once("../../database/koneksi.php");
            header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-Disposition: attachment; filename=Laporan_Persediaan (".date('d-m-Y').").xls");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
        }else{
            header("location:../ui/header.php?page=beranda");
        }
        ?>
        <title>Export Laporan Persediaan</title>
    </head>

    <body>
        <h2>Laporan Persediaan</h2>
        <div class="table-responsive">
            <h1>Stok IN</h1>
            <h2>Stok Barang Masuk (IN)</h2>
            <table class="table-layout">
                <tr>
                    <th class="table-layout-2">No</th>
                    <th class="table-layout-2">Transaksi Masuk</th>
                    <th class="table-layout-2">Nama Barang</th>
                    <th class="table-layout-2">Qty</th>
                </tr>

                <?php
                    if(isset($_GET['nama_barang'])){
                    $sql = mysqli_query($config, "SELECT barang_masuk.tanggal, barang_masuk.jumlah, barang_masuk.id_transaksi, barang_masuk.nama_barang, gudang.nama_barang FROM
                     barang_masuk LEFT JOIN gudang ON barang_masuk.nama_barang = gudang.nama_barang where barang_masuk.nama_barang = '$_GET[nama_barang]' 
                     order BY barang_masuk.nama_barang desc") or die(mysqli_error($config));            
                    $no = 1;
                    while ($a = mysqli_fetch_assoc($sql)) {
                        echo"<tr>
                            <td class='table-layout-2'>".$no++."</td>
                            <td class='table-layout-2'>".$a['id_transaksi']."</td>
                            <td class='table-layout-2'>".$a['nama_barang']."</td>
                            <td class='table-layout-2'>".$a['jumlah']."</td>
                        </tr>";
                        }
                    }
                ?>
            </table>
            <br>
            <h1>Stok OUT</h1>
            <h2>Stok Barang Keluar (OUT)</h2>
            <table class="table-layout">
                <tr>
                    <th class="table-layout-2">No</th>
                    <th class="table-layout-2">Transaksi Keluar</th>
                    <th class="table-layout-2">Nama Barang</th>
                    <th class="table-layout-2">Qty</th>
                </tr>

                <?php
                    if(isset($_GET['nama_barang'])){
                        $sql = mysqli_query($config, "SELECT barang_keluar.tanggal, barang_keluar.id_transaksi, barang_keluar.jumlah, 
                        barang_keluar.nama_barang, gudang.nama_barang FROM barang_keluar LEFT JOIN gudang ON gudang.nama_barang = barang_keluar.nama_barang where 
                        barang_keluar.nama_barang = '$_GET[nama_barang]' 
                        order BY barang_keluar.nama_barang desc") or die(mysqli_error($config));
                        $no = 1;
                        while ($c = mysqli_fetch_assoc($sql)) {
                            echo"<tr>
                                <td class='table-layout-2'>".$no++."</td>
                                <td class='table-layout-2'>".$c['id_transaksi']."</td>
                                <td class='table-layout-2'>".$c['nama_barang']."</td>
                                <td class='table-layout-2'>".$c['jumlah']."</td>
                            </tr>";
                            }
                        }
                    ?>
            </table>
            <br>
            <h1>Persediaan</h1>
            <h2>Stok Gudang</h2>
            <table class="table-layout">
                <tr>
                    <th class="table-layout-2">No</th>
                    <th class="table-layout-2">Nama Barang</th>
                    <th class="table-layout-2">Qty</th>
                </tr>

                <?php
                    if(isset($_GET['nama_barang'])){
                        $sql = mysqli_query($config, "SELECT gudang.jumlah,gudang.nama_barang, barang_masuk.nama_barang, barang_keluar.nama_barang FROM gudang
                         LEFT JOIN barang_masuk ON gudang.nama_barang = barang_masuk.nama_barang LEFT JOIN barang_keluar ON gudang.nama_barang = barang_keluar.nama_barang where 
                         gudang.nama_barang = '$_GET[nama_barang]' group by gudang.nama_barang desc") or die(mysqli_error($config));
                        $no = 1;
                        while ($c = mysqli_fetch_assoc($sql)) {
                            echo"<tr>
                                <td class='table-layout-2'>".$no++."</td>
                                <td class='table-layout-2'>".$c['nama_barang']."</td>
                                <td class='table-layout-2'>".$c['jumlah']."</td>
                            </tr>";
                            }
                        }
                    ?>
            </table>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>