<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin")
            {
                require_once("../ui/header.php");
                require_once("../../database/koneksi.php");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Ubah Sistem Website</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">Edit Sistem Website</h4>
                        <a href="?page=sistem" class="btn btn-close fa-1x"></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <?php 
                            if(isset($_GET['id'])){
                                $id = htmlspecialchars($_GET['id']);
                                $row = $config->query("SELECT * FROM sistem WHERE id = '$id'");
                                while($data = mysqli_fetch_array($row)){
                        ?>
                        <form action="?aksi=ubah-sistem" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="id" value="<?=$data['id']?>">
                            <table class="table table-striped-columns">
                                <tr>
                                    <td>
                                        <label for="">Nama Website</label>
                                        <input type="text" name="nama_website" value="<?=$data['nama_website']?>"
                                            class="form-control" required id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Nama Pembuat</label>
                                        <input type="text" name="nama_pembuatan" value="<?=$data['nama_pembuatan']?>"
                                            class="form-control" required id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="https://th.bing.com/th?id=OIP.Sr4fxChDzgG6T-SG4zCS8wHaHa&w=250&h=250&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2"
                                            class="img-thumbnail mt-2" width="64" id="gambar1" alt="">
                                        <div class="mb-4"></div>
                                        <label for="gambar">Pilih Gambar</label>
                                        <div class="mb-1 mb-lg-1"></div>
                                        <input type="file" name="icon" class="form-control-file" id="gambar">
                                        <div class="mb-1 mb-lg-1"></div>
                                        <small>Format: jpg|png|jpeg|gif</small>
                                    </td>
                                </tr>
                            </table>
                            <div class="card-footer">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary hover">
                                        Update
                                    </button>
                                    <a href="?page=sistem" type="button" role="button"
                                        class="btn btn-default">Cancel</a>
                                    <button type="reset" class="btn btn-danger hover">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>