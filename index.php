<?php
if(strcmp($_GET["token"], $_SERVER['TOKEN']) !== 0)
    die('Access denied!');

function sendMessage($messaggio) {
  $url = "https://api.telegram.org/bot" . $_SERVER['TELEGRAM_TOKEN'] . "/sendMessage?chat_id=" . $_SERVER['TELEGRAM_CHAT_ID'];
  $url = $url . "&text=" . urlencode($messaggio);
  $ch = curl_init();
  $optArray = array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true
  );
  curl_setopt_array($ch, $optArray);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

if(isset($_GET["action"]) && strcmp($_GET["action"], "create") == 0) {
    sendMessage($_GET["content"]);
}

?>