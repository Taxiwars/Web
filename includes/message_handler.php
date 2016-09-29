<?php
if($_SESSION['msg'] && $_SESSION['tmsg'] == 1)
{
?>
<script type="text/javascript">
$(function(){
	$("#msg_content").prepend("<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>ERROR: </strong><?php echo $_SESSION['msg']; ?></p></div>").delay(5000).fadeOut(1000);
})
</script>
<?php
	unset($_SESSION['msg']);
	unset($_SESSION['tmsg']);
}
elseif($_SESSION['msg'] && $_SESSION['tmsg'] <> 1)
{
?>
<script type="text/javascript">
$(function(){
	$("#msg_content").prepend("<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'><p><span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span><strong>Notice: </strong><?php echo $_SESSION['msg']; ?></p></div>").delay(5000).fadeOut(1000);
})
</script>
<?php
	unset($_SESSION['msg']);
	unset($_SESSION['tmsg']);
}

if(isset($_COOKIE['TWMSG'])){
?>
<script type="text/javascript">
$(function(){
	$("#msg_content").prepend("<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'><p><span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span><strong>Notice: </strong><?php echo $_COOKIE['TWMSG']; ?></p></div>").delay(5000).fadeOut(1000);
})
</script>
<?php
}
?>
