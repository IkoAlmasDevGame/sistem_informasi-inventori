<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            require_once("../../database/koneksi.php");
            $row = $config->query("SELECT * FROM sistem WHERE flags = '1'");
            $hasil = mysqli_fetch_array($row);
        ?>
        <title><?php echo $hasil['nama_website'] ?></title>
        <link rel="shortcut icon" href="../../../assets/logo/<?=$hasil['icon']?>" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <style type="text/css">
        * {
            box-sizing: border-box;
            font-family: "Times New Roman";
            font-style: normal;
        }

        .card-title {
            font-size: 16px;
            font-weight: normal;
            text-align: center;
        }

        .card-title2 {
            font-size: 32px;
            font-weight: normal;
            text-align: center;
        }

        body {
            background-color: gray;
            background-blend-mode: darken;
        }

        .card {
            width: 360px;
        }

        .card-body {
            height: 360px;
        }

        @media (max-height: 500px) {
            .card-body {
                max-height: 500px;
            }
        }

        @media (max-width: 720px) {
            .card {
                max-width: 720px;
            }
        }
        </style>
    </head>

    <body onload="startTime()">
        <div class="layout">
            <div class="d-grid justify-content-center align-items-center flex-wrap p-3 m-3">
                <div class="container-fluid bg-body-secondary p-5 m-5 mx-auto rounded-1">
                    <div class="card">
                        <div class="d-flex justify-content-center align-items-center flex-wrap gap-1">
                            <div class="card-body">
                                <h4 class="card-title2">Login</h4>
                                <div class="border border-top mb-2"></div>
                                <h4 class="card-title display-4">
                                    - <?php echo $hasil['nama_website'] ?> -
                                </h4>
                                <?php 
                                    require_once("../../controller/controller.php");
                                    require_once("../../model/model_pengguna.php");
                                    $login = new controller\Authentication($config);

                                    if(!isset($_GET["aksi"])){
                                        require_once("../../controller/controller.php");
                                    }else{
                                        switch ($_GET["aksi"]) {
                                            case 'signin':
                                                $login->Login();
                                                break;
                                            
                                            default:
                                            require_once("../../controller/controller.php");
                                                break;
                                        }
                                    }
                                ?>
                                <div class="form-group">
                                    <form action="?aksi=signin" method="post">
                                        <table class="table table-striped-columns">
                                            <tr>
                                                <td>
                                                    <label for="usertelepon">username / telepon :</label>
                                                    <input type="text" name="userInput" id="usertelepon"
                                                        class="form-control" required aria-required="true"
                                                        placeholder="masukkan username atau telepon anda ...">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="password">password :</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control" required aria-required="true"
                                                        placeholder="masukkan password anda ...">
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-primary 
                                                col-sm-12 col-md-12 hover">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <footer class="footer">
                                <p id="year" class="text-center"></p>
                                <div class="text-center">By <?php echo $hasil['nama_pembuatan'] ?></div>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
        </script>
        <script type="text/javascript">
        function startTime() {
            var day = ["minggu", "senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];
            var today = new Date();
            var h = today.getHours();
            var tahun = today.getFullYear();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('year').innerHTML =
                "&copy Sistem Informasi Inventori " + tahun + "<br>" + day[today.getDay()] + ", " + h + " : " + m +
                " : " + s;
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
        </script>
    </body>

</html>