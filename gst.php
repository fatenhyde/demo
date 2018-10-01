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


$db = mysql_connect("localhost", "root", "") or die("Connection problem ...");
mysql_select_db("demo", $db);
mysql_set_charset("UTF8");

?>
