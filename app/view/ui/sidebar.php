<?php 
if($_SESSION["role"] == ""){
    echo "<script>document.location.href = '../auth/index.php'</script>";
    die;
    exit;
}
?>

<?php 
if($_SESSION["role"] == "superadmin")
{
?>
<!-- ======= Header ======= -->

<header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
    <div class="d-flex align-items-center justify-content-between">
        <a href="" role="button" class="logo d-flex align-items-center fs-6 fst-normal fw-semibold">
            <img src="../../../assets/logo/<?=$hasil['icon']?>" alt="">
            <?php echo $hasil['nama_website'] ?>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto mx-3">
        <ul>
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                    data-bs-toggle="dropdown" aria-controls="dropdown">
                    <i class="fa fa-user-alt"></i>
                    <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <hr class="dropdown-divider">
                        <div class="text-start">username : <?php echo $_SESSION['username'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">nomor telepon : <?php echo $_SESSION['nomor_telepon'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">Jabatan : <?php echo $_SESSION['role'] ?></div>
                        <hr class="dropdown-divider">
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
<!-- ======= Header ======= -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="?page=beranda" aria-current="page">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a href="#" data-bs-target="#transaksi-nav" data-bs-toggle="collapse" class="nav-link collapsed">
                <i class="bi bi-menu-button-wide"></i><span>Data Transaksi</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul class="nav-content collapse" id="transaksi-nav" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="?page=barangmasuk" aria-current="page">
                        <i class="bi bi-circle"></i><span>Master Barang Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="?page=barangkeluar" aria-current="page">
                        <i class="bi bi-circle"></i><span>Master Barang Keluar</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="?page=satuanbarang" aria-current="page">
                        <i class="bi bi-circle"></i><span>Master Satuan</span>
                    </a>
                </li>
                <li>
                    <a href="?page=jenisbarang" aria-current="page">
                        <i class="bi bi-circle"></i><span>Master Jenis Barang</span>
                    </a>
                </li>
                <li>
                    <a href="?page=gudang" aria-current="page">
                        <i class="bi bi-circle"></i><span>Master Gudang</span>
                    </a>
                </li>
                <li>
                    <a href="?page=supplier" aria-current="page">
                        <i class="bi bi-circle"></i><span>Master Supplier</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <a href="#" data-bs-target="#laporan-nav" data-bs-toggle="collapse" role="button" class="nav-link collapsed">
            <i class="bi bi-menu-button-wide"></i><span>Data Master Laporan</span><i
                class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul class="nav-content collapse" data-bs-parent="#sidebar-nav" id="laporan-nav">
            <li>
                <a href="?page=laporan-barangmasuk" aria-current="page">
                    <i class="bi bi-circle"></i><span>Laporan Barang Masuk</span>
                </a>
            </li>
            <li>
                <a href="?page=laporan-barangkeluar" aria-current="page">
                    <i class="bi bi-circle"></i><span>Laporan Barang Keluar</span>
                </a>
            </li>
            <li>
                <a href="?page=laporan-gudang" aria-current="page">
                    <i class="bi bi-circle"></i><span>Laporan Stok Gudang</span>
                </a>
            </li>
            <li>
                <a href="?page=laporan-supplier" aria-current="page">
                    <i class="bi bi-circle"></i><span>Laporan Supplier</span>
                </a>
            </li>
            <li>
                <a href="?page=laporan-persediaan" aria-current="page">
                    <i class="bi bi-circle"></i><span>Laporan Persediaan</span>
                </a>
            </li>
        </ul>

        <a href="#" data-bs-target="#setting-nav" data-bs-toggle="collapse" role="button" class="nav-link collapsed">
            <i class="bi bi-menu-button-wide"></i><span>Data Master Settings</span><i
                class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul class="nav-content collapse" data-bs-parent="#sidebar-nav" id="setting-nav">
            <li>
                <a href="?page=sistem" aria-current="page">
                    <i class="bi bi-circle"></i><span>Edit Sistem</span>
                </a>
            </li>
            <li>
                <a href="?page=pengguna" aria-current="page">
                    <i class="bi bi-circle"></i><span>Pengguna</span>
                </a>
            </li>
            <li>
                <a href="?page=ubahpengguna&id=<?=$_SESSION['id']?>" aria-current="page">
                    <i class="bi bi-circle"></i><span>Edit Account</span>
                </a>
            </li>
        </ul>

        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                onclick="return confirm('Apakah anda ingin logout ?')">
                <i class="fa fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Blank Page Nav -->
    </ul>

</aside><!-- End Sidebar-->
<!-- ======= Sidebar ======= -->

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                </div>

            </div><!-- End Right side columns -->

        </div>
    </section>
    <?php
}else if($_SESSION["role"] == "admin")
{
?>
    <!-- ======= Header ======= -->

    <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
        <div class="d-flex align-items-center justify-content-between">
            <a href="" role="button" class="logo d-flex align-items-center fs-6 fst-normal fw-semibold">
                <img src="../../../assets/logo/<?=$hasil['icon']?>" alt="">
                <?php echo $hasil['nama_website'] ?>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto mx-3">
            <ul>
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                        data-bs-toggle="dropdown" aria-controls="dropdown">
                        <i class="fa fa-user-alt"></i>
                        <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <hr class="dropdown-divider">
                            <div class="text-start">username : <?php echo $_SESSION['username'] ?></div>
                            <div class="mb-1"></div>
                            <div class="text-start">nomor telepon : <?php echo $_SESSION['nomor_telepon'] ?></div>
                            <div class="mb-1"></div>
                            <div class="text-start">Jabatan : <?php echo $_SESSION['role'] ?></div>
                            <hr class="dropdown-divider">
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header>
    <!-- ======= Header ======= -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link" href="?page=beranda" aria-current="page">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a href="#" data-bs-target="#transaksi-nav" data-bs-toggle="collapse" class="nav-link collapsed">
                    <i class="bi bi-menu-button-wide"></i><span>Transaksi</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul class="nav-content collapse" id="transaksi-nav" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?page=barangmasuk" aria-current="page">
                            <i class="bi bi-circle"></i><span>Master Barang Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=barangkeluar" aria-current="page">
                            <i class="bi bi-circle"></i><span>Master Barang Keluar</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?page=satuanbarang" aria-current="page">
                            <i class="bi bi-circle"></i><span>Master Satuan</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=jenisbarang" aria-current="page">
                            <i class="bi bi-circle"></i><span>Master Jenis Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=gudang" aria-current="page">
                            <i class="bi bi-circle"></i><span>Master Gudang</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=supplier" aria-current="page">
                            <i class="bi bi-circle"></i><span>Master Supplier</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->

            <a href="#" data-bs-target="#laporan-nav" data-bs-toggle="collapse" role="button"
                class="nav-link collapsed">
                <i class="bi bi-menu-button-wide"></i><span>Data Master Laporan</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul class="nav-content collapse" data-bs-parent="#sidebar-nav" id="laporan-nav">
                <li>
                    <a href="?page=laporan-barangmasuk" aria-current="page">
                        <i class="bi bi-circle"></i><span>Laporan Barang Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="?page=laporan-barangkeluar" aria-current="page">
                        <i class="bi bi-circle"></i><span>Laporan Barang Keluar</span>
                    </a>
                </li>
                <li>
                    <a href="?page=laporan-gudang" aria-current="page">
                        <i class="bi bi-circle"></i><span>Laporan Stok Gudang</span>
                    </a>
                </li>
                <li>
                    <a href="?page=laporan-supplier" aria-current="page">
                        <i class="bi bi-circle"></i><span>Laporan Supplier</span>
                    </a>
                </li>
            </ul>

            <a href="#" data-bs-target="#setting-nav" data-bs-toggle="collapse" role="button"
                class="nav-link collapsed">
                <i class="bi bi-menu-button-wide"></i><span>Data Master Settings</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul class="nav-content collapse" data-bs-parent="#sidebar-nav" id="setting-nav">
                <!-- <li>
                    <a href="?page=" aria-current="page">
                        <i class="bi bi-circle"></i><span>Edit Sistem</span>
                    </a>
                </li> -->
                <li>
                    <a href="?page=ubahpengguna&id=<?=$_SESSION['id']?>" aria-current="page">
                        <i class="bi bi-circle"></i><span>Edit Account</span>
                    </a>
                </li>
            </ul>

            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                    onclick="return confirm('Apakah anda ingin logout ?')">
                    <i class="fa fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Blank Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->
    <!-- ======= Sidebar ======= -->

    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                    </div>

                </div><!-- End Right side columns -->

            </div>
        </section>
        <?php
}else if($_SESSION["role"] == "petugas")
{
?>
        <!-- ======= Header ======= -->

        <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
            <div class="d-flex align-items-center justify-content-between">
                <a href="" role="button" class="logo d-flex align-items-center fs-6 fst-normal fw-semibold">
                    <img src="../../../assets/logo/<?=$hasil['icon']?>" alt="">
                    <?php echo $hasil['nama_website'] ?>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div><!-- End Logo -->

            <nav class="header-nav ms-auto mx-3">
                <ul>
                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                            data-bs-toggle="dropdown" aria-controls="dropdown">
                            <i class="fa fa-user-alt"></i>
                            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <hr class="dropdown-divider">
                                <div class="text-start">username : <?php echo $_SESSION['username'] ?></div>
                                <div class="mb-1"></div>
                                <div class="text-start">nomor telepon : <?php echo $_SESSION['nomor_telepon'] ?></div>
                                <div class="mb-1"></div>
                                <div class="text-start">Jabatan : <?php echo $_SESSION['role'] ?></div>
                                <hr class="dropdown-divider">
                            </li>
                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

        </header>
        <!-- ======= Header ======= -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="?page=beranda" aria-current="page">
                        <i class="fa fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a href="#" data-bs-target="#transaksi-nav" data-bs-toggle="collapse" class="nav-link collapsed">
                        <i class="bi bi-menu-button-wide"></i><span>Data Transaksi</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul class="nav-content collapse" id="transaksi-nav" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="?page=barangmasuk" aria-current="page">
                                <i class="bi bi-circle"></i><span>Master Barang Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=barangkeluar" aria-current="page">
                                <i class="bi bi-circle"></i><span>Master Barang Keluar</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="?page=satuanbarang" aria-current="page">
                                <i class="bi bi-circle"></i><span>Master Satuan</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=jenisbarang" aria-current="page">
                                <i class="bi bi-circle"></i><span>Master Jenis Barang</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=gudang" aria-current="page">
                                <i class="bi bi-circle"></i><span>Master Gudang</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=supplier" aria-current="page">
                                <i class="bi bi-circle"></i><span>Master Supplier</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->

                <a href="#" data-bs-target="#setting-nav" data-bs-toggle="collapse" role="button"
                    class="nav-link collapsed">
                    <i class="bi bi-menu-button-wide"></i><span>Data Master Settings</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul class="nav-content collapse" data-bs-parent="#sidebar-nav" id="setting-nav">
                    <!-- <li>
                        <a href="?page=" aria-current="page">
                            <i class="bi bi-circle"></i><span>Edit Sistem</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="?page=ubahpengguna&id=<?=$_SESSION['id']?>" aria-current="page">
                            <i class="bi bi-circle"></i><span>Edit Account</span>
                        </a>
                    </li>
                </ul>

                <li class="nav-item">
                    <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                        onclick="return confirm('Apakah anda ingin logout ?')">
                        <i class="fa fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li><!-- End Blank Page Nav -->
            </ul>

        </aside><!-- End Sidebar-->
        <!-- ======= Sidebar ======= -->

        <main id="main" class="main">
            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-8">
                        <div class="row">

                        </div>

                    </div><!-- End Right side columns -->

                </div>
            </section>
            <?php
}else{
    echo "<script>
    document.location.href = '../auth/index.php';
    </script>";
    die;
    exit;
}
?>