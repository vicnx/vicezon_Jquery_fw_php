<?php
	include("module/tablets/model/functions.inc.php");

	$tablet = $_SESSION['tablet'];
	debugear($tablet);
?>
<br>
<input class="btn btn-primary" name="Submit" type="button" value="Volver" onclick="window.location='index.php?page=controller_tablets'"/>

