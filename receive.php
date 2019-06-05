<?php
$resopnse = array();
date_default_timezone_set('Asia/Kolkata');

if(isset($_GET['bpm']) and isset($_GET['tempf'])) {

		$data = "" . round(microtime(true) * 1000) . "," . $_GET['bpm'] . "," . $_GET['tempf'] . "\n";
		$myfile =  fopen('data.csv', 'a');
		fwrite($myfile,$data);

		$response['error']=false;
		$response['message']='Data Updated!';

} else {
	$response['error']=true;
	$response['message']='Parameters missing!';
}


echo json_encode($response);
?>
