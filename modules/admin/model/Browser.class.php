<?php
	/*
	Ejemplos de uso:
		Browser::redirect($this->facebook->getLoginUrl($params));
		$callback = $_SESSION["fb_callback"].'?user_id='.$userId.'&app=facebook&error=true&code='.$code.'&message='.$message;
		Browser::redirect($callback);
	*/
	class Browser {
		/**
		* propietaris: David Rios, Jordi Terol
		* Redirecciona el navegador a la url indicada.
		* @param type $url Es la url a la que se desea redirigir.
		*/
		public static function redirect($url){
			die('<script>top.location.href="'.$url .'";</script>');
		}
	}
?>