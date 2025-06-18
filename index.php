<?php
require_once 'config/db.php';

$db = new Database();
$conn = $db->connect();

if ($conn) {
    echo "✅ Connected to the database!";
} else {
    echo "❌ Failed to connect.";
}
