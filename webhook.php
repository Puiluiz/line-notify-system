<?php
require 'config.php';

$requestBody = file_get_contents('php://input');
$events = json_decode($requestBody, true);

if (!empty($events['events'])) {
  foreach ($events['events'] as $event) {
    if ($event['type'] === 'follow') {
      $userId = $event['source']['userId'];

      $welcome = [
        'to' => $userId,
        'messages' => [[
          'type' => 'text',
          'text' => "🎉 ยินดีต้อนรับ กรุณารอสักครู่ร้านจะเพิ่มข้อมูลให้"
        ]]
      ];
      sendMessage($welcome);
    }
  }
}
echo "OK";

function sendMessage($payload) {
  global $channelAccessToken;
  $ch = curl_init('https://api.line.me/v2/bot/message/push');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $channelAccessToken
  ]);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}
