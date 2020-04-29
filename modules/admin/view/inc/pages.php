<div class="contenido">
	<div class="pages">
<?php
	if (isset($_GET['page'])) {
		switch($_GET['page']){
			case "dashboard";
				include("modules/admin/module/dashboard/dashboard.php");
				break;
			case "controller_tablets";
				include("modules/admin/module/tablets/controller/".$_GET['page'].".php");
				// unset($_SESSION['mensaje']);
				break;
			case "aboutus";
				include("modules/admin/module/aboutus/".$_GET['page'].".php");
				break;
			case "contactus";
				include("modules/admin/module/".$_GET['page'].".php");
				break;
			case "result_tablet1";
				include("modules/admin/module/tablets/view/".$_GET['page'].".php");
				break;
			case "tablets";
				include("modules/admin/module/tablets/view/".$_GET['page'].".php");
				break;
			case "404";
				include("modules/admin/view/inc/error".$_GET['page'].".php");
				break;
			case "503";
				include("modules/admin/view/inc/error".$_GET['page'].".php");
				break;
			default;
				include("modules/admin/view/inc/error/404.php");
				break;
		}
	}else{
		include("modules/admin/module/dashboard/dashboard.php");
	}
?>
	</div>
</div>