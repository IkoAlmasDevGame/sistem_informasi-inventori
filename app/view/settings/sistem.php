<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin")
            {
                require_once("../ui/header.php");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Sistem Website</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title">Data Sistem Website</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>Nama Website</th>
                                        <th>Nama Pembuat</th>
                                        <th>Icon</th>
                                        <th>Opsional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql = "SELECT * FROM sistem WHERE flags = '1'";
                                        $row = $config->query($sql);
                                        while ($data = mysqli_fetch_array($row)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $data["nama_website"] ?></td>
                                        <td><?php echo $data['nama_pembuatan'] ?></td>
                                        <td class="text-center"><img src="../../../assets/logo/<?=$data['icon']?>"
                                                width="32" alt=""></td>
                                        <td>
                                            <a href="?page=sistem&aksi=ubahsistem&id=<?=$data['id']?>"
                                                aria-current="page" class="btn btn-sm btn-warning hover">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
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