<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
        if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin"){
            require_once("../../database/koneksi.php");
            header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-Disposition: attachment; filename=Laporan_Stok_Gudang (".date('d-m-Y').").xls");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
        }else{
            header("location:../ui/header.php?page=beranda");
        }
        ?>
        <title>Export Laporan Gudang</title>
    </head>

    <body>
        <h2>Laporan Stok Gudang</h2>
        <table border="1">
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Jumlah Barang</th>
                <th>Satuan</th>
            </tr>
            <?php 
                $no = 1;
                $sql = "SELECT * FROM gudang order by id asc";
                $row = $config->query($sql);
                $hasil = mysqli_fetch_array($row);
                if ($data = $hasil) {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data['kode_barang'] ?></td>
                <td><?php echo $data['nama_barang'] ?></td>
                <td><?php echo $data['jenis_barang'] ?></td>
                <td><?php echo $data['jumlah'] ?></td>
                <td><?php echo $data['satuan'] ?></td>
            </tr>
            <?php
            $no++;
                }
            ?>
        </table>
    </body>

</html>