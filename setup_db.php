<?php
// Load environment variables from .env
if (!file_exists(__DIR__ . '/.env')) {
    die(".env file is missing. Copy .env.example to .env and edit it.\n");
}

$env = parse_ini_file(__DIR__ . '/.env');

// Connect to MySQL without selecting a database yet
$conn = new mysqli($env['DB_HOST'], $env['DB_USER'], $env['DB_PASS'], '', $env['DB_PORT']);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error . "\n");

// Create the database if it doesn't exist
if ($conn->query("CREATE DATABASE IF NOT EXISTS {$env['DB_NAME']}") === TRUE) {
    echo "Database '{$env['DB_NAME']}' ready or already exists.\n";
} else {
    die("Error creating database: " . $conn->error . "\n");
}

// Select the database
$conn->select_db($env['DB_NAME']);

// Create the 'awards' table if it doesn't exist
$table_sql = "CREATE TABLE IF NOT EXISTS awards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    
    category VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($table_sql) === TRUE) {
    echo "Table 'awards' ready or already exists.\n";
} else {
    die("Error creating table: " . $conn->error . "\n");
}

echo "Setup complete! You can now run index.php.\n";
$conn->close();
?>