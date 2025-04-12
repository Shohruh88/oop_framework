<?php
// memory_comparison.php

// 1. Katta massiv yaratish
function getArrayOfNumbers($count) {
    $result = [];
    for ($i = 0; $i < $count; $i++) {
        $result[] = $i;
    }
    return $result;
}

// 2. Generator yaratish
function getGeneratorOfNumbers($count) {
    for ($i = 0; $i < $count; $i++) {
        yield $i;
    }
}

// 1 million element bilan test
$count = 1000000;

// Massiv bilan xotira o'lchash
echo "Massiv yaratilmoqda...\n";
$startMemory = memory_get_usage();
$array = getArrayOfNumbers($count);
$endMemory = memory_get_usage();
echo "Massiv uchun ishlatilgan xotira: " . round(($endMemory - $startMemory) / (1024 * 1024), 2) . " MB\n";

// Generator bilan xotira o'lchash
echo "Generator yaratilmoqda...\n";
$startMemory = memory_get_usage();
$generator = getGeneratorOfNumbers($count);
$endMemory = memory_get_usage();
echo "Generator uchun ishlatilgan xotira: " . round(($endMemory - $startMemory) / (1024 * 1024), 2) . " MB\n";

// Generatordan foydalanish (xotira o'zgarmaydi)
$sum = 0;
foreach ($generator as $number) {
    $sum += $number;
}
echo "Yig'indi: $sum\n";