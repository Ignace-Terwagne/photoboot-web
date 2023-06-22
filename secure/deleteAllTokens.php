<?php
$tokens_data = fopen('tokens.json', 'w');
ftruncate($tokens_data, 0);
fwrite($tokens_data, "{}");
fclose($tokens_data);
?>