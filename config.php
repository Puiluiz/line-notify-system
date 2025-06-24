<?php
$channelAccessToken = 'hlNZRTY/8dgvPyrzOh7MgAl7oSA8PW8GKBtOVE94LYCyoX6iEcgWqPRWax3XQInKClpNIcvr2w74K1Jeo8Di+0I2VrQtoHNbewkxMRk39Ta7GYbE/8ys2xNGDS3GfC6Xo1Qwmrlg+YtlDulGCkJgBwdB04t89/1O/w1cDnyilFU=';
$channelSecret = 'cba7df0bf1e972d39c3faa47fa91cc95';

$db = new PDO('sqlite:db.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  email TEXT NOT NULL,
  start_date TEXT NOT NULL,
  package TEXT NOT NULL,
  expire_date TEXT NOT NULL,
  family_name TEXT,
  line_user_id TEXT NOT NULL
)");
