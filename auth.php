<?php
session_start();
include_once("includes/functions.php");

if($_POST['username'] && $_POST['password']){
  $un = $_POST['username'];
  $pw = md5($_POST['password']);
  $chk = mysql_query("SELECT * FROM `tw_users` WHERE username='".mysql_real_escape_string($un)."' AND password='".$pw."'");
  if(mysql_num_rows($chk) == 0){
    $_SESSION['tmsg'] = 1;
	$_SESSION['msg'] = "Username and/or password combination not found.";
  }elseif(mysql_num_rows($chk) > 1){
    $_SESSION['tmsg'] = 1;
	$_SESSION['msg'] = "Duplicate Entry in Database; Please contact Taxiwars.";
  }elseif(mysql_num_rows($chk) == 1){
	$fetch = mysql_fetch_assoc($chk);
	if($fetch['status'] == "0"){
	  $_SESSION['tmsg'] = 1;
	  $_SESSION['msg'] = "Account disabled or not verified.";
	}elseif($fetch['status'] == "1"){
	  $_SESSION['USERNAME'] = mysql_real_escape_string($fn).' '.mysql_real_escape_string($ln);
	  $timestamp = time()+86400;
	  setcookie("TWUN", mysql_real_escape_string($un), $timestamp);
	  setcookie("TWID", $fetch['uid'], $timestamp);
	  $_SESSION['TWUN'] = mysql_real_escape_string($un);
	  $_SESSION['TWID'] = $fetch['uid'];
	  log_ip($fetch['uid'],$_SERVER['REMOTE_ADDR']);
	  twlog($uid,$ip,$logtxt);
	  $_SESSION['tmsg'] = 0;
	  mysql_query("update `tw_users` set `ip_last` = '".$_SERVER['REMOTE_ADDR']."', `time_last` = '".time()."' where `uid` = '".$_SESSION['TWID']."'");
	  $_SESSION['msg'] = 'You are now logged in. Welcome to Taxi Wars.';
	  header("Location: /");
	  exit;
	}else{
	  $_SESSION['tmsg'] = 1;
	  $_SESSION['msg'] = "General Error."; 
	}
  }
}

if($_GET['logout']){
  session_destroy();
  $timedestroy = time()-100;
  setcookie("TWUN", "", $timedestroy);
  setcookie("TWID", "", $timedestroy);
  setcookie("TWMSG", "You are now logged out. Thank you for your visit.", time()+5);
  header("Location: /");
}

header("Location: /");
?>