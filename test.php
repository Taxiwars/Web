<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test</title>
</head>

<body>
<?php
include_once('includes/functions.php');
for($i=0;$i <= 25;$i++){
	echo generate_name().'<br/>';
}
?>
</body>
</html>