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
                        <h4 class="card-title">Tambah Pengguna</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <form action="?aksi=tambah-user" method="post">
                                <table class="table table-striped-columns">
                                    <tr>
                                        <td>
                                            <label for="">User Name</label>
                                            <input type="text" name="username"
                                                placeholder="masukkan user name baru anda ..." id="username"
                                                class="form-control" maxlength="128" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">User Name</label>
                                            <input type="text" name="nama" placeholder="masukkan nama anda ..."
                                                id="nama" class="form-control" maxlength="128" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Nomor Telepon</label>
                                            <input type="text" name="nomor_telepon"
                                                placeholder="masukkan nomor telepon anda ..." id="telepon"
                                                class="form-control" maxlength="15" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Alamat Rumah</label>
                                            <textarea name="alamat" id="alamat" class="form-control"
                                                placeholder="masukkan alamat rumah anda ..." maxlength="255"
                                                required></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Password</label>
                                            <input type="password" name="password"
                                                placeholder="masukkan password baru anda ..." class="form-control"
                                                maxlength="255" required id="password">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="">Jabatan</label>
                                            <br>
                                            <input type="radio" name="role" id="role" class="ms-3 radio radio-inline"
                                                value="admin"> Admin
                                            <input type="radio" name="role" id="role" class="ms-3 radio radio-inline"
                                                value="petugas"> Petugas
                                        </td>
                                    </tr>
                                </table>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary hover">
                                            Simpan
                                        </button>
                                        <a href="?page=pengguna" type="button" role="button"
                                            class="btn btn-default">Cancel</a>
                                        <button type="reset" class="btn btn-danger hover">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>