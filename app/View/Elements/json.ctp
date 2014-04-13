<?php
header('Content-type: application/json');
header('X-JSON: ' . $this->js->object($response));
// Convert the PHP array to JSON and echo it
echo $this->js->object($response);
?>

