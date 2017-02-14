<?php
//mqtt connect
require("1phpMQTT.php");
// $username = "foivjeaj";
// $password = "z2gdaN6eeDbV";
$address = "m10.cloudmqtt.com";
$port = "30471";
//echo $address , $port     ;
//MQTT client id to use for the device. "" will generate a client id automatically
  $mqtt = new phpMQTT($host, $port, "ClientID".rand()); 
//	echo $mqtt ;
  if ($mqtt->connect(true,NULL,$username,$password)) {
    $mqtt->publish("Light1","OK", 0);
    $mqtt->close();
	echo "Connect to Mqtt Server ";
  }else{
    	echo "Fail or time out<br />";
  }

$access_token = 'hGBwB4/wbhe19IJlnatFrJ9ERhUDRvFBXOyWsA7KRkCTSEFViXBmDRGaQokKR03XDCQnH9fYHNDdAq4fGfWMeQ3zpUSDGEWWYthfIBTna1ZLDnEIXtnFZ5dOv6fW39zRfAOopxgITDlPjms7RA2vxQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
//		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
//			// Get text sent
//			$text = $event['message']['text'];
//			// Get replyToken
//			$replyToken = $event['replyToken'];
//			// Build message to reply back
//			$messages = [
//				'type' => 'text',
//				'text' => $text
//			];
		if ($event['type'] == 'message' && $event['message']['type'] == 'text' && $event['message']['text'] == 'ทดสอบ') {
			$replyToken = $event['replyToken'];
			$messages = [
				'type' => 'text',
				'text' => 'ทำการทดสอบผ่าน'
				
			];
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
		else  {
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
	}
}

echo "OK";
