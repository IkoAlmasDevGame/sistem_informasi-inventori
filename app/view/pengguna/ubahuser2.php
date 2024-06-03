<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "superadmin" || $_SESSION["role"] == "admin" || $_SESSION["role"] == "petugas")
            {
                require_once("../ui/header.php");
            }else
            {
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Data Master Pengguna</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">Edit Pengguna</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <?php
                        if(isset($_GET['id'])){
                            $id = htmlspecialchars($_GET['id']);
                            $row = $config->query("SELECT * FROM pengguna WHERE id = '$id'");
                            if ($isi = mysqli_fetch_array($row)) {
                        ?>
                        <form action="?aksi=ubah-user" method="post">
                            <input type="hidden" name="id" value="<?=$isi['id']?>">
                            <input type="hidden" name="role" value="<?=$isi['role']?>">
                            <table class="table table-striped-columns">
                                <tr>
                                    <td>
                                        <label for="">User Name</label>
                                        <input type="text" name="username" id="" value="<?=$isi['username']?>"
                                            class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Nama</label>
                                        <input type="text" name="nama" id="" value="<?=$isi['nama']?>"
                                            class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Nomor Telepon</label>
                                        <input type="text" name="nomor_telepon" id="" value="<?=$isi['nomor_telepon']?>"
                                            class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" class="form-control"
                                            required><?php echo $isi['alamat'] ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="" class="form-control" required>
                                    </td>
                                </tr>
                            </table>
                            <div class="card-footer">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary hover">
                                        Simpan
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