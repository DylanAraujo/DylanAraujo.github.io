<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (!empty($_GET["message"])) {
    if (!isset($_SESSION["counter"])) {
      $_SESSION["counter"] = 0;
    }
    $_SESSION["counter"]++;
    $message = $_GET["message"];
    $file = fopen("messages.txt", "a");
    fwrite($file, $message . "\n");
    fclose($file);
  }
  $messages = file("messages.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  $mostRecentMessage = end($messages);
  echo $_SESSION["counter"] . ":" . $mostRecentMessage;
}
?>
