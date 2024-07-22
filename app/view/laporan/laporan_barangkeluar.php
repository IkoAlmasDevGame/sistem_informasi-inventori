<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin")
            {
                require_once("../ui/header.php");
                $bulan_tes = array(
                '01' => "Januari",
                '02' => "Februari",
                '03' => "Maret",
                '04' => "April",
                '05' => "Mei",
                '06' => "Juni",
                '07' => "Juli",
                '08' => "Agustus",
                '09' => "September",
                '10' => "Oktober",
                '11' => "November",
                '12' => "Desember"
            );
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Laporan Barang Keluar</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        <?php if (!empty($_GET['cari'])) { ?>
                        Data Laporan Barang Keluar <?= $bulan_tes[$_POST['bln']]; ?> <?= $_POST['thn']; ?>
                        <?php } elseif (!empty($_GET['hari'])) { ?>
                        Data Laporan Barang Keluar <?= $_POST['hari']; ?>
                        <?php } else { ?>
                        Data Laporan Barang Keluar <?= $bulan_tes[date('m')]; ?> <?= date('Y'); ?>
                        <?php } ?>
                    </h4>
                    <div class="card shadow mb-4">
                        <div class="card-body p-1">
                            <form action="header.php?page=laporan-barangkeluar&cari=ok" method="post">
                                <table class="table table-striped">
                                    <tr>
                                        <th>
                                            Pilih Bulan
                                        </th>
                                        <th>
                                            Pilih Tahun
                                        </th>
                                        <th>
                                            Aksi
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="bln" class="form-control">
                                                <option selected="selected">Bulan</option>
                                                <?php
                                                $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", 
                                                "Oktober", "November", "Desember");
                                                $jlh_bln = count($bulan);
                                                $bln1 = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
                                                $no = 1;
                                                for ($c = 0; $c < $jlh_bln; $c += 1) {
                                                    echo "<option value='$bln1[$c]'> $bulan[$c] </option>";
                                                    $no++;
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                        $now = date('Y');
                                        echo "<select name='thn' class='form-control'>";
                                        echo '<option selected="selected">Tahun</option>';
                                        for ($a = 2000; $a <= $now; $a++) {
                                            echo "<option value='$a'>$a</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                        </td>
                                        <td>
                                            <input type="hidden" name="periode" value="ya">
                                            <a href="header.php?page=laporan-barangkeluar&periode=yes" role="button"
                                                class="btn btn-primary">
                                                <i class="fa fa-search"></i> Cari
                                            </a>
                                            <a href="../ui/header.php?page=laporan-barangkeluar"
                                                class="btn btn-success">
                                                <i class="glyphicon glyphicon-refresh"></i> Refresh</a>

                                            <?php if (!empty($_POST['cari'])) { ?>
                                            <a href="header.php?page=export-laporanbarangkeluar&cari=yes&bln=<?= $_POST['bln']; ?>&thn=<?= $_POST['thn']; ?>"
                                                class="btn btn-info" target="_blank"><i
                                                    class="fa fa-file-export fa-1x"></i>
                                                Excel</a>
                                            <?php } else { ?>
                                            <a href="header.php?page=export-laporanbarangkeluar" target="_blank"
                                                class="btn btn-info"><i class="fa fa-file-export fa-1x"></i>
                                                Excel</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <form method="post" action="header.php?page=laporan-barangkeluar&hari=cek">
                                <table class="table table-striped">
                                    <tr>
                                        <th>
                                            Pilih Hari
                                        </th>
                                        <th>
                                            Aksi
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="date" value="<?= date('Y-m-d');?>" class="form-control"
                                                name="hari">
                                        </td>
                                        <td>
                                            <input type="hidden" name="periode" value="ya">
                                            <a href="header.php?page=laporan-barangkeluar&periode=yes" role="button"
                                                class="btn btn-primary">
                                                <i class="fa fa-search"></i> Cari
                                            </a>
                                            <a href="header.php?page=laporan-barangkeluar" class="btn btn-success">
                                                <i class="glyphicon glyphicon-refresh"></i> Refresh</a>

                                            <?php if(!empty($_POST['hari'])){?>
                                            <a href="header.php?page=export-laporanbarangkeluar&hari=cek&tgl=<?= $_POST['hari'];?>"
                                                class="btn btn-info" target="_blank"><i
                                                    class="fa fa-file-export fa-1x"></i>
                                                Excel</a>
                                            <?php }else{?>
                                            <a href="header.php?page=export-laporanbarangkeluar" target="_blank"
                                                class="btn btn-info"><i class="fa fa-file-export fa-1x"></i>
                                                Excel</a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-sm-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                            <h4 style="text-align: center;" class="card-title">Laporan Barang Keluar</h4>
                        </div>
                        <div class="card-body mt-1">
                            <div class="table-responsive">
                                <table class="table table-sm w-100 table-bordered" id="example2">
                                    <thead>
                                        <th>No</th>
                                        <th>Id Transaksi</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Keluar</th>
                                        <th>Satuan Barang</th>
                                        <th>Tujuan</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no=1; 
                                        
                                        if(!empty($_POST['cari'])){
                                            $periode = $_POST['bln'].'-'.$_POST['thn'];
                                            $no=1; 
                                            $hasil = $modelbrgkeluar-> periode_jual($periode);
                                        }elseif(!empty($_POST['hari'])){
                                            $hari = $_POST['hari'];
                                            $no=1; 
                                            $hasil = $modelbrgkeluar-> hari_jual($hari);
                                        }else{
                                            $hasil = $modelbrgkeluar->jual();
                                        }
                                            
                                        foreach ($hasil as $isi) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $isi['id_transaksi'] ?></td>
                                            <td><?php echo $isi['tanggal'] ?></td>
                                            <td><?php echo $isi['kode_barang'] ?></td>
                                            <td><?php echo $isi['nama_barang'] ?></td>
                                            <td><?php echo $isi['jumlah'] ?></td>
                                            <td><?php echo $isi['satuan'] ?></td>
                                            <td><?php echo $isi['tujuan'] ?></td>
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
            <?php 
            require_once("../ui/footer.php");
        ?>