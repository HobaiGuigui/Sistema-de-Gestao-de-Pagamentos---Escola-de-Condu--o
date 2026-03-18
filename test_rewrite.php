<?php
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo "GET url: " . ($_GET['url'] ?? 'not set') . "<br>";
?>
