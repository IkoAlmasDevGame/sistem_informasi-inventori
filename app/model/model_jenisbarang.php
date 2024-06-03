<?php 
namespace model;

class Jenis {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function Table($query){
        $row = $this->db->query($query);
        return $row;
    }
    
    public function create($jenis){
        $jenis = htmlentities($_POST['jenis_barang']) ? htmlspecialchars($_POST['jenis_barang']) : $_POST['jenis_barang'];
        $table = "jenis_barang";
        $sql = "INSERT $table SET jenis_barang = '$jenis'";
        $row = $this->db->query($sql);

        if($row){
            echo "<script>
            alert('berhasil menambahkan jenis barang');
            document.location.href = '../ui/header.php?page=jenisbarang';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal menambahkan jenis barang');
            document.location.href = '../ui/header.php?page=jenisbarang';
            </script>";
            die;
            exit;
        }
    }
}

?>