<?php

include_once('constants.php');

function pakkans($kans=1,$op=100)
{
	if($op > 1000){ $top = 1000; }else{ $xop = $op; }
	if($kans > 1000){ $xkans = 1000; }else{ $xkans = $kans; }
	if($kans > $op){ $xkans = $op; }else{ $kans = $kans; }
	$riskarray = array();
	while(count($riskarray) <= ($xkans-1))
	{
		$risk = rand(1,$xop);
		if(!in_array($risk,$riskarray)){ $riskarray[] = $risk; }
	}
	$slagen = rand(1,$xop);
	if(in_array($slagen,$riskarray) == true)
	{
		return true; //mislukt (gepakt)
	}else{
		return false; //gelukt (weggekomen)
	}
}

function generate_name(){
	$fname = mysql_query("SELECT * FROM tw_vnamen WHERE 1");
	$lname = mysql_query("SELECT * FROM tw_anamen WHERE 1");
	$rnd_fname = rand(0,mysql_num_rows($fname)-1);
	$rnd_lname = rand(0,mysql_num_rows($lname)-1);
	while($row=mysql_fetch_row($fname)){ $fn[] = $row; }
	while($row=mysql_fetch_row($lname)){ $ln[] = $row; }
	$fullname = $fn[$rnd_fname][0]." ".$ln[$rnd_lname][0];
	return $fullname;
}

function log_ip($uid=0,$ip='0.0.0.0')
{
	mysql_query("INSERT INTO tw_ip (uid,ip,time) VALUES ('".$uid."','".$ip."','".time()."');");
}

function twlog($uid=0,$ip='0.0.0.0',$logtxt)
{
	mysql_query("INSERT INTO tw_ip (uid,ip,log,time) VALUES ('".$uid."','".$ip."','".mysql_real_escape_string($logtxt)."','".time()."');");
}

function generate_key($num=30,$cr="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789")
{
	$output = "";
	$sl = strlen($cr);
	for($ct=0;$ct<=$num;$ct++)
	{
		$tp = rand(0,$sl);
		$output .= $cr[$tp];
	}
	return $output;	
}

function yesno($val){
	if($val == '1'){ return "Yes"; }
	if($val == '0'){ return "No"; }
}

function registration_email($newuser)
{
	global $headers;
	
	$result = true;
	
	$new = mysql_fetch_assoc(mysql_query("SELECT * FROM tw_users WHERE id='".$newuser."'"));
	
	$subject = "[Taxiwars] Nieuwe Registratie.";
	
	$u_message  = "Beste ".$new['username'].",".PHP_EOL.PHP_EOL;
	$u_message .= "Namens Taxiwars heet ik je van harte welkom bij dit uitdagende spel!".PHP_EOL.PHP_EOL;
	$u_message .= "Om je account te kunnen valideren (en activeren), dien je op de link te klikken die hieronder staat. Mocht dit niet werken, kopieer de URL dan handmatig in de adresbalk van je browser, of voer de code handmatig in.".PHP_EOL.PHP_EOL;
	$u_message .= "LINK: http://www.taxiwars.nl/validate.php?act=validate&email=".$new['email']."&key=".$new['actkey'].PHP_EOL.PHP_EOL;
	$u_message .= "Alternatieve URL: http://www.taxiwars.nl/validate.php".PHP_EOL;
	$u_message .= "Validatie Code: ".$new['actkey'].PHP_EOL.PHP_EOL;
	$u_message .= "LET OP: Taxiwars Moderators en/of Admins moeten uw aanmelding ook nog goedkeuren, dit zal zo snel mogelijk gebeuren (maximaal 96 uur). Deze stap is om te voorkomen dat we valsspelers en/of spammers binnen krijgen. We hopen op begrip voor deze extra (noodzakelijke) stap.".PHP_EOL.PHP_EOL;
	$u_message .= "Met vriendelijke Groet,".PHP_EOL.PHP_EOL.PHP_EOL;
	$u_message .= "De TaxiWars Spelleiding.";
	
	$v_message  = "Hoi!".PHP_EOL.PHP_EOL;
	$v_message .= "Een nieuwe gebruiker heeft zich aangemeld voor TaxiWars!".PHP_EOL.PHP_EOL;
	$v_message .= "Gegevens:".PHP_EOL;
	$v_message .= "=============================================".PHP_EOL;
	$v_message .= "Naam      : ".$new['username'].PHP_EOL;
	$v_message .= "User ID   : ".$new['uid'].PHP_EOL;
	$v_message .= "Bedrijf   : ".$new['coname'].PHP_EOL;
	$v_message .= "Email     : ".$new['email'].PHP_EOL;
	$v_message .= "IP Adres  : ".$new['ip_last'].PHP_EOL;
	$v_message .= "Hq stad   : ".$new['hqcity'].PHP_EOL;
	$v_message .= "=============================================".PHP_EOL.PHP_EOL;
	$v_message .= "Je wordt vriendelijk verzocht deze gebruiker goed- of af te keuren middels volgende link:".PHP_EOL.PHP_EOL;
	$v_message .= "Link: http://www.taxiwars.nl/validate.php?act=approve&id=".$new['uid']."&key=".$new['actkey'].PHP_EOL.PHP_EOL;
	$v_message .= "Met vriendelijke Groet,".PHP_EOL.PHP_EOL.PHP_EOL;
	$v_message .= "De TaxiWars Spelleiding.";
	
	$umsend = @mail($new['email'],$subject,$u_message,$headers);
	if($umsend == false){ $result = false; }
	$vmsend = @mail($vaceo['email'],$subject,$v_message,$headers);
	if($vmsend == false){ $result = false; }
	
	return $result;
}

function validate_new_email($user)
{
	global $headers;
	
	$result = true;
	
	$new = mysql_fetch_assoc(mysql_query("SELECT * FROM tw_users WHERE id='".$user."'"));
	
	$subject = "[Taxiwars] E-mail (her)validatie.";
	
	$u_message  = "Beste ".$new['username'].",".PHP_EOL.PHP_EOL;
	$u_message .= "Om jouw account en e-mail te hervalideren, dien je op de onderstaande link te klikken. Mocht dit niet werken, kopieer de URL dan handmatig in de adresbalk van je browser, of voer de code handmatig in..".PHP_EOL.PHP_EOL;
	$u_message .= "LINK: http://taxiwars.nl/user_validate.php?act=validate&email=".$new['email']."&key=".$new['actkey'].PHP_EOL.PHP_EOL;
	$u_message .= "Alternatieve URL: http://taxiwars.nl/user_validate.php".PHP_EOL;
	$u_message .= "Validatie Code: ".$new['actkey'].PHP_EOL.PHP_EOL;
	$u_message .= "Met vriendelijke Groet,".PHP_EOL.PHP_EOL.PHP_EOL;
	$u_message .= "De TaxiWars Spelleiding.";
	
	$umsend = @mail($new['email'],$subject,$u_message,$headers);
	if($umsend == false){ $result = false; }
	
	return $result;

}

function sendPB($from,$to,$subject,$content)
{
	return;
}

function breakText($text,$lengte=20){  	// tekst opdelen in hapklare brokken.
  if(strlen($text) < $lengte){
    return array($text);
  }
  $a = wordwrap($text, $lengte);
  $a = explode("\n", $a);
  return $a;
}

?>