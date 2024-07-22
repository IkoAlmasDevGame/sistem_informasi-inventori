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
        <title>Data Master Jenis Barang</title>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h4 class="card-title">ubah Jenis Barang</h4>
                        <a href="?page=jenisbarang" class="btn btn-close fa-1x"></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <?php 
                                if(isset($_GET['id'])){
                                    $id = htmlspecialchars($_GET['id']);
                                    $row = $config->query("SELECT * FROM jenis_barang WHERE id = '$id'");
                                while($isi = $row->fetch_array()){
                            ?>
                            <form action="?aksi=ubah-jenis" method="post">
                                <input type="hidden" name="id" value="<?=$id?>">
                                <table class="table table-striped-columns">
                                    <tr>
                                        <td>
                                            <label for="">Jenis Barang</label>
                                            <input type="text" name="jenis_barang" value="<?=$isi['jenis_barang']?>"
                                                placeholder="masukkan jenis barang" id="jenis_barang"
                                                class="form-control" required>
                                        </td>
                                    </tr>
                                </table>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary hover">
                                            Update
                                        </button>
                                        <a href="?page=jenisbarang" type="button" role="button"
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
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>