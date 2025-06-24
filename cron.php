<?php
require 'config.php';

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

$today = date('Y-m-d');
$users = $db->query("SELECT * FROM users")->fetchAll();

foreach ($users as $user) {
  $expire = new DateTime($user['expire_date']);
  $now = new DateTime($today);
  $diff = (int)$now->diff($expire)->format('%r%a');

  $message = null;
  if ($diff === 2) {
    $message = "🔔 เหลือ 2 วัน YouTube Premium ของคุณกำลังจะหมดอายุ";
  } elseif ($diff === 1) {
    $message = "🔔 เหลือ 1 วัน YouTube Premium ของคุณกำลังจะหมดอายุ";
  } elseif ($diff === 0) {
    $message = "❌ YouTube Premium หมดอายุแล้ว กรุณาติดต่อร้านเพื่อต่ออายุ";
  }

  if ($message) {
    sendMessage([
      'to' => $user['line_user_id'],
      'messages' => [[
        'type' => 'text',
        'text' => $message
      ]]
    ]);
  }
}
echo "แจ้งเตือนเสร็จสิ้น";
