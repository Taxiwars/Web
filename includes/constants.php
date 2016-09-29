<?

$datahost = "localhost";
$username = "taxiwars_admin";
$password = "T4x1W4rs";
$database = "taxiwars_main";

$conn = mysql_connect($datahost,$username,$password);
mysql_select_db($database,$conn);

$headers  = "From: Taxiwars <noreply@taxiwars.nl>".PHP_EOL;
$headers .= "Reply-To: VAdmin <noreply@taxiwars.nl>".PHP_EOL;
$headers .= "BCC: bjornthv@gmail.com".PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8".PHP_EOL;

$adminmail = "Bjorn V <bjorn@taxiwars.nl>";

?>