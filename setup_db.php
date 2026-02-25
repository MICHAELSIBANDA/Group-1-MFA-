<?php
// Load environment variables
if (!file_exists(__DIR__ . '/.env')) {
    die(".env file is missing. Copy .env.example to .env and edit it.\n");
}

$env = parse_ini_file(__DIR__ . '/.env');

// Connect to MySQL (without selecting a database)
$conn = new mysqli($env['DB_HOST'], $env['DB_USER'], $env['DB_PASS'], '', $env['DB_PORT']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "\n");
}

// Create database if it doesn't exist
$dbname = $env['DB_NAME'];
if ($conn->query("CREATE DATABASE IF NOT EXISTS `$dbname`") === TRUE) {
    //echo "Database '$dbname' ready or already exists.\n";
} else {
    die("Error creating database: " . $conn->error . "\n");
}

// Select the database
$conn->select_db($dbname);

// Create `nominees` table
$sqlNominees = "CREATE TABLE IF NOT EXISTS nominees (
    nominee_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sqlNominees) === TRUE) {
    //echo "Table 'nominees' ready or already exists.\n";
} else {
    die("Error creating nominees table: " . $conn->error . "\n");
}

// Create `categories` table (linked to nominees)
$sqlCategories = "CREATE TABLE IF NOT EXISTS categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_type VARCHAR(30) NOT NULL,
    qualification VARCHAR(50) NOT NULL,
    institution VARCHAR(30) NOT NULL,
    weblinkurl VARCHAR(255),
    achievement_description VARCHAR(200) NOT NULL,
    nominee_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (nominee_id) REFERENCES nominees(nominee_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sqlCategories) === TRUE) {
   // echo "Table 'categories' ready or already exists.\n";
} else {
    die("Error creating categories table: " . $conn->error . "\n");
}

echo "";
// Connection remains open for subsequent scripts that include this file
?>