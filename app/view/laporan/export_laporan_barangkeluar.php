<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
        if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin"){
            require_once("../ui/header.php");
            require_once("../../database/koneksi.php");

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

    <div class="container-fluid">
        <div class="row">
            <h3 style="text-align:center;">
                <?php if (!empty($_GET['cari'])) { ?>
                Data Laporan Barang Keluar <?= $bulan_tes[$_POST['bln']]; ?> <?= $_POST['thn']; ?>
                <?php } elseif (!empty($_GET['hari'])) { ?>
                Data Laporan Barang Keluar <?= $_POST['hari']; ?>
                <?php } else { ?>
                Data Laporan Barang Keluar <?= $bulan_tes[date('m')]; ?> <?= date('Y'); ?>
                <?php } ?>
            </h3>
            <table border="1" width="100%" cellpadding="3" cellspacing="4">
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
    <?php 
            require_once("../ui/footer.php");
        ?>