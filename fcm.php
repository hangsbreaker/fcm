<?php
function fcm_send($title,$text,$token,$msgdata=""){
  // get from firebase > project setting > Cloud Messaging
  $API_ACCESS_KEY = 'API_KEY_FCM';

	$data = array(
		"msgdata" => $msgdata
	);
  // prep the bundle
  $msg = array(
    'title' => $title,
    'body' => $text,
    'sound' => "default"
  );
  $fields = array(
    'to' => $token,
    'notification' => $msg,
    'data' => $data
  );


  $headers = array(
    'Authorization: key='.$API_ACCESS_KEY,
    'Content-Type: application/json'
  );

  #Send Reponse To FireBase Server
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode( $fields ));
  $result = curl_exec($ch);
  curl_close($ch);
  //echo $result;
}
?>
