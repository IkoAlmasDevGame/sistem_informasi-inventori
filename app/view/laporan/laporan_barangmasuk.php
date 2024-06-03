<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <title>Laporan Barang Masuk</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Barang Masuk</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td>Laporan Perbulan dan Pertahun</td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <form action="?page=export-laporanbarangmasuk" id="MyForm1" method="post">
                                        <div class="row form-group">
                                            <div class="col-md-5">
                                                <select name="bln" class="form-control">
                                                    <option value="1" selected="">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="thn" id="" class="form-control">
                                                    <?php
                                                        $now = date('Y'); 
                                                        for ($a=2010;$a<=$now;$a++) { 
                                                    ?>
                                                    <option value="<?php echo $a?>"><?php echo $a ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-2"></div>
                                        <button type="submit" name="submit" class="btn btn-sm btn-info">
                                            Export To Excel
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-borderless">
                            <tr>
                                <td width="50%">
                                    <form action="?page=export-laporanbarangmasuk" id="MyForm1" method="post">
                                        <div class="row form-group">
                                            <div class="col-md-5">
                                                <select name="bln" id="" class="form-control">
                                                    <option value="all" selected="">ALL</option>
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="thn" id="" class="form-control">
                                                    <?php
                                                        $now = date('Y'); 
                                                        for ($a=2010;$a<=$now;$a++) { 
                                                    ?>
                                                    <option value="<?php echo $a?>"><?php echo $a ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-2"></div>
                                        <button type="submit" name="submit" class="btn btn-sm btn-info">
                                            Tampilkan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        <div class="tampung1">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Transaksi</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Pengirim</th>
                                            <th>Jumlah Masuk</th>
                                            <th>Satuan Barang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            $row = $config->query("SELECT * FROM barang_masuk order by id asc");
                                            while ($isi = mysqli_fetch_array($row)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $isi['id_transaksi'] ?></td>
                                            <td><?php echo $isi['tanggal'] ?></td>
                                            <td><?php echo $isi['kode_barang'] ?></td>
                                            <td><?php echo $isi['nama_barang'] ?></td>
                                            <td><?php echo $isi['pengirim'] ?></td>
                                            <td><?php echo $isi['jumlah'] ?></td>
                                            <td><?php echo $isi['satuan'] ?></td>
                                        </tr>
                                        <?php
                                        $no++;
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
        <?php 
            require_once("../ui/footer.php");
        ?>