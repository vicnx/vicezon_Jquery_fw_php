<?php
	class controller_search {
	    function __construct() {
	        $_SESSION['module'] = "SEARCH";
	    }
		//load_brands
		function load_brands() {
			// echo json_encode("wadawdwd");
			$json = loadModel(CLIENT_MODEL_SEARCH, "search_model", "load_brands");
			echo json_encode($json);
		}
		function autocomplete() {
			$data = array(
				'busqueda' => $_POST['busqueda'],
				'brand_selected' => $_POST['brand_selected']
			);
			// echo json_encode("wadawdwd");
			$json = loadModel(CLIENT_MODEL_SEARCH, "search_model", "autocomplete",$data);
			echo json_encode($json);
		}
	}