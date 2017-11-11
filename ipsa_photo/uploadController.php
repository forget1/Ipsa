<?php  
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/plain; charset=utf-8');

require_once './include.php';

if ($_POST['action'] == 'insert') {
	$arr = array();
	$rand = rand(100, 999);
	$timestamp  = date('YmdHis').$rand;
	$file_str = ROOT.'/upload/'.$timestamp;

	$arr['stamp'] = $timestamp;
	$arr['name'] = $_POST['name'];
	for ($i = 1; $i < 4; $i++) {
		$img = $_FILES['img_'.$i];
		$tmp_name = $img['tmp_name'];

		if ($img['size'] > 5242880) return false;	// maximun 2M
		// $test = array();
		// $test["test"] = move_uploaded_file($tmp_name, $file_str.'_'.$i.'.jpg');
		move_uploaded_file($tmp_name, $file_str.'_'.$i.'.jpg');
		// echo json_encode($test);
	}

	$id = insert("user", $arr);
	$arr['id'] = $id;
	// echo json_encode($arr);
	echo json_encode($test);

}
?>