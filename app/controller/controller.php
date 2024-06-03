<?php 
namespace controller;
use model\Pengguna;
use model\BarangMasuk;
use model\BarangKeluar;
use model\Gudang;
use model\Jenis;
use model\Satuan;
use model\Supplier;
use model\website;

class Authentication {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Pengguna($konfig);
    }
    
    public function Read($query){
        $row = $this->konfig->Table($query);
        return $row;
    }

    public function UpdateRead($query,$id){
        $row = $this->konfig->TableUpdate($query,$id);
        $hasil = mysqli_fetch_array($row);
        return $hasil;
    }

    public function buat(){
        $username = htmlentities($_POST["username"]) ? htmlspecialchars($_POST["username"]) : $_POST["username"];
        $nama = htmlentities($_POST["nama"]) ? htmlspecialchars($_POST["nama"]) : $_POST["nama"];
        $telepon = htmlentities($_POST["nomor_telepon"]) ? htmlspecialchars($_POST["nomor_telepon"]) : $_POST["nomor_telepon"];
        $alamat = htmlentities($_POST["alamat"]) ? htmlspecialchars($_POST["alamat"]) : $_POST["alamat"];
        $password = md5(htmlspecialchars($_POST['password']), false);
        $role = htmlentities($_POST["role"]) ? htmlspecialchars($_POST["role"]) : $_POST["role"];

        $result = $this->konfig->create($username,$nama,$telepon,$alamat,$password,$role);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $username = htmlentities($_POST["username"]) ? htmlspecialchars($_POST["username"]) : $_POST["username"];
        $nama = htmlentities($_POST["nama"]) ? htmlspecialchars($_POST["nama"]) : $_POST["nama"];
        $telepon = htmlentities($_POST["nomor_telepon"]) ? htmlspecialchars($_POST["nomor_telepon"]) : $_POST["nomor_telepon"];
        $alamat = htmlentities($_POST["alamat"]) ? htmlspecialchars($_POST["alamat"]) : $_POST["alamat"];
        $password = md5(htmlspecialchars($_POST['password']), false);
        $role = htmlentities($_POST["role"]) ? htmlspecialchars($_POST["role"]) : $_POST["role"];
        $id = htmlentities($_POST["id"]) ? htmlspecialchars($_POST["id"]) : $_POST["id"];

        $result = $this->konfig->update($username,$nama,$telepon,$alamat,$password,$role,$id);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }
    
    public function hapus(){
        $id = htmlentities($_GET["id"]) ? htmlspecialchars($_GET["id"]) : $_GET["id"];

        $result = $this->konfig->delete($id);
        if($result === true){
            uniqid($id);
            return true;
        }else{
            return false;
        }
    }

    public function Login(){
        session_start();
        $userInput = htmlentities($_POST["userInput"]) ? htmlspecialchars($_POST["userInput"]) : $_POST["userInput"];
        $password = md5(htmlspecialchars($_POST["password"]), false);
        $this->konfig->SignIn($userInput,$password);
    }
}

class Masuk {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new BarangMasuk($konfig);
    }

    public function Read($query){
        $row = $this->konfig->Table($query);
        return $row;
    }

    public function buat(){
        $id_transaksi = htmlentities($_POST['id_transaksi']) ? htmlspecialchars($_POST['id_transaksi']) : $_POST['id_transaksi'];
        $tanggal = htmlentities($_POST['tanggal_masuk']) ? htmlspecialchars($_POST['tanggal_masuk']) : $_POST['tanggal_masuk'];
        $barang = htmlentities($_POST['barang']) ? htmlspecialchars($_POST['barang']) : $_POST['barang'];
        $pecah_barang = explode(".", $barang);
        $kode_barang = $pecah_barang[0];
        $nama_barang = $pecah_barang[1];
        $jumlah = htmlspecialchars($_POST['jumlahmasuk']) ? htmlentities($_POST['jumlahmasuk']) : $_POST['jumlahmasuk'];
        $pengirim = htmlspecialchars($_POST['pengirim']) ? htmlentities($_POST['pengirim']) : $_POST['pengirim'];
        $pecah_nama = explode(".", $pengirim);
        $nama_supplier = $pecah_nama[0];
        $satuan = htmlspecialchars($_POST['satuan']) ? htmlentities($_POST['satuan']) : $_POST['satuan'];
        $this->konfig->create($id_transaksi,$tanggal,$kode_barang,$nama_barang,$jumlah,$satuan,$pengirim);
    }

    public function hapus(){
        $id_transaksi = htmlentities($_GET['id_transaksi']) ? htmlspecialchars($_GET['id_transaksi']) : $_GET['id_transaksi'];
        $result = $this->konfig->delete($id_transaksi);
        if($result === true){
            uniqid($id_transaksi);
            return true;
        }else{
            return false;
        }
    }
}

