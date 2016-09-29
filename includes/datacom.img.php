<?
require_once("constants.php");
include_once("functions.php");
$msg_mid = $_GET['mid'];		// De variabelen...
$msg_prt = $_GET['mpt'];
$font = "fonts/bit6.ttf";		// Het lettertype
$fontsize = 6;  				// lettergrootte...
$debug = 0;  					// Debugging
$x = 55;  						// Horizontale positie vanaf links
$y = 70;  						// Horizontale positie vanaf rechts
$i = 10;  						// Regelhoogte (Increment of Incline)
$ml = 19;						// Maximaal aantal regels met dit lettertype.
$ll = 52;						// Linelength (regelbreedte in tekens)

if($msg_prt == ""){ $msg_prt = 1; }

$ctt = mysql_fetch_assoc(mysql_query("SELECT * FROM messages WHERE id='".$msg_mid."'"));	// Bericht ophalen
$from = user($ctt['m_from']); 				// Wie is de afzender?
$msg_txt = breakText($ctt['message'],$ll);  // De tekst in hapklare brokken hakken

$parts = ceil(count($msg_txt) / $ml);
if($parts == 1 && $msg_prt == 1){
  $start = 0;
  $maxlines = $ml;
}elseif($parts >= 2 && $msg_prt >= 2){
  if($msg_prt <= $parts){
	if($msg_prt == 1){
	  $start = 0;
	  $maxlines = $ml;
	}else{
	  $start = 0 + (($msg_prt * $ml) - $ml);
	  $maxlines = $ml + (($msg_prt * $ml) - $ml);
	}
  }else{
    $msg_prt = $parts;
	$start = 0 + (($parts * $ml) - $ml);
	$maxlines = $ml + (($parts * $ml) - $ml);
  }    
}else{
  $start = 0;
  $maxlines = $ml;
}

$im = @imagecreatefromjpeg("../images/terminal/DataCom.jpg");
if (!$im || !$msg_mid) {
  $im  = @imagecreate(425,30)or die("Kan de GD Library niet vinden of het basisplaatje ontbreekt."); 
  $bgc = imagecolorallocate($im, 255, 255, 255);
  $tc  = imagecolorallocate($im, 0, 0, 0);
  imagestring($im, 4, 5, 5, "Data of Afbeelding ontbreekt... Probeer het opnieuw.", $tc);
}else{
  $bgc = imagecolorresolve($im, 255, 255, 255);
  $textcolor = imagecolorresolve($im,0,0,0); // Zwart
  imagettftext($im, $fontsize, 0, $x, 50, $textcolor, $font, "[".date("d-m-Y H:i", $ctt['date'])."] - PAGE: ".$msg_prt."/".$parts." - FROM: ".strtoupper($from['login']));
  for($a=$start;$a<$maxlines;$a++){
    imagettftext($im, $fontsize, 0, $x, $y, $textcolor, $font, strtoupper($msg_txt[$a]));
	$y = $y + $i;
  }
}

if($debug == 0){
  header("Content-type: image/png");
  imagepng($im);
  imagedestroy($im);
}else{
  echo '<pre>';
  echo 'Parts: '.$parts.PHP_EOL;
  echo 'Start: '.$start.PHP_EOL;
  echo 'Einde: '.$maxlines.PHP_EOL;
  print_r($ctt).PHP_EOL;
  print_r($msg_txt).PHP_EOL;
  echo '</pre>';
}


?>