<div class="contenido">
	<div class="pages">
<?php
	if (isset($_GET['page'])) {
		switch($_GET['page']){
			case "home";
				include("module/client/module/home/view/homepage.php");
				break;
			case "contact";
				include("module/client/module/contact/view/contact.php");
				break;
			case "shop";
				include("module/client/module/shop/view/shop.php");
				break;
			case "login";
				include("module/login/login.html");
				break;
			case "register";
				include("module/login/register.html");
				break;
			case "profile";
				include("module/client/module/profile/view/profile.html");
				break;
			case "cart";
				include("module/client/module/cart/view/cart.html");
				break;
			default;
				include("module/admin/view/inc/error/404.php");
				break;
		}
	}else{
		include("module/client/module/home/view/homepage.php");
	}
?>
	</div>
</div>
