<?php 
namespace model;

class website {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function Table($query){
        $row = $this->db->prepare($query);
        return $row;
    }
    
    public function TableUpdate($query,$id){
        $row = $this->db->prepare($query);
        $row->execute(array($id));
        return $row;
    }

    public function update($nama_website, $nama_pembuatan, $icon, $id){
        $nama_website = htmlentities($_POST['nama_website']) ? htmlspecialchars($_POST['nama_website']) : $_POST['nama_website'];
        $nama_pembuatan = htmlentities($_POST['nama_pembuatan']) ? htmlspecialchars($_POST['nama_pembuatan']) : $_POST['nama_pembuatan'];
        $id = htmlentities($_POST['id']) ? htmlspecialchars($_POST['id']) : $_POST['id'];
        
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif', 'gif'); 
        $icon = htmlentities($_FILES["icon"]["name"]) ? htmlspecialchars($_FILES["icon"]["name"]) : $_FILES["icon"]["name"];
        $x_foto = explode('.', $icon);
        $ekstensi_foto = strtolower(end($x_foto));
        $ukuran_foto = $_FILES['icon']['size'];
        $file_tmp_foto = $_FILES['icon']['tmp_name'];

        if(in_array($ekstensi_foto,$ekstensi_diperbolehkan_foto) === true){
            if($ukuran_foto < 10440070){
                move_uploaded_file($file_tmp_foto, "../../../../assets/logo/" . $icon);
                $sql = "UPDATE sistem SET nama_website = '$nama_website', nama_pembuatan = '$nama_pembuatan', icon = '$icon', flags = '1' WHERE id = '$id'"; 
                $row = $this->db->query($sql);
                if($row){
                    echo "<script>
                    alert('berhasil ubah');
                    document.location.href = '../ui/header.php?page=sistem';
                    </script>";
                    die;
                    exit;
                }else{
                    echo "<script>
                    alert('gagal ubah');
                    document.location.href = '../ui/header.php?page=sistem';
                    </script>";                    
                    die;
                    exit;
                }
            }else{
                echo "GAGAL MENGUPLOAD FILE FOTO";
            }        
        }else{
            echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
        }
    }
}

?>