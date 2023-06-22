<?php
$tokens_file = '../secure/tokens.json';
file_put_contents($tokens_file, json_encode([]));
$new_json = file_get_contents($tokens_file);
flush();
ob_flush();
?>