class Keluar {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new BarangKeluar($konfig);
    }

    public function Read($query){
        $row = $this->konfig->Table($query);
        return $row;
    }

    public function buat(){
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
        $this->konfig->create($id_transaksi, $tanggal, $kode_barang, $nama_barang, $jumlah, $total, $satuan, $tujuan);
    }

    public function hapus(){
        $id_transaksi = htmlentities($_GET['id_transaksi']) ? htmlspecialchars($_GET['id_transaksi']) : $_GET['id_transaksi'];
        $result = $this->konfig->delete($id_transaksi);
        if($result === true){
            uniqid($id_transaksi);
            return true;
        }else{
            return false;
        }
    }
}

class JenisBarang {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Jenis($konfig);
    }

    public function Read($query){
        $row = $this->konfig->Table($query);
        return $row;
    }

    public function buat(){
        $jenis = htmlentities($_POST['jenis_barang']) ? htmlspecialchars($_POST['jenis_barang']) : $_POST['jenis_barang'];
        $result = $this->konfig->create($jenis);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }
}

class SatuanBarang {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Satuan($konfig);
    }

    public function Read($query){
        $row = $this->konfig->Table($query);
        return $row;
    }

    public function UpdateRead($query){
        $row = $this->konfig->TableUpdate($query);
        return $row;
    }

    public function buat(){
        $satuan = htmlentities($_POST['satuan']) ? htmlspecialchars($_POST['satuan']) : $_POST['satuan'];
        $result = $this->konfig->create($satuan);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }
    
    public function ubah(){
        $satuan = htmlentities($_POST['satuan']) ? htmlspecialchars($_POST['satuan']) : $_POST['satuan'];
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : $_POST['id'];

        $result = $this->konfig->update($satuan,$id);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }
    
    public function hapus(){
        $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : $_GET['id'];

        $result = $this->konfig->delete($id);
        if($result === true){
            uniqid($id);
            return true;
        }else{
            return false;
        }
    }
}

class Building {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Gudang($konfig);
    }

    public function Read($query){
        $row = $this->konfig->Table($query);
        return $row;
    }

    public function UpdateRead($query){
        $row = $this->konfig->TableUpdate($query);
        return $row;
    }

    public function buat(){
        $kode_barang = htmlentities($_POST['kode_barang']) ? htmlspecialchars($_POST['kode_barang']) : $_POST['kode_barang'];
        $nama_barang = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $jenis_barang = htmlentities($_POST['jenis_barang']) ? htmlspecialchars($_POST['jenis_barang']) : $_POST['jenis_barang'];
		$pecah_jenis = explode(".", $jenis_barang);
		$id = $pecah_jenis[0];
        $jenis_barang_pecah = $pecah_jenis[1];
        $jumlah = htmlentities($_POST['jumlah']) ? htmlspecialchars($_POST['jumlah']) : $_POST['jumlah'];
        $satuan= htmlentities($_POST['satuan']) ? htmlspecialchars($_POST['satuan']) : $_POST['satuan'];
        $pecah_satuan = explode(".", $satuan);     
        $id = $pecah_satuan[0];
        $satuan_pecah = $pecah_satuan[1];

        $result = $this->konfig->create($kode_barang,$nama_barang,$jenis_barang,$jumlah,$satuan);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $kode_barang = htmlentities($_POST['kode_barang']) ? htmlspecialchars($_POST['kode_barang']) : $_POST['kode_barang'];
        $nama_barang = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $jenis_barang = htmlentities($_POST['jenis_barang']) ? htmlspecialchars($_POST['jenis_barang']) : $_POST['jenis_barang'];
		$pecah_jenis = explode(".", $jenis_barang);
		$id = $pecah_jenis[0];
        $jenis_barang_pecah = $pecah_jenis[1];
        $jumlah = htmlentities($_POST['jumlah']) ? htmlspecialchars($_POST['jumlah']) : $_POST['jumlah'];
        $satuan= htmlentities($_POST['satuan']) ? htmlspecialchars($_POST['satuan']) : $_POST['satuan'];
        $pecah_satuan = explode(".", $satuan);     
        $id = $pecah_satuan[0];
        $satuan_pecah = $pecah_satuan[1];
        $id_gudang = htmlentities($_POST["id"]) ? htmlspecialchars($_POST["id"]) : $_POST["id"];

        $result = $this->konfig->update($kode_barang,$nama_barang,$jenis_barang,$jumlah,$satuan,$id_gudang);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_gudang = htmlentities($_GET["id"]) ? htmlspecialchars($_GET["id"]) : $_GET["id"];
        $result = $this->konfig->delete($id_gudang);

        if($result === true){
            uniqid($id_gudang);
            return true;
        }else{
            return false;
        }
    }
}

