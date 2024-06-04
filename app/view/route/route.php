<?php 
require_once("../../database/koneksi.php");
$row = $config->query("SELECT * FROM sistem WHERE flags = '1'");
$hasil = $row->fetch_array();
require_once("../../controller/controller.php");
// Model To Controller
require_once("../../model/model_pengguna.php");
require_once("../../model/model_barangmasuk.php");
require_once("../../model/model_barangkeluar.php");
require_once("../../model/model_gudang.php");
require_once("../../model/model_satuan.php");
require_once("../../model/model_jenisbarang.php");
require_once("../../model/model_supplier.php");
require_once("../../model/model_sistem.php");

// Aksi Controller
$user = new controller\Authentication($config);
$barangmasuk = new controller\Masuk($config);
$barangkeluar = new controller\Keluar($config);
$jenis = new controller\JenisBarang($config);
$satuan = new controller\SatuanBarang($config);
$gudang = new controller\Building($config);
$supplier = new controller\Distributor($config);
$sistem = new controller\Sistem($config);

if(!isset($_GET["page"])){
    require_once("../dashboard/index.php");
}else{
    switch ($_GET["page"]) {
        case 'beranda':
            require_once("../dashboard/index.php");
            break;
            
        case 'barangmasuk':
            require_once("../barangmasuk/barangmasuk.php");
            break;

        case 'barangkeluar':
            require_once("../barangkeluar/barangkeluar.php");
            break;

        case 'gudang':
            require_once("../gudang/gudang.php");
            break;

        case 'satuanbarang':
            require_once("../satuanbarang/satuanbarang.php");
            break;

        case 'jenisbarang':
            require_once("../jenisbarang/jenisbarang.php");
            break;
            
        case 'pengguna':
            require_once("../pengguna/user.php");
            break;

        case 'ubahpengguna':
            require_once("../pengguna/ubahuser2.php");
            break;
            
        case 'supplier':
            require_once("../supplier/supplier.php");
            break;
            
        case 'sistem':
            require_once("../settings/sistem.php");
            break;
            
        // Laporan Barang Masuk
        case 'laporan-barangmasuk':
            require_once("../laporan/laporan_barangmasuk.php");
            break;
            
        case 'export-laporanbarangmasuk':
            require_once("../laporan/export_laporan_barangmasuk.php");
            break;
        // Laporan Barang Masuk
            
        // Laporan Barang Keluar
        case 'laporan-barangkeluar':
            require_once("../laporan/laporan_barangkeluar.php");
            break;
            
        case 'export-laporanbarangkeluar':
            require_once("../laporan/export_laporan_barangkeluar.php");
            break;
        // Laporan Barang Keluar
            
        // Laporan Barang Gudang
        case 'laporan-gudang':
            require_once("../laporan/laporan_gudang.php");
            break;
            
        case 'export-laporangudang':
            require_once("../laporan/export_laporan_gudang.php");
            break;
        // Laporan Barang Gudang
            
        // Laporan Barang Supplier
        case 'laporan-supplier':
            require_once("../laporan/laporan_supplier.php");
            break;
            
        case 'export-laporansupplier':
            require_once("../laporan/export_laporan_supplier.php");
            break;
        // Laporan Barang Supplier
            
        case 'keluar':
            if(isset($_SESSION['status'])){
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            header("location:../auth/index.php");
            exit(0);
            break;
            
        default:
            require_once("../dashboard/index.php");
            break;
    }
}

if(!isset($_GET["aksi"])){
    require_once("../../controller/controller.php");
}else{
    switch ($_GET["aksi"]) {
        // Data Master Barang Masuk
        case 'tambahbarangmasuk':
            require_once("../barangmasuk/tambahbarangmasuk.php");
            break;
            // Aksi Barang Masuk
        case 'tambah-barangmasuk':
            $barangmasuk->buat();
            break;
        case 'hapus-barangmasuk':
            $barangmasuk->hapus();
            break;
        // Data Master Barang Masuk
        
        // Data Master Barang Keluar
        case 'tambahbarangkeluar':
            require_once("../barangkeluar/tambahbarangkeluar.php");
            break;
            // Aksi Barang Keluar
        case 'tambah-barangkeluar':
            $barangkeluar->buat();
            break;
        case 'hapus-barangkeluar':
            $barangkeluar->hapus();
            break;
        // Data Master Barang Keluar

        // Data Master Barang Gudang
        case 'tambahgudang':
            require_once("../gudang/tambahgudang.php");
            break;
        case 'ubahgudang':
            require_once("../gudang/ubahgudang.php");
            break;
            // Aksi Gudang
            case 'tambah-gudang':
                $gudang->buat();
                break;
            case 'ubah-gudang':
                $gudang->ubah();
                break;
            case 'hapus-gudang':
                $gudang->hapus();
                break;
        // Data Master Barang Gudang
        
        // Data Master Barang Jenis
        case 'tambahjenisbarang':
            require_once("../jenisbarang/tambahjenisbarang.php");
            break;
            // Aksi Jenis
            case 'tambah-jenis':
                $jenis->buat();
                break;
        // Data Master Barang Jenis
        
        // Data Master Barang Satuan
        case 'tambahsatuanbarang':
            require_once("../satuanbarang/tambahsatuanbarang.php");
            break;
        case 'ubahsatuanbarang':
            require_once("../satuanbarang/ubahsatuanbarang.php");
            break;
            // Aksi Satuan Barang
            case 'create-satuan':
                $satuan->buat();
                break;
            case 'ubah-satuan':
                $satuan->ubah();
                break;
            case 'hapus-satuan':
                $satuan->hapus();
                break;
        // Data Master Barang Satuan
        
        // Data Master Pengguna
        case 'tambahuser':
            require_once("../pengguna/tambahuser.php");
            break;
        case 'ubahuser':
            require_once("../pengguna/ubahuser.php");
            break;
            // Aksi Pengguna
            case 'tambah-user':
                $user->buat();
                break;
            case 'ubah-user':
                $user->ubah();
                break;
            case 'hapus-user':
                $user->hapus();
                break;
        // Data Master Pengguna
        
        // Data Master supplier
        case 'tambahsupplier':
            require_once("../supplier/tambahsupplier.php");
            break;
        case 'ubahsupplier':
            require_once("../supplier/ubahsupplier.php");
            break;
            // Aksi supplier
            case 'tambah-supplier':
                $supplier->buat();
                break;
            case 'ubah-supplier':
                $supplier->ubah();
                break;
            case 'hapus-supplier':
                $supplier->hapus();
                break;
        // Data Master supplier
        
        // Data Master Sistem
        case 'ubahsistem':
            require_once("../settings/ubahsistem.php");
            break;
            // Aksi Satuan Sistem
            case 'ubah-sistem':
                $sistem->ubah();
                break;
        // Data Master Sistem
        
        default:
            require_once("../../controller/controller.php");
            break;
    }
}
?>