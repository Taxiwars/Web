<?php if($_COOKIE['TWUN'] && $_COOKIE['TWID']){ ?>
$(function(){
	$("#main_header").load('templates/header.php');
	$("#main_content").load('templates/homepage.php');
	$("#main_menu").load('templates/menu.php');
	$("#main_footer").load('templates/footer.php');
});
<?php }else{ ?>
$(function(){
	$("#main_header").load('templates/header.php');
	$("#main_content").load('templates/homepage.php');
	$("#main_menu").load('templates/menu.php');
	$("#main_footer").load('templates/footer.php');
});
<?php } ?>