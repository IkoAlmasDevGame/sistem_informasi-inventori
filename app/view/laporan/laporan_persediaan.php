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
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="form-group mt-1">
                                <form action="" method="post">
                                    <div class="d-flex justify-content-start align-items-center flex-wrap">
                                        <div class="col-sm-3 mx-2">
                                            <select name="nama_barang" class="form-select"
                                                aria-controls="example1_length">
                                                <option value="">Pilih Jenis Barang</option>
                                                <?php 
                                                $master = $config->query("SELECT * FROM gudang order by jenis_barang desc");
                                                while($data = $master->fetch_array()){
                                                ?>
                                                <option value="<?=$data['nama_barang']?>">
                                                    <?=$data['nama_barang']?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
                                    </div>
                                </form>
                                <?php 
                                    if(isset($_POST['nama_barang'])){
                                        $nama = htmlspecialchars($_POST['nama_barang']);
                                        $sqlnb = "SELECT gudang.*, barang_masuk.tanggal, barang_masuk.nama_barang, barang_keluar.tanggal, barang_keluar.tanggal FROM gudang inner join barang_masuk on gudang.nama_barang = barang_masuk.nama_barang inner join barang_keluar on gudang.nama_barang = barang_keluar.nama_barang where gudang.nama_barang = '$nama' && barang_masuk.tanggal=barang_keluar.tanggal group by gudang.nama_barang desc";
                                        $rownb = $config->query($sqlnb);
                                        if($isnb = $rownb->fetch_array()){
                                ?>
                                <div class="ms-4 col-sm-3 mt-2">
                                    <a href="" aria-current="page" class="btn btn-primary">
                                        <i class="fa fa-file-export fa-1x"></i>
                                        <span>File Export to Excel</span>
                                    </a>
                                </div>
                                <?php
                                    }
                                }else{
                                    echo "<div class='ms-4 mt-2'>tidak bisa print halaman ini.</div>";
                                }
                                ?>
                            </div>
                            <div class="card" style="width: max-content;">
                                <div class="card-body">
                                    <div class="border border-1 mt-3">
                                        <div class="d-flex justify-content-evenly align-items-center flex-wrap">
                                            <table class="table-layout" style="width: 284px;" id="example3">
                                                <thead>
                                                    <tr>
                                                        <th class="table-layout-2 text-center
                                                         sorting_desc sorting_desc_disabled sorting_asc sorting_asc_disabled"
                                                            style="height:100px; max-height: 100px;" disabled>
                                                            Nama Barang</th>
                                                    </tr>
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if(isset($_POST['nama_barang'])){
                                                            $nama = htmlspecialchars($_POST['nama_barang']);
                                                            $sql = "SELECT gudang.*, barang_masuk.tanggal, barang_masuk.nama_barang, barang_keluar.tanggal, barang_keluar.tanggal FROM gudang inner join barang_masuk on gudang.nama_barang = barang_masuk.nama_barang inner join barang_keluar on gudang.nama_barang = barang_keluar.nama_barang where gudang.nama_barang = '$nama' && barang_masuk.tanggal=barang_keluar.tanggal group by gudang.nama_barang desc";
                                                            $row = $config->query($sql);
                                                            while($i = $row->fetch_array()){
                                                    ?>
                                                    <tr>
                                                        <td class="text-center table-layout-2">
                                                            <?php echo $i['nama_barang'] ?></td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <table class="table-layout" style="width: 300px;" id="example4">
                                                <thead>
                                                    <tr>
                                                        <th class="table-layout-2 text-center sorting_desc 
                                                        sorting_desc_disabled sorting_asc sorting_asc_disabled">
                                                            Barang Masuk</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-layout-2 text-center sorting_desc
                                                         sorting_desc_disabled sorting_asc sorting_asc_disabled">Qty
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if(isset($_POST['nama_barang'])){
                                                            $nama = htmlspecialchars($_POST['nama_barang']);
                                                            $sqlmsk = "SELECT gudang.*, barang_masuk.tanggal, barang_masuk.jumlah, barang_masuk.nama_barang, barang_keluar.tanggal, barang_keluar.tanggal FROM gudang inner join barang_masuk on gudang.nama_barang = barang_masuk.nama_barang inner join barang_keluar on gudang.nama_barang = barang_keluar.nama_barang where gudang.nama_barang = '$nama' && barang_masuk.tanggal=barang_keluar.tanggal";
                                                            $rowmsk = $config->query($sqlmsk);
                                                            while($is = $rowmsk->fetch_array()){
                                                    ?>
                                                    <td></td>
                                                    <tr>
                                                        <td class="table-layout-2 text-center">
                                                            <?php echo $is['jumlah'] ?></td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <table class="table-layout" style="width: 300px;" id="example5">
                                                <thead>
                                                    <tr>
                                                        <th class="table-layout-2 text-center sorting_desc
                                                             sorting_desc_disabled sorting_asc sorting_asc_disabled">
                                                            Barang Keluar</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-layout-2 text-center sorting_desc
                                                         sorting_desc_disabled sorting_asc sorting_asc_disabled">Qty
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if(isset($_POST['nama_barang'])){
                                                            $nama = htmlspecialchars($_POST['nama_barang']);
                                                            $sqlklr = "SELECT gudang.*, barang_masuk.tanggal, barang_keluar.jumlah, barang_masuk.nama_barang, barang_keluar.tanggal, barang_keluar.tanggal FROM gudang inner join barang_masuk on gudang.nama_barang = barang_masuk.nama_barang inner join barang_keluar on gudang.nama_barang = barang_keluar.nama_barang where gudang.nama_barang = '$nama' && barang_masuk.tanggal=barang_keluar.tanggal";
                                                            $rowklr = $config->query($sqlklr);
                                                            while($isi = $rowklr->fetch_array()){
                                                    ?>
                                                    <td></td>
                                                    <tr>
                                                        <td class="table-layout-2 text-center">
                                                            <?php echo $isi['jumlah'] ?></td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <table class="table-layout" style="width: 300px;" id="example6">
                                                <thead>
                                                    <tr>
                                                        <th class="table-layout-2 text-center sorting_desc 
                                                            sorting_desc_disabled sorting_asc sorting_asc_disabled">
                                                            Persediaan</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="table-layout-2 text-center sorting_desc 
                                                            sorting_desc_disabled sorting_asc sorting_asc_disabled">
                                                            Qty</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if(isset($_POST['nama_barang'])){
                                                            $nama = htmlspecialchars($_POST['nama_barang']);
                                                            $sqlmsk = "SELECT gudang.*, barang_masuk.tanggal, barang_masuk.nama_barang, barang_keluar.tanggal, barang_keluar.tanggal FROM gudang inner join barang_masuk on gudang.nama_barang = barang_masuk.nama_barang inner join barang_keluar on gudang.nama_barang = barang_keluar.nama_barang where gudang.nama_barang = '$nama' && barang_masuk.tanggal=barang_keluar.tanggal";
                                                            $rowmsk = $config->query($sqlmsk);
                                                            while($is = $rowmsk->fetch_array()){
                                                    ?>
                                                    <td></td>
                                                    <tr>
                                                        <td class="table-layout-2 text-center">
                                                            <?php echo $is['jumlah'] ?></td>
                                                    </tr>
                                                    <?php
                                                        }
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
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>