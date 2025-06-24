<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $start = $_POST['start_date'];
  $pack = $_POST['package'];
  $family = $_POST['family_name'];
  $lineUserId = $_POST['line_user_id'];
  $expire = date('Y-m-d', strtotime("+{$pack} months", strtotime($start)));

  $stmt = $db->prepare("INSERT INTO users (email, start_date, package, expire_date, family_name, line_user_id)
                        VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->execute([$email, $start, $pack, $expire, $family, $lineUserId]);

  echo "เพิ่มลูกค้าเรียบร้อยแล้ว!";
}
