<?php

require '../vendor/autoload.php'; // remove this line if you use a PHP Framework.
use App\AiClient;

$chat = new AiClient();
$output = $chat->chat();

echo '<pre>' . var_export($output['data'], true) . '</pre>';
echo '<pre>' . var_export(json_decode($output['response']), true) . '</pre>';