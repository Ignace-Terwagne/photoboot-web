<?php
$tokens_data = json_decode(file_get_contents('../secure/tokens.json'), true);
$deleted = 0;
foreach($tokens_data as $key => $token) {
    if (time() - $token['timestamp'] >= 300) {
        unset($tokens_data[$key]);
        $deleted++;
    }
}
file_put_contents("tokens.json", json_encode($tokens_data));
echo $deleted;
?>