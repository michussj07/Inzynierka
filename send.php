<?php
/**
 * Created by PhpStorm.
 * User: Michał
 * Date: 2018-12-19
 * Time: 18:25
 */

define('SERVER_API_KEY', 'AIzaSyClWHtVdqVQYXR-YIzqnFg60hU2hNSPc3o');

require 'DbConnect.php';
$db = new DbConnect;
$conn = $db->connect();
$stmt = $conn->prepare('SELECT * FROM tokens');
$stmt->execute();
$tokens = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($tokens as $token) {
    $registrationIds[] = $token['token'];
}
//$tokens = ['cJdpWVpGWkg:APA91bHnmDEKNukTjWjwBi4zOIvzNAMI_fu-mnH3Zo8nz_icn_r79QqyQe6rIW0JXFJHIi3_J3Y7AByy49obsIjZvbMAMb9vt8tayCsiYRywVKdPH_sI2o-Cjrr40bbaGQmH-XjgY6MQ'];

$header = [
    'Authorization: Key=' . SERVER_API_KEY,
    'Content-Type: Application/json'
];

$msg = [
    'title' => 'Testing Notification',
    'body' => 'Testing Notification from localhost',
    'icon' => 'img/icon.png',
    'image' => 'img/d.png',
];

$payload = [
    'registration_ids' 	=> $registrationIds,
    'data'				=> $msg
];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode( $payload ),
    CURLOPT_HTTPHEADER => $header
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
?>