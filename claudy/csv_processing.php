<?php
// csv_processing.php

// CSV fayl yaratish (test uchun)
function createTestCsvFile($filename, $rows) {
    $file = fopen($filename, 'w');

    // Header qatorini yozish
    fputcsv($file, ['id', 'name', 'email', 'age', 'city']);

    // Ma'lumotlarni yozish
    for ($i = 1; $i <= $rows; $i++) {
        $data = [
            $i,
            'User ' . $i,
            'user' . $i . '@example.com',
            rand(18, 65),
            ['New York', 'London', 'Tokyo', 'Paris', 'Berlin'][rand(0, 4)]
        ];
        fputcsv($file, $data);
    }

    fclose($file);
    echo "$filename fayli $rows qator ma'lumot bilan yaratildi\n";
}

// CSV faylini qatorma-qator o'qish generatori
function readCsvGenerator($filename) {
    $file = fopen($filename, 'r');
    if (!$file) {
        return;
    }

    // Birinchi qator - ustun nomlari
    $headers = fgetcsv($file);

    // Qolgan qatorlar - ma'lumotlar
    while (($data = fgetcsv($file)) !== false) {
        // Ustun nomlari va qiymatlarni birlashtirish
        yield array_combine($headers, $data);
    }

    fclose($file);
}

// Test fayl yaratish
$filename = 'test_users.csv';
$rowCount = 100000;
createTestCsvFile($filename, $rowCount);

// CSV faylni qayta ishlash
echo "\nCSV faylni generator bilan qayta ishlash...\n";
$startTime = microtime(true);
$startMemory = memory_get_usage();

$users = readCsvGenerator($filename);

$ageGroups = [
    '18-30' => 0,
    '31-45' => 0,
    '46-65' => 0
];

$cityStats = [];
$processed = 0;

foreach ($users as $user) {
    $processed++;

    // Yosh guruhlarini hisoblash
    $age = (int)$user['age'];
    if ($age >= 18 && $age <= 30) {
        $ageGroups['18-30']++;
    } elseif ($age >= 31 && $age <= 45) {
        $ageGroups['31-45']++;
    } else {
        $ageGroups['46-65']++;
    }

    // Shaharlar bo'yicha statistika
    $city = $user['city'];
    if (!isset($cityStats[$city])) {
        $cityStats[$city] = 0;
    }
    $cityStats[$city]++;

    // Har 10,000 qatorda progress ko'rsatish
    if ($processed % 10000 === 0) {
        echo "Qayta ishlandi: $processed\n";
    }
}

$endTime = microtime(true);
$endMemory = memory_get_usage();

// Natijalarni ko'rsatish
echo "\nQayta ishlash yakunlandi ($processed qator)\n";
echo "Bajarilish vaqti: " . round($endTime - $startTime, 2) . " sekund\n";
echo "Ishlatilgan xotira: " . round(($endMemory - $startMemory) / (1024 * 1024), 2) . " MB\n";

echo "\nYosh guruhlari statistikasi:\n";
foreach ($ageGroups as $group => $count) {
    $percent = round(($count / $processed) * 100, 2);
    echo "$group: $count ($percent%)\n";
}

echo "\nEng mashhur shaharlar (top 5):\n";
arsort($cityStats);
$i = 0;
foreach ($cityStats as $city => $count) {
    $percent = round(($count / $processed) * 100, 2);
    echo "$city: $count ($percent%)\n";

    // Faqat top 5
    $i++;
    if ($i >= 5) break;
}

// Faylni o'chirish (ixtiyoriy)
// unlink($filename);