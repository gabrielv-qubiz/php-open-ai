<?php

require '../vendor/autoload.php'; // remove this line if you use a PHP Framework.
use App\AiClient;

$chat = new AiClient();
$output = $chat->modifyAssistant();

echo '<pre>' . var_export($output, true) . '</pre>';