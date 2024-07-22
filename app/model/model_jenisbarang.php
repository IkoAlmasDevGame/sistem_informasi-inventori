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

    public function update($jenis, $id){
        $jenis = htmlentities($_POST['jenis_barang']) ? htmlspecialchars($_POST['jenis_barang']) : $_POST['jenis_barang'];
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : $_POST['id'];
        $table = "jenis_barang";
        $sql = "UPDATE $table SET jenis_barang = '$jenis' WHERE id = '$id'";
        $row = $this->db->query($sql);

        if($row){
            echo "<script>
            alert('berhasil mengubah jenis barang');
            document.location.href = '../ui/header.php?page=jenisbarang';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal mengubah jenis barang');
            document.location.href = '../ui/header.php?page=jenisbarang';
            </script>";
            die;
            exit;
        }
    }

    public function delete($id){
        $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : $_GET['id'];
        $table = "jenis_barang";
        $sql = "DELETE FROM $table WHERE id = '$id'";
        $row = $this->db->query($sql);

        if($row){
            echo "<script>
            alert('berhasil menghapus jenis barang');
            document.location.href = '../ui/header.php?page=jenisbarang';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('gagal menghapus jenis barang');
            document.location.href = '../ui/header.php?page=jenisbarang';
            </script>";
            die;
            exit;
        }
    }
}

?>