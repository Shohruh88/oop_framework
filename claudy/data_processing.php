<?php
// data_processing.php

// 1 million element hosil qiluvchi generator
function generateMillionRecords() {
    for ($i = 0; $i < 1000000; $i++) {
        yield [
            'id' => $i,
            'name' => 'User-' . $i,
            'value' => rand(1, 1000),
            'is_active' => (rand(0, 1) === 1)
        ];
    }
}

// Filtrlash generatori
function filterActiveUsers($records) {
    foreach ($records as $record) {
        if ($record['is_active']) {
            yield $record;
        }
    }
}

// Ma'lumotlarni o'zgartirish generatori
function transformData($records) {
    foreach ($records as $record) {
        yield [
            'id' => $record['id'],
            'full_name' => 'User ' . $record['name'],
            'score' => $record['value'] * 2,
            'status' => 'Active'
        ];
    }
}

// Katta ma'lumotlarni generatsiya
echo "Ma'lumotlar generatsiya qilinmoqda...\n";
$startTime = microtime(true);

// Generator zanjirini yaratish
$allRecords = generateMillionRecords();
$activeUsers = filterActiveUsers($allRecords);
$transformedData = transformData($activeUsers);

$count = 0;
$totalScore = 0;

// Ma'lumotlarni qayta ishlash
foreach ($transformedData as $index => $user) {
    $count++;
    $totalScore += $user['score'];

    // Har 100,000 yozuvda progress ko'rsatish
    if ($count % 100000 === 0) {
        echo "Qayta ishlangan: $count ta ma'lumot\n";
    }
}

$endTime = microtime(true);
$executionTime = round($endTime - $startTime, 2);

echo "\nQayta ishlangan jami ma'lumotlar: $count\n";
echo "O'rtacha ball: " . round($totalScore / $count, 2) . "\n";
echo "Bajarilish vaqti: $executionTime sekund\n";
echo "Joriy xotiradan foydalanish: " . round(memory_get_usage() / (1024 * 1024), 2) . " MB\n";
echo "Maksimal xotiradan foydalanish: " . round(memory_get_peak_usage() / (1024 * 1024), 2) . " MB\n";