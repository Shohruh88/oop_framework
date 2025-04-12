<?php
// large_file_processing.php

// Katta faylni yaratish (test uchun)
function createLargeFile($filename, $lines) {
    $file = fopen($filename, 'w');
    for ($i = 0; $i < $lines; $i++) {
        fwrite($file, "Line $i: " . str_repeat('a', 100) . "\n");
    }
    fclose($file);
    echo "$filename fayli yaratilib, $lines qatordan iborat\n";
}

// Oddiy usulda faylni o'qish (butun faylni xotiraga yuklaydi)
function readFileToArray($filename) {
    return file($filename);
}

// Generator yordamida faylni o'qish (qator ketidan qator o'qiydi)
function readFileAsGenerator($filename) {
    $file = fopen($filename, 'r');
    if (!$file) {
        return;
    }

    while (!feof($file)) {
        yield fgets($file);
    }

    fclose($file);
}

// Test fayl yaratish (10,000 qator)
$filename = 'large_test_file.txt';
$lineCount = 10000;
createLargeFile($filename, $lineCount);

// 1. Oddiy usulda o'qish va xotirani o'lchash
echo "Faylni oddiy usulda o'qish...\n";
$startMemory = memory_get_usage();
$lines = readFileToArray($filename);
$lineCount = count($lines);
$endMemory = memory_get_usage();
echo "Oddiy usul uchun ishlatilgan xotira: " . round(($endMemory - $startMemory) / (1024 * 1024), 2) . " MB\n";
echo "O'qilgan qatorlar soni: $lineCount\n";

// 2. Generator bilan o'qish va xotirani o'lchash
echo "\nFaylni generator bilan o'qish...\n";
$startMemory = memory_get_usage();
$generator = readFileAsGenerator($filename);
$lineCount = 0;
foreach ($generator as $line) {
    $lineCount++;
}
$endMemory = memory_get_usage();
echo "Generator usuli uchun ishlatilgan xotira: " . round(($endMemory - $startMemory) / (1024 * 1024), 2) . " MB\n";
echo "O'qilgan qatorlar soni: $lineCount\n";

// Faylni o'chirish (ixtiyoriy)
// unlink($filename);