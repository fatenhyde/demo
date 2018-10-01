<?php 
if (isset($_SESSION["theme"]))
    $template = $_SESSION["theme"];
else
    $template = "gst";

/* general reference */

/* relative reference */
define('RTEMPLATE', RHOME."/templates/".$template);

/* for absolute path reference */
define('IHEADER', HOME.DS."templates".DS.$template.DS."header.php");
define('IFOOTER', HOME.DS."templates".DS.$template.DS."footer.php");


$db = mysql_connect("192.168.0.28", "root", "[0$7@mDB!]") or die("Connection problem ...");
//$db = mysql_connect("10.23.155.222", "prima", "[prima@kpdnkk]") or die("Connection problem...");
//$db = mysql_connect("10.23.155.173", "bankgst", "[datagst@kpdnkk]") or die("Connection problem...");
mysql_select_db("databank_gst", $db);
mysql_set_charset("UTF8");
/* specific object for this app */
//jimport("user.user"); $oUser = new user();

//jimport("user.priv"); $oPriv = new priv();
?>
