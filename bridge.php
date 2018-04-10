<?php 
require $_SERVER['DOCUMENT_ROOT'].'/php/dependencies/meekrodb.class.php';

if($_GET["uidreadedtag"] && $_GET["timestamp"]){
	try{
		DB::insert('approndin_logs', array(
			'uidreadedtag' => $_GET["uidreadedtag"],
			'timestamp'    => $_GET["timestamp"]
		));
		echo "Insertado con Exito";
	}
	catch(MeekroDBException $e) {
		echo '{"status":"mysqlError","code":"'.$e->getMessage().'"}';
		exit();
	}
}
else{
	echo "missing request";
}
?>