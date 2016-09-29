<link href="../css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	$(function(){
		$("#form_login_form").submit(function(){
			if($("#username").val() != ""  && $("#password").val() != ""){
				return true;
			}
			$("#login_form_error").hide().text("Login incorrect!").fadeIn(1000).delay(2000).fadeout(1000);
			return false;
		});
	});
</script>
<div id="login_form">
<form action="auth.php" method="post" name="form_login_form" id="form_login_form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><div id="login_form_error"><strong>LET OP:</strong> Op dit moment hebben alleen ontwikkelaars toegang tot het systeem.</div></td>
    </tr>
  <tr>
    <td width="35%" align="left" valign="middle">Gebruikersnaam</td>
    <td width="65%"><input name="username" type="text" id="username" size="50"></td>
  </tr>
  <tr>
    <td align="left" valign="middle">Wachtwoord</td>
    <td><input name="password" type="password" id="password" size="50"></td>
  </tr>
  <tr>
    <td colspan="2"><input name="register" type="button" value="Registreer" style="width:100px; height:30px;" /><input type="submit" name="submit" id="form_login_submit" value="Submit" style="float:right"></td>
    </tr>
</table>
</form>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
