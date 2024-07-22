<?php 
namespace model;

class BarangKeluar {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function Table($query){
        $row = $this->db->query($query);
        return $row;
    }
    
    public function create($id_transaksi, $tanggal, $kode_barang, $nama_barang, $jumlah, $total, $satuan, $tujuan){
        $id_transaksi = htmlentities($_POST['id_transaksi']) ? htmlspecialchars($_POST['id_transaksi']) : $_POST['id_transaksi'];
        $tanggal = htmlentities($_POST['tanggal_keluar']) ? htmlspecialchars($_POST['tanggal_keluar']) : $_POST['tanggal_keluar'];
        $barang = htmlentities($_POST['barang']) ? htmlspecialchars($_POST['barang']) : $_POST['barang'];
        $pecah_barang = explode(".", $barang);
        $kode_barang = $pecah_barang[0];
        $nama_barang = $pecah_barang[1];
        $jumlah = htmlspecialchars($_POST['jumlahkeluar']) ? htmlentities($_POST['jumlahkeluar']) : $_POST['jumlahkeluar'];
        $satuan = htmlspecialchars($_POST['satuan']) ? htmlentities($_POST['satuan']) : $_POST['satuan'];
        $tujuan = htmlspecialchars($_POST['tujuan']) ? htmlentities($_POST['tujuan']) : $_POST['tujuan'];

        $total = htmlspecialchars($_POST['total']) ? htmlentities($_POST['total']) : $_POST['total'];
        $sisa2 = $total;
        if($sisa2 < 0){
            echo "<script>
            alert('Stok Barang Habis, Transaksi Tidak Dapat Dilakukan');
            document.location.href = '../ui/header.php?page=barangkeluar&aksi=tambahbarangkeluar';
            </script>";
            die;
            exit;
        }else{
            $table = "barang_keluar";
            $sql = "INSERT INTO $table (id_transaksi, tanggal, kode_barang, nama_barang, jumlah, total, satuan, tujuan) VALUES
             ('$id_transaksi','$tanggal','$pecah_barang[0]','$pecah_barang[1]','$jumlah','$total','$satuan','$tujuan')";
            $row = $this->db->query($sql);
            $this->db->query("UPDATE gudang SET jumlah=(jumlah) where kode_barang = '$kode_barang'");
        }

        if($row){
            echo "<script>
            alert('Simpan Data Berhasil');
            document.location.href = '../ui/header.php?page=barangkeluar';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('Data Gagal tersimpan');
            document.location.href = '../ui/header.php?page=barangkeluar';
            </script>";
            die;
            exit;            
        }
    }

    public function delete($id_transaksi){
        $id_transaksi = htmlentities($_GET['id_transaksi']) ? htmlspecialchars($_GET['id_transaksi']) : $_GET['id_transaksi'];
        $table = "barang_keluar";
        $sql = "DELETE FROM $table WHERE id_transaksi = '$id_transaksi'";
        $row = $this->db->query($sql);

        if($row){
            echo "<script>
            alert('Hapus Data Berhasil');
            document.location.href = '../ui/header.php?page=barangkeluar';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('Hapus Data Gagal');
            document.location.href = '../ui/header.php?page=barangkeluar';
            </script>";
            die;
            exit;            
        }
    }

    public function jual(){
        $date = date("Y-m-d");
        $sql = "SELECT * FROM barang_keluar WHERE tanggal = ? order by id asc";
        $row = $this->db->prepare($sql);
        $row->execute(array($date));
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function periode_jual($periode){
        $sql = "SELECT * FROM barang_keluar WHERE tanggal = ? order by id asc";
        $row = $this->db->prepare($sql);
        $row->execute(array($periode));
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function hari_jual($hari){
        $ex = explode('-', $hari);
        $monthNum  = $ex[1];
        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
        if ($ex[2] > 9) {
            $tgl = $ex[2];
        } else {
            $tgl1 = explode('0', $ex[2]);
            $tgl = $tgl1[1];
        }
        $cek = $tgl.' '.$monthName.' '.$ex[0];
        $param = "%{$cek}%";
        $sql = "SELECT * FROM barang_keluar WHERE tanggal = ? order by id asc";
        $row = $this->db->prepare($sql);
        $row->execute(array($param));
        $hasil = $row->fetchAll();
        return $hasil;
    }
}

?>