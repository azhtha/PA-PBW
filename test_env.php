<?php
echo "Current directory: " . __DIR__ . "<br>";
echo ".env file path: " . __DIR__ . '/.env' . "<br>";
echo ".env exists: " . (file_exists(__DIR__ . '/.env') ? 'YES' : 'NO') . "<br>";

// Read .env file directly
$envContent = file_get_contents(__DIR__ . '/.env');
echo ".env content:<br><pre>" . htmlspecialchars($envContent) . "</pre><br>";

// Load bootstrap
require 'bootstrap/app.php';

echo "After bootstrap loading:<br>";
echo "DB_HOST: '" . env('DB_HOST') . "'<br>";
echo "DB_USER: '" . env('DB_USER') . "'<br>";
echo "DB_NAME: '" . env('DB_NAME') . "'<br>";
?>