<?PHP
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Taxiwars - Development Area</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/taxiwars/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="includes/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="includes/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="includes/startup.js.php"></script>
<?php include_once("includes/message_handler.php"); ?>
</head>

<body>
<div class="wrapper ">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" height="250" rowspan="2"><img src="images/logo.png" alt="Logo" width="250" height="250" style="margin-left:auto; margin-right:auto;" /></td>
    <td style="vertical-align:top;"><div id="main_header">&nbsp;</div></td>
  </tr>
  <tr>
    <td rowspan="2" style="vertical-align:top;"><div id="msg_content">&nbsp;</div><div id="main_content">&nbsp;</div></td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><div id="main_menu">&nbsp;</div></td>
    </tr>
  <tr>
    <td colspan="2"><div id="main_footer">&nbsp;</div></td>
  </tr>
</table>
</div>
</body>
</html>
