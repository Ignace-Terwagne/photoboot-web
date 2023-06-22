<?php
$config_data = json_decode(file_get_contents('../secure/config.json'), true);
$tokens_data = json_decode(file_get_contents('../secure/tokens.json'), true);
$target_token = $_GET['token'];
if (array_key_exists($target_token, $tokens_data)) {
    $path = "../" . $tokens_data[$target_token]['path'];
    if ($config_data['expiration'] == true) {
        if (time() - $tokens_data[$target_token]['timestamp'] < $config_data['expiration-time']) {
            
            include('index.html');
        } else {
            echo 'token expired';
        }
    }
    else {
        include('index.html');
    }
} else {
    echo 'invalid token';
}
