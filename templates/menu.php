<link href="../css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	$(function(){
		$("#main_menu_link_home").click(function() {
			$("#main_content").load('./templates/homepage.php');
			$("#main_menu").load('templates/menu.php');
		});
		$("#main_menu_link_login").click(function() {
			$("#main_content").load('./templates/login.php');
		});
		$("#main_menu_link_acct").click(function() {
			$("#main_content").load('./templates/account.php');
		});
	});
</script>
<?php if($_COOKIE['TWUN'] && $_COOKIE['TWID']){ ?>
<div id="message_center">
    <ul>
        <li><span id="message_center_new">0</span> nieuwe bericht(en).</li>
        <li><span id="message_center_old">0</span> reeds gelezen bericht(en).</li>
    </ul>
</div>
<?php } ?>
<div id="main_menu_content">
    <ul id="main_menu_list">
        <li><a href="#" id="main_menu_link_home">Home</a></li>
        <?php if($_COOKIE['TWUN'] && $_COOKIE['TWID']){ ?>
        <li><a href="#" id="main_menu_link_acct">Account</a></li>
        <li><a href="#" id="main_menu_link_hq">Hoofdkantoor</a></li>
        <li><a href="#" id="main_menu_link_stad">Stadskantoor</a></li>
        <li><a href="#" id="main_menu_link_bank">Bank</a></li>
        <li><a href="#" id="main_menu_link_miss">Missies</a></li>
        <li><a href="#" id="main_menu_link_cars">Autodealer</a></li>
        <li><a href="#" id="main_menu_link_dock">Dock</a></li>
        <li><a href="#" id="main_menu_link_airp">Luchthaven</a></li>
        <li><a href="#" id="main_menu_link_hosp">Ziekenhuis</a></li>
        <li><a href="#" id="main_menu_link_mark">Zwarte markt</a></li>
        <li><a href="auth.php?logout=true">logout</a></li>
        <?php } ?>
        <?php if(!$_COOKIE['TWUN'] && !$_COOKIE['TWID']){ ?>
        <li><a href="#" id="main_menu_link_login">Login</a></li>
        <?php } ?>
    </ul>
</div>