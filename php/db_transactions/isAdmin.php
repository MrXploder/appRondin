<?php
// Headers HTML para prevenir que el navegador guarde en caché el contenido de la pagina
Header('Content-type: text/javascript');
Header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
Header("Cache-Control: post-check=0, pre-check=0", false);
Header("Pragma: no-cache");
// Notificar solamente errores de ejecución
error_reporting(E_ERROR);

require $_SERVER['DOCUMENT_ROOT'].'/php/dependencies/meekrodb.class.php';
//DB::debugMode();

$admin_token 	 = $_GET["admin_token"];
$access_level	 = $_GET["access_level"];

if(!empty($admin_token)){
	try{
		//Buscamos el token entre la lista de operadores
		$operatorPersonalData = DB::queryFirstRow("SELECT * FROM `operadores` WHERE `admin_token` = %s", $admin_token);
		//Si la operacion devuelve mayor a 0 significa que encontro el token
		if(DB::count() > 0){
			$payLoad["status"] 			 = "found";
			$payLoad["nom_operador"] = $operatorPersonalData["nom_operador"];
			$payLoad["access_level"] = $operatorPersonalData["access_level"];
			$payLoad["logs"]         = DB::query("SELECT `logs`.*, `tags`.`name` FROM `logs` LEFT JOIN `tags` ON `logs`.`uidreadedtag` = `tags`.`uid` ORDER BY `logs`.`id_log` DESC");
			$payLoad["tags"]         = DB::query("SELECT * FROM `tags` ORDER BY `id_tags` DESC");
			
			echo json_encode($payLoad, JSON_UNESCAPED_UNICODE);
			exit();
		}
		else{
			echo '{"status":"lost"}';
			exit();
		}
	}
	//Si falla, lanzamos un error.
	catch(MeekroDBException $e) {
		echo '{"status":"mysqlError","code":"'.$e->getMessage().'"}';
		exit();
	}
}
else{
	echo '{"status":"lost"}';
	exit();
}
?>