class Distributor {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Supplier($konfig);
    }

    public function Read($query){
        $row = $this->konfig->Table($query);
        return $row;
    }

    public function UpdateRead($query,$id){
        $row = $this->konfig->TableUpdate($query,$id);
        $hasil = mysqli_fetch_array($row);
        return $hasil;
    }

    public function buat(){
        $kode_supplier = htmlentities($_POST['kode_supplier']) ? htmlspecialchars($_POST['kode_supplier']) : $_POST['kode_supplier'];
        $nama_supplier = htmlentities($_POST['nama_supplier']) ? htmlspecialchars($_POST['nama_supplier']) : $_POST['nama_supplier'];
        $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : $_POST['alamat'];
        $telepon = htmlentities($_POST['telepon']) ? htmlspecialchars($_POST['telepon']) : $_POST['telepon'];

        $result = $this->konfig->create($kode_supplier, $nama_supplier, $alamat, $telepon);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $kode_supplier = htmlentities($_POST['kode_supplier']) ? htmlspecialchars($_POST['kode_supplier']) : $_POST['kode_supplier'];
        $nama_supplier = htmlentities($_POST['nama_supplier']) ? htmlspecialchars($_POST['nama_supplier']) : $_POST['nama_supplier'];
        $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : $_POST['alamat'];
        $telepon = htmlentities($_POST['telepon']) ? htmlspecialchars($_POST['telepon']) : $_POST['telepon'];
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : $_POST['id'];

        $result = $this->konfig->update($kode_supplier, $nama_supplier, $alamat, $telepon, $id);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : $_GET['id'];
        $result = $this->konfig->delete($id);
        if($result === true){
            uniqid($id);
            return true;
        }else{
            return false;
        }    
    }
}

class Sistem {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new website($konfig);
    }

    public function Read($query){
        $row = $this->konfig->Table($query);
        return $row;
    }

    public function UpdateRead($query,$id){
        $row = $this->konfig->TableUpdate($query,$id);
        $hasil = mysqli_fetch_array($row);
        return $hasil;
    }

    public function ubah(){
        $nama_website = htmlentities($_POST['nama_website']) ? htmlspecialchars($_POST['nama_website']) : $_POST['nama_website'];
        $nama_pembuatan = htmlentities($_POST['nama_pembuatan']) ? htmlspecialchars($_POST['nama_pembuatan']) : $_POST['nama_pembuatan'];
        $icon = htmlentities($_FILES["icon"]["name"]) ? htmlspecialchars($_FILES["icon"]["name"]) : $_FILES["icon"]["name"];
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : $_POST['id'];
        
        $result = $this->konfig->update($nama_website,$nama_pembuatan,$icon,$id);
            if($result === true){
            return true;
        }else{
            return false;
        }
    }
}
?>