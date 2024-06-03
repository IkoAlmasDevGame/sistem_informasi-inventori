<?php 
namespace model;

class Pengguna {
    protected $db;
    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function Table($query){
        $row = $this->db->query($query);
        return $row;
    }

    public function TableUpdate($query,$id){
        $row = $this->db->query($query,$id);
        $row->fetch_array();
        return $row;
    }

    public function create($username,$nama,$telepon,$alamat,$password,$role){
        $username = htmlentities($_POST["username"]) ? htmlspecialchars($_POST["username"]) : $_POST["username"];
        $nama = htmlentities($_POST["nama"]) ? htmlspecialchars($_POST["nama"]) : $_POST["nama"];
        $telepon = htmlentities($_POST["nomor_telepon"]) ? htmlspecialchars($_POST["nomor_telepon"]) : $_POST["nomor_telepon"];
        $alamat = htmlentities($_POST["alamat"]) ? htmlspecialchars($_POST["alamat"]) : $_POST["alamat"];
        $password = md5(htmlspecialchars($_POST['password']), false);
        $role = htmlentities($_POST["role"]) ? htmlspecialchars($_POST["role"]) : $_POST["role"];

        $table = "pengguna";
        $sql = "INSERT INTO $table (username,nama,nomor_telepon,alamat,password,role) VALUES ('$username','$nama','$telepon','$alamat','$password','$role')";
        $row = $this->db->query($sql);
        
        if($row){
            echo "<script>
            alert('Anda berhasil membuat user akun baru ...');
            document.location.href = '../ui/header.php?page=pengguna';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('Anda gagal membuat user akun baru ...');
            document.location.href = '../ui/header.php?page=pengguna';
            </script>";
            die;
            exit;
        }
    }

    public function update($username,$nama,$telepon,$alamat,$password,$role,$id){
        $username = htmlentities($_POST["username"]) ? htmlspecialchars($_POST["username"]) : $_POST["username"];
        $nama = htmlentities($_POST["nama"]) ? htmlspecialchars($_POST["nama"]) : $_POST["nama"];
        $telepon = htmlentities($_POST["nomor_telepon"]) ? htmlspecialchars($_POST["nomor_telepon"]) : $_POST["nomor_telepon"];
        $alamat = htmlentities($_POST["alamat"]) ? htmlspecialchars($_POST["alamat"]) : $_POST["alamat"];
        $password = md5(htmlspecialchars($_POST['password']), false);
        $role = htmlentities($_POST["role"]) ? htmlspecialchars($_POST["role"]) : $_POST["role"];
        $id = htmlentities($_POST["id"]) ? htmlspecialchars($_POST["id"]) : $_POST["id"];

        $table = "pengguna";
        $sql = "UPDATE $table SET username = '$username', nama = '$nama', nomor_telepon = '$telepon', alamat = '$alamat', password = '$password',
         role = '$role' WHERE id = '$id'";
        $row = $this->db->query($sql);

        if($row){
            echo "<script>
            alert('Anda berhasil ubah user akun baru ...');
            document.location.href = '../ui/header.php?page=pengguna';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('Anda gagal ubah user akun baru ...');
            document.location.href = '../ui/header.php?page=pengguna';
            </script>";
            die;
            exit;
        }
    }

    public function delete($id){
        $id = htmlentities($_GET["id"]) ? htmlspecialchars($_GET["id"]) : $_GET["id"];
        $table = "pengguna";
        $sql = "DELETE FROM $table WHERE id = '$id'";
        $row = $this->db->query($sql);

        if($row){
            echo "<script>
            alert('Anda berhasil hapus user akun baru ...');
            document.location.href = '../ui/header.php?page=pengguna';
            </script>";
            die;
            exit;
        }else{
            echo "<script>
            alert('Anda gagal hapus user akun baru ...');
            document.location.href = '../ui/header.php?page=pengguna';
            </script>";
            die;
            exit;
        }
    }

    public function SignIn($userInput, $password){
        $userInput = htmlentities($_POST["userInput"]) ? htmlspecialchars($_POST["userInput"]) : $_POST["userInput"];
        $password = md5(htmlspecialchars($_POST["password"]), false);
        password_verify($password, PASSWORD_DEFAULT);

        if($userInput == "" || $password == ""){
            echo "<script>document.location.href = '../auth/index.php';</script>";
            die;
            exit;
        }

        $table = "pengguna";
        $sql = "SELECT * FROM $table WHERE username = '$userInput' and password = '$password' || nomor_telepon = '$userInput' and password = '$password'";
        $row = $this->db->query($sql);
        $cek = mysqli_num_rows($row);

        if($cek > 0){
            $response = array($userInput, $password);
            $respon[$table] = $response;
            if($tbp = $row->fetch_assoc()){
                if($tbp["role"] == "superadmin"){
                    $_SESSION["id"] = $tbp["id"];
                    $_SESSION["username"] = $tbp["username"];
                    $_SESSION["nomor_telepon"] = $tbp["nomor_telepon"];
                    $_SESSION["nama"] = $tbp["nama"];
                    $_SESSION["role"] = "superadmin";
                    echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                }else if($tbp["role"] == "admin"){
                    $_SESSION["id"] = $tbp["id"];
                    $_SESSION["username"] = $tbp["username"];
                    $_SESSION["nomor_telepon"] = $tbp["nomor_telepon"];
                    $_SESSION["nama"] = $tbp["nama"];
                    $_SESSION["role"] = "admin";
                    echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                }else if($tbp["role"] == "petugas"){
                    $_SESSION["id"] = $tbp["id"];
                    $_SESSION["username"] = $tbp["username"];
                    $_SESSION["nomor_telepon"] = $tbp["nomor_telepon"];
                    $_SESSION["nama"] = $tbp["nama"];
                    $_SESSION["role"] = "petugas";
                    echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                }
                $_SESSION["status"] = true;
                $_SERVER["HTTPS"] == $_SERVER["HTTP"] = true;
                $_COOKIE["cookies"] = $userInput;
                setcookie($respon[$table], $tbp, time() + (86400 * 30), "/");
                array($respon[$table], $tbp);
                exit;
            }
        }else{
            $_SESSION["status"] = false;
            $_SERVER["HTTPS"] == $_SERVER["HTTP"] = false;
            echo "<script>alert('Harap coba lagi ...'); document.location.href = '../auth/index.php'</script>";
            die;
            exit;   
        }
    }
}

?>