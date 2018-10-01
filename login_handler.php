<?php

include_once 'configuration.php';

jimport('premis.premis');
jimport('logs.logs');
pimport("kui.class.util");
$ojUtil = new jutil();

$salt = '$2a$07$99b8rN2N33rnn396h9ive$';

$oPremis = new premis();
$oLogs = new logs();

$IDPenggunalog = $_POST["IDPengguna"];
$Katalaluanlog = $_POST["Katalaluan"];

$IDPengguna = mysql_real_escape_string($_POST["IDPengguna"]);
$Katalaluan = mysql_real_escape_string(($_POST["Katalaluan"]));

//$sql = "SELECT * FROM gst_pengguna WHERE IDPengguna = '$IDPengguna' AND KataLaluan = md5('$Katalaluan') AND StatusPengguna='2'";
$sql = "SELECT * FROM gst_pengguna WHERE IDPengguna = '$IDPengguna' AND StatusPengguna='2'";
//echo $sql;
$rs = mysql_query($sql);
$flag = "N";

        while ($row = mysql_fetch_array($rs)) {
            $login_count = (int) $row['login_count'];
            $decrypt = md5($Katalaluanlog);
            if ($login_count < 3) {

                if ($row['KataLaluan'] == crypt($Katalaluan, $salt)) {
                    if (strlen($Katalaluan) < 8) {
                        $err_msg .= "Katalaluan mesti sekurang-kurangnya 8 aksara";
                    }

                    if (!preg_match("#[0-9]+#", $Katalaluan)) {
                        $err_msg .= "Katalaluan mesti mengandungi sekurang-kurangnya satu nombor";
                    }

                    if (!preg_match("#[a-zA-Z]+#", $Katalaluan)) {
                        $err_msg .= "Katalaluan mesti mengandungi sekurang-kurangnya satu huruf";
                    }

                    if (!preg_match("#[\!\"\;\%\:\?\*\(\)\<\>\/\#\$\^\&\@\-\+\_\=\|\,\.\~\{\}\[\]\'\\\\]+#", $Katalaluan)) {
                        $err_msg .= "Katalaluan mesti mengandungi sekurang-kurangnya satu simbol";
                    }

                    if ($row['first_time'] == 'Y') {
                        $err_msg .= " ";
                    }

                    if ($err_msg) {
                        $ojUtil->alert($err_msg . ". Sila tukar kata laluan anda");
                        $_GET['IDPengguna'] = $IDPengguna;
                        $_GET['RecordID'] = $row['RekodID'];

                        include("profile.php");
                        exit;
                    }
                    if ($login_count != 3) {
                        $sqlupdate = "UPDATE gst_pengguna SET login_count = 0 WHERE IDPengguna = '$IDPengguna'";
                        mysql_query($sqlupdate);
                        if ($row['StatusPengguna'] == '2') {
                            $flag = "Y";
                        } else if ($row['StatusPengguna'] == '1') {
                            $flag = 'B';
                        } else if ($row['StatusPengguna'] == '4') {
                            $flag = 'TT';
                        } else if ($row['StatusPengguna'] == '5') {
                            $flag = 'NA';
                        }
                    } else {
                        $flag = 'IDB';
                    }
                } else {
                    $flag = 'WP';
                }
            } else {
                $flag = "N";
            }
            $_SESSION["IDPengguna"] = $row["IDPengguna"];
            $_SESSION["KodPeranan"] = $row["KodPeranan"];
            $_SESSION["Nama"] = $row["NamaPengguna"];
            $_SESSION["RecordID"] = $row["RekodID"];
            $_SESSION['Tkh'] = $row['TarikhKuatkuasa_Hingga'];
            if ($row['KodPeranan'] == '08') { // hyper market
                $KodGroup = $oPremis->getPremis($row['KodPremis'], 'KodGroup');

                if ($KodGroup == '')
                    $_SESSION['hq'] = 'Y';
                else
                    $_SESSION['hq'] = 'N';
            } else
                $_SESSION['hq'] = 'N';
        }

        if ($flag == "Y") {

            if (date('Y-m-d') >= $_SESSION['Tkh']) {
                pimport("kui.class.util");
                $ojUtil = new jutil();
                $ojUtil->alert("Kata Laluan anda telah tamat tempoh. Sila kemaskini kata laluan yang baru.");
                $_GET['IDPengguna'] = $_SESSION['IDPengguna'];
                $_GET['RecordID'] = $_SESSION["RecordID"];

                session_destroy();
                include("profile.php");
            } else {
                $tarikh = date('d-M-Y H:i:s');
                $ip = $oLogs->getipadd();
                $name = $_SESSION["Nama"];
                $login_id = $_SESSION['IDPengguna'];
                $details = "IdPengguna $login_id($name) Tarikh $tarikh IPadd $ip";
                $data = array(
                    'IDPengguna' => $_SESSION['IDPengguna'],
                    'JenisLog' => 'LOGIN',
                    'Keterangan' => $details);
                $oLog->set($data);
                header("location:index.php");
            }
        } else if ($flag == "B") {
            $tarikh = date('d-M-Y H:i:s');
            $ip = $oLogs->getipadd();
            $login_id = $IDPenggunalog;
            $pswd = $Katalaluanlog;
            $details = "Id Pengguna($login_id),Passwd($pswd) pada $tarikh IPadd $ip Belum diaktifkan";
            $data = array(
                'IDPengguna' => $login_id,
                'JenisLog' => 'FAILOGIN',
                'Keterangan' => $details);
            $oLog->set($data);
            session_destroy();
            include("login.php");
            pimport("kui.class.util");
            $ojUtil = new jutil();
            $ojUtil->alert("ID Pengguna " . $login_id . " belum diaktifkan!");
        } else if ($flag == "TT") {

            $tarikh = date('d-M-Y H:i:s');
            $ip = $oLogs->getipadd();
            $login_id = $IDPenggunalog;
            $pswd = $Katalaluanlog;
            $details = "Id Pengguna($login_id),Passwd($pswd) pada $tarikh IPadd $ip Sudah Tamat Tempoh";
            $data = array(
                'IDPengguna' => $login_id,
                'JenisLog' => 'FAILOGIN',
                'Keterangan' => $details);
            $oLog->set($data);
            session_destroy();
            include("login.php");
            pimport("kui.class.util");
            $ojUtil = new jutil();
            $ojUtil->alert("ID Pengguna " . $login_id . " tamat tempoh!");
        } else if ($flag == "NA") {
            $tarikh = date('d-M-Y H:i:s');
            $ip = $oLogs->getipadd();
            $login_id = $IDPenggunalog;
            $pswd = $Katalaluanlog;
            $details = "Id Pengguna($login_id),Passwd($pswd) pada $tarikh IPadd $ip tidak aktif";
            $data = array(
                'IDPengguna' => $login_id,
                'JenisLog' => 'FAILOGIN',
                'Keterangan' => $details);
            $oLog->set($data);
            session_destroy();
            include("login.php");
            pimport("kui.class.util");
            $ojUtil = new jutil();
            $ojUtil->alert("ID Pengguna " . $login_id . " tidak aktif!");
        } else if ($flag == "WP") {
            $tarikh = date('d-M-Y H:i:s');
            $ip = $oLogs->getipadd();
            $pswd = $Katalaluanlog;
            $details = "Id Pengguna($login_id),Passwd($pswd) pada $tarikh IPadd $ip";
            $data = array(
                'IDPengguna' => $login_id,
                'JenisLog' => 'FAILOGIN',
                'Keterangan' => $details);
            $oLog->set($data);
            session_destroy();
            include("login.php");
            $login_id = $IDPenggunalog;
            $count_log = (int) 3 - $login_count;
            $ojUtil->alert("Kata Laluan salah! Anda hanya ada $count_log kali percubaan sahaja sebelum ID Pengguna disekat!");
            $login_count = $login_count + 1;
            $sqllogin = "UPDATE gst_pengguna SET login_count = $login_count WHERE IDPengguna = '$login_id'";
            mysql_query($sqllogin);
        } else if ($flag == "IDB") {
            $login_id = $IDPenggunalog;
            $tarikh = date('d-M-Y H:i:s');
            $ip = $oLogs->getipadd();
            $pswd = $Katalaluanlog;
            $details = "Id Pengguna($login_id),Passwd($pswd) pada $tarikh IPadd $ip";
            $data = array(
                'IDPengguna' => $login_id,
                'JenisLog' => 'FAILOGIN',
                'Keterangan' => $details);
            $oLog->set($data);
            session_destroy();
            include("login.php");
            $ojUtil->alert("ID Pengguna telah disekat kerana telah melebihi 3 kali percubaan\\n\\Sila hubungi Bahagian Pengurusan Maklumat (BPM) untuk bantuan!");
        } else {
            $tarikh = date('d-M-Y H:i:s');
            $ip = $oLogs->getipadd();
            $login_id = $IDPenggunalog;
            $pswd = $Katalaluanlog;
            $details = "Id Pengguna($login_id),Passwd($pswd) pada $tarikh IPadd $ip";
            $data = array(
                'IDPengguna' => $login_id,
                'JenisLog' => 'FAILOGIN',
                'Keterangan' => $details);
            $oLog->set($data);
            session_destroy();
            include("login.php");
            //$ojUtil->alert("Wrong ID and Password Combination !");
            $ojUtil->alert("Kombinasi Id Pengguna dan Kata Laluan adalah salah!");
        }
?>
