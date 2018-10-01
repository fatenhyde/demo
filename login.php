<?php
include_once 'configuration.php';


?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Databank GST | Log Masuk</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
	<link href="login.css" rel="stylesheet">

</head>

<body class="bg-img">

<div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-6">
                <h2 style="color:#2d388f; font-weight:800;margin-top:0px">Selamat Datang ke Sistem <span> <img src="/databankgst/assets/img/bankGST.png" height="130px"></span></h2>
                <?php 
                    $sql_p = "SELECT * FROM `gst_buletin` 
                                WHERE EndDt > '".date('Y-m-d')."' AND FIND_IN_SET('2',Display)";
                    $rs = mysql_query($sql_p);
                    while ($row = mysql_fetch_array($rs)) {
                ?>
                <p>
                    <?php echo $row['Content'] ?>
                </p>
                <?php } ?>
            </div>
            <div class="col-md-6">
                <div class="ibox-content text-center gray-bg">
                    <form method="post" class="m-t" role="form" action="login_handler.php">
                        <div class="form-group">
                            <input type="text" class="form-control" name="IDPengguna" placeholder="ID Pengguna" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" name="Katalaluan" class="form-control" placeholder="Kata Laluan" required="">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Log Masuk</button>
        
                        <a href="forgot_password.php"><small>Lupa kata laluan?</small></a>
                        <p class="text-muted text-center"><small>Belum mendaftar sebagai pengguna?</small></p>
                        <a class="btn btn-sm btn-white btn-block" href="../onlinereg/oluser.php">Klik di sini untuk mendaftar</a>
                    </form>
                    <p class="m-t"> <small>KPDNKK &copy; 2017</small> </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>