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
	        header("Content-Disposition: attachment; filename=Laporan_Supplier (".date('d-m-Y').").xls");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
        }else{
            header("location:../ui/header.php?page=beranda");
        }
        ?>
        <title>Export Laporan Supplier</title>
    </head>

    <body>
        <h2>Laporan Stok Gudang</h2>
        <div class="table-responsive">
            <table class="display table table-bordered" border="1" id="supplier">
                <tr>
                    <th>No</th>
                    <th>Kode Supplier</th>
                    <th>Nama Supplier</th>
                    <th>Alamat Supplier</th>
                    <th>Telepon Supplier</th>
                </tr>
                <?php 
                $no = 1;
                $sql = "SELECT * FROM supplier order by id asc";
                $row = $config->query($sql);
                $hasil = mysqli_fetch_array($row);
                if ($data = $hasil) {
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['kode_supplier'] ?></td>
                    <td><?php echo $data['nama_supplier'] ?></td>
                    <td><?php echo $data['alamat'] ?></td>
                    <td><?php echo $data['telepon'] ?></td>
                </tr>
                <?php
            $no++;
                }
            ?>
            </table>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>