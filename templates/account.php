<?php
session_start();
include_once('../includes/functions.php');
$query = mysql_query("SELECT * FROM tw_users WHERE uid='".$_SESSION['TWID']."'");
echo mysql_error();
$info = mysql_fetch_assoc($query);
?>
<pre>
<?php print_r($info); ?>
</pre>