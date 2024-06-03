<?php 
require_once("../ui/header.php");
require_once("../ui/sidebar.php");
?>

<div class="container-fluid ">
    <div class="panel panel-default bg-body-tertiary">
        <div class="panel-body">
            <h4 class="panel-heading display-4">Dashboard</h4>
        </div>
        <div class="breadcrumb d-flex justify-content-end align-items-start flex-wrap">
            <li class="breadcrumb breadcrumb-item">
                <div class="fa fa-home"></div>
            </li>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-5 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <?php 
                                    if($_SESSION["role"] == "superadmin"){
                                ?>
                                <a href="?page=pengguna" aria-current="page">
                                    <div class="text-uppercase mb-1">
                                        <h4 class="card-title text-primary display-4">Data Users</h4>
                                    </div>
                                </a>
                                <?php
                                    }else if($_SESSION["role"] == "admin" || $_SESSION["role"] == "petugas"){
                                ?>
                                <a href="?page=ubahpengguna&id=<?=$_SESSION['id']?>" aria-current="page">
                                    <div class="text-uppercase mb-1">
                                        <h4 class="card-title text-primary display-4">Data Users</h4>
                                    </div>
                                </a>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-alt fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-5 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <a href="?page=supplier" aria-current="page">
                                    <div class="text-uppercase mb-1">
                                        <h4 class="card-title text-primary display-4">Data Supplier</h4>
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">

                                        </div>
                                        <div class="col">

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-circle fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-5 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <a href="?page=gudang" aria-current="page">
                                    <div class="text-uppercase mb-1">
                                        <h4 class="card-title text-primary display-4">Data Gudang</h4>
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">

                                        </div>
                                        <div class="col">

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cubes fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-5 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <a href="?page=barangmasuk" aria-current="page">
                                    <div class="text-uppercase mb-1">
                                        <h4 class="card-title text-primary display-4">Barang Masuk</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-5 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <a href="?page=barangkeluar" aria-current="page">
                                    <div class="text-uppercase mb-1">
                                        <h4 class="card-title text-primary display-4">Barang Keluar</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cube fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
                require_once("../ui/kalender.php");
            ?>
        </div>
    </div>
</div>

<?php 
require_once("../ui/footer.php");
?>