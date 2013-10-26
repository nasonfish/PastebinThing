<?php
header('Content-Type: text/plain');
if(!isset($args[0])){
    echo "Paste not found.";
} else {
    echo $handler->getText($args[0]);
}
