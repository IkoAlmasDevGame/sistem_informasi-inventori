<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan Persediaan</title>
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin")
            {
                require_once("../ui/header.php");
                require_once("../../database/koneksi.php");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header py-2">
                        <h4 class="card-title">Laporan Persediaan</h4>
                        <form action="" method="post">
                            <div class="d-flex justify-content-start align-items-center flex-wrap">
                                <div class="col-sm-3 mx-1">
                                    <select name="nama_barang" class="form-select" id="">
                                        <option value="">Pilih Nama Barang</option>
                                        <?php 
                                            $master = $config->query("SELECT * FROM gudang order by id asc");
                                            while($data = $master->fetch_array()){
                                        ?>
                                        <option value="<?=$data['nama_barang']?>">
                                            <?=$data['nama_barang']?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3 mx-1">
                                    <select name="tanggal" class="form-select" id="">
                                        <option value="">Pilih Tanggal</option>
                                        <?php 
                                            $master2 = $config->query("SELECT barang_masuk.*, barang_keluar.tanggal FROM barang_masuk LEFT JOIN barang_keluar ON barang_masuk.tanggal = barang_keluar.tanggal group by barang_masuk.tanggal asc");
                                            while($data2 = $master2->fetch_array()){
                                        ?>
                                        <option value="<?=$data2['tanggal']?>">
                                            <?=$data2['tanggal']?>
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3 mx-1">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="text-end">
                            <a href="?page=laporan-persediaan" class="btn btn-info btn-sm">
                                <i class="fa fa-refresh fa-1x"></i>
                                <span>Refresh Page</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <br>
                        <h1>Stok IN</h1>
                        <h2>Stok Barang Masuk (IN)</h2>
                        <table class="table-layout">
                            <tr>
                                <th class="table-layout-2">No</th>
                                <th class="table-layout-2">Transaksi Masuk</th>
                                <th class="table-layout-2">Nama Barang</th>
                                <th class="table-layout-2">Qty</th>
                                <th class="table-layout-2">Tanggal Masuk</th>
                            </tr>

                            <?php
                            if(isset($_POST['nama_barang']) && isset($_POST['tanggal'])){
                            $sql = mysqli_query($config, "SELECT barang_masuk.tanggal, barang_masuk.jumlah, barang_masuk.id_transaksi, barang_masuk.nama_barang, gudang.nama_barang FROM barang_masuk LEFT JOIN gudang ON barang_masuk.nama_barang = gudang.nama_barang where barang_masuk.nama_barang = '$_POST[nama_barang]' and barang_masuk.tanggal = '$_POST[tanggal]' group BY barang_masuk.tanggal desc") or die(mysqli_error($config));            
                            $no = 1;
                            while ($a = mysqli_fetch_assoc($sql)) {
                                echo"<tr>
                                    <td class='table-layout-2'>".$no++."</td>
                                    <td class='table-layout-2'>".$a['id_transaksi']."</td>
                                    <td class='table-layout-2'>".$a['nama_barang']."</td>
                                    <td class='table-layout-2'>".$a['jumlah']."</td>
                                    <td class='table-layout-2'>".$a['tanggal']."</td>
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
                                <th class="table-layout-2">Tanggal Keluar</th>
                            </tr>

                            <?php
                            if(isset($_POST['nama_barang']) && isset($_POST['tanggal'])){
                                $sql = mysqli_query($config, "SELECT barang_keluar.tanggal, barang_keluar.id_transaksi, barang_keluar.jumlah, 
                                barang_keluar.nama_barang, gudang.nama_barang FROM barang_keluar LEFT JOIN gudang ON gudang.nama_barang = barang_keluar.nama_barang where barang_keluar.nama_barang = '$_POST[nama_barang]' and barang_keluar.tanggal = '$_POST[tanggal]' group BY barang_keluar.tanggal desc") or die(mysqli_error($config));
                                $no = 1;
                                while ($c = mysqli_fetch_assoc($sql)) {
                                    echo"<tr>
                                        <td class='table-layout-2'>".$no++."</td>
                                        <td class='table-layout-2'>".$c['id_transaksi']."</td>
                                        <td class='table-layout-2'>".$c['nama_barang']."</td>
                                        <td class='table-layout-2'>".$c['jumlah']."</td>
                                        <td class='table-layout-2'>".$c['tanggal']."</td>
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
                            if(isset($_POST['nama_barang'])){
                                $sql = mysqli_query($config, "SELECT gudang.jumlah,gudang.nama_barang, barang_masuk.nama_barang, barang_keluar.nama_barang FROM gudang
                                 LEFT JOIN barang_masuk ON gudang.nama_barang = barang_masuk.nama_barang LEFT JOIN barang_keluar ON gudang.nama_barang = barang_keluar.nama_barang where gudang.nama_barang = '$_POST[nama_barang]' group by gudang.nama_barang desc") or die(mysqli_error($config));
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
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>