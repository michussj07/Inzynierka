<?php

define('SERVER_API_KEY', 'AIzaSyAVTw2lpMU2-efb6NehBJQHHmJGKxdTrGI');

require 'DbConnect.php';
$db = new DbConnect;
$conn = $db->connect();
$stmt = $conn->prepare('SELECT * FROM tokens');
$stmt->execute();
$tokens = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($tokens as $token) {
    $registrationIds[] = $token['token'];
}


//$tokens = ['fb10jIMuoN8:APA91bHArJJpi0PmVj67KD-7oIIC9BMiT5WNa-cJXRq033oEavUfVowBetLxP6TO6eNUVq-iA2IIONaUxwdejLHv9AMVDawZzMY1WP00cDLkEfgN5YgdcHNmHvXrMU_UW8G8UShvpNUJ'];

$header= [
    'Authorization: Key= ' . SERVER_API_KEY,
    'Content-Type: Application/json'
];

$msg=[
    'title'=> 'Nowa wiadomość ze świata',
    'body' => 'Kraj znowu wolny!!!',
    'icon'=> 'style/img/powiadomienie.png',
    'image' => 'style/img/giphy.gif',
    'click_action' => 'http://localhost/strony/Inzynierka/index.php',
    'tag' => 'Wolność',

];

$payload=[
    'registration_ids' => $registrationIds,
    'data' => $msg,
];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($payload),
    CURLOPT_HTTPHEADER => $header,
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