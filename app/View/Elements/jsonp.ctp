<?php
header('Content-type: application/json');
header('X-JSON: ' . $callback.'('.$this->js->object($response).')');
// Convert the PHP array to JSON and echo it
echo $callback.'('.$this->js->object($response).')';
?>

