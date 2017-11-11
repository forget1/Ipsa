<?php  
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/plain; charset=utf-8');

require_once './include.php';

if (isset($_GET['flag'])) {
	$flag = $_GET['flag'];
	if ($flag == 0) {
		$tmp = select("user", 1);
		echo json_encode($tmp);

	} elseif ($flag == 1) {
		$tmp = selectMax("user");
		echo json_encode($tmp);

	}
		
}

?>