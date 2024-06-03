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
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="panel-heading">Data Master Pengguna</h4>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="card-title">Pengguna</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User Name</th>
                                    <th>Nama</th>
                                    <th>Nomor Telepon</th>
                                    <th>Alamat</th>
                                    <th>Password</th>
                                    <th>Jabatan</th>
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $row = $user->Read("SELECT * FROM pengguna order by id asc");
                                    while ($isi = mysqli_fetch_array($row)) {
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $isi['username'] ?></td>
                                    <td><?php echo $isi['nama'] ?></td>
                                    <td><?php echo $isi['nomor_telepon'] ?></td>
                                    <td><?php echo $isi['alamat'] ?></td>
                                    <td>Password Ter-Enkripsi</td>
                                    <td><?php echo $isi['role'] ?></td>
                                    <td>
                                        <a href="?page=pengguna&aksi=ubahuser&id=<?=$isi['id']?>" role="button"
                                            aria-current="page" class="btn btn-sm btn-warning hover">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="?page=pengguna&aksi=hapus-user&id=<?=$isi['id']?>"
                                            onclick="return confirm('Apakah anda ingin menghapus akun user ini ?')"
                                            role="button" aria-current="page" class="btn btn-sm btn-danger hover">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <a href="?page=pengguna&aksi=tambahuser" role="button" aria-current="page"
                                    class="btn btn-danger hover">
                                    <i class="bi bi-plus"></i><span>Tambah Data Pengguna</span>
                                </a>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>