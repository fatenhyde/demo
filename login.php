<?php
include_once 'configuration.php';


?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Demo</title>

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
       
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>
