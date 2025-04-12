<?php
// db_generator.php

// Ma'lumotlar bazasiga ulanish
$dsn = 'mysql:host=localhost;dbname=test';
$username = 'root';  // O'z ma'lumotlar bazangiz username/password'ini kiriting
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Ma'lumotlar bazasiga muvaffaqiyatli ulandik\n";

    // Test jadval yaratish
    setupTestTable($pdo);

    // 1. Oddiy usulda ma'lumotlar olish
    echo "Oddiy usulda ma'lumotlarni olish...\n";
    $startMemory = memory_get_usage();
    $rows = getAllRows($pdo);
    $endMemory = memory_get_usage();
    echo "Oddiy usul uchun ishlatilgan xotira: " . round(($endMemory - $startMemory) / (1024 * 1024), 2) . " MB\n";
    echo "Ma'lumotlar soni: " . count($rows) . "\n";

    // 2. Generator bilan ma'lumotlar olish
    echo "\nGenerator bilan ma'lumotlarni olish...\n";
    $startMemory = memory_get_usage();
    $rowGenerator = getRowsGenerator($pdo);
    $count = 0;
    foreach ($rowGenerator as $row) {
        $count++;
    }
    $endMemory = memory_get_usage();
    echo "Generator usuli uchun ishlatilgan xotira: " . round(($endMemory - $startMemory) / (1024 * 1024), 2) . " MB\n";
    echo "Ma'lumotlar soni: $count\n";

} catch (PDOException $e) {
    echo "Ma'lumotlar bazasiga ulanishda xatolik: " . $e->getMessage() . "\n";
}

// Test jadval yaratish va ma'lumotlar qo'shish
function setupTestTable($pdo) {
    try {
        // Jadval yaratish
        $pdo->exec("DROP TABLE IF EXISTS users_test");
        $pdo->exec("CREATE TABLE users_test (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50),
            email VARCHAR(50),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // Test ma'lumotlar qo'shish
        $stmt = $pdo->prepare("INSERT INTO users_test (name, email) VALUES (?, ?)");

        // 10,000 ta test ma'lumot
        $count = 10000;
        echo "Ma'lumotlar bazasiga $count ta test ma'lumotlar qo'shilmoqda...\n";

        for ($i = 1; $i <= $count; $i++) {
            $name = "User $i";
            $email = "user$i@example.com";
            $stmt->execute([$name, $email]);

            if ($i % 1000 === 0) {
                echo "Qo'shildi: $i ta ma'lumot\n";
            }
        }

        echo "Test jadval yaratildi va ma'lumotlar qo'shildi\n";
    } catch (PDOException $e) {
        echo "Jadval yaratishda xatolik: " . $e->getMessage() . "\n";
    }
}

// Oddiy usulda - barcha ma'lumotlarni bir vaqtda olish
function getAllRows($pdo) {
    $stmt = $pdo->query("SELECT * FROM users_test");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Generator bilan - ketma-ket ma'lumotlarni olish
function getRowsGenerator($pdo) {
    $stmt = $pdo->query("SELECT * FROM users_test");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        yield $row;
    }
}