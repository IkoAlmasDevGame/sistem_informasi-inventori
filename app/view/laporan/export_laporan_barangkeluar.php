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
            header("Content-Disposition: attachment; filename=Laporan_Barang_Keluar (".date('d-m-Y').").xls");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
        }else{
            header("location:../ui/header.php?page=beranda");
        }
        ?>
        <title>Export Laporan Barang Keluar</title>
    </head>

    <?php 
        if(isset($_POST['submit'])){
            $bln = $_POST['bln'];
        	$thn = $_POST['thn'];
    ?>
    <center>
        <h4>Laporan Barang Keluar Bulan <?php echo $bln;?> Tahun <?php echo $thn;?></h4>
    </center>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Id Transaksi</th>
            <th>Tanggal Masuk</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Keluar</th>
            <th>Satuan Barang</th>
            <th>Tujuan</th>
        </tr>
        <?php 
                $no = 1;
                $sql = "SELECT * FROM barang_keluar WHERE MONTH(tanggal) = '$bln' and YEAR(tanggal) = '$thn'";
                $row = $config->query($sql);
                $hasil = mysqli_fetch_array($row);
                if ($bm = $hasil) {
            ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $bm['id_transaksi'] ?></td>
            <td><?php echo $bm['tanggal'] ?></td>
            <td><?php echo $bm['kode_barang'] ?></td>
            <td><?php echo $bm['nama_barang'] ?></td>
            <td><?php echo $bm['jumlah'] ?></td>
            <td><?php echo $bm['satuan'] ?></td>
            <td><?php echo $bm['tujuan'] ?></td>
        </tr>
        <?php
            $no++;
            }
        ?>
    </table>
    <?php 
            if($bln == 'all'){
        ?>
    <div class="table-responsive">
        <table class="display table table-bordered" id="transaksi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Transaksi</th>
                    <th>Tanggal Masuk</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Keluar</th>
                    <th>Satuan Barang</th>
                    <th>Tujuan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                        $no = 1;
                        $sql = "SELECT * from barang_keluar where YEAR(tanggal) = '$thn'";
                        $row = $config->query($sql);
                        $hasil = mysqli_fetch_array($row);
                        if ($isi = $hasil) {
                    ?>
                <tr>
                    <td><?php echo $no; ?></td>
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
    <?php
            }
        }else{
        ?>
    <div class="table-responsive">
        <table class="display table table-bordered" id="transaksi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Transaksi</th>
                    <th>Tanggal Masuk</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Keluar</th>
                    <th>Satuan Barang</th>
                    <th>Tujuan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                        $no = 1;
                        $sql = "SELECT * from barang_keluar where MONTH(tanggal) = '$bln' and YEAR(tanggal) = '$thn'";
                        $row = $config->query($sql);
                        $hasil = mysqli_fetch_array($row);
                        if ($data = $hasil) {
                    ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['id_transaksi'] ?></td>
                    <td><?php echo $data['tanggal'] ?></td>
                    <td><?php echo $data['kode_barang'] ?></td>
                    <td><?php echo $data['nama_barang'] ?></td>
                    <td><?php echo $data['jumlah'] ?></td>
                    <td><?php echo $data['satuan'] ?></td>
                    <td><?php echo $data['tujuan'] ?></td>
                </tr>
                <?php
                    $no++;
                        }
                    ?>
            </tbody>
        </table>
    </div>
    <?php
        }
        ?>
    <?php 
            require_once("../ui/footer.php");
        ?>