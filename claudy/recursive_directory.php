<?php
// recursive_directory.php

// Katalog strukturasini rekursiv qaytaruvchi generator
function readDirectoryRecursive($path) {
    $items = new DirectoryIterator($path);

    foreach ($items as $item) {
        // . va .. kataloglarini o'tkazib yuborish
        if ($item->isDot()) {
            continue;
        }

        $itemPath = $item->getPathname();

        if ($item->isDir()) {
            // Katalog uchun
            yield $itemPath => ['type' => 'directory', 'name' => $item->getFilename()];

            // Rekursiv chaqirish - ichki kataloglarni qaytarish
            yield from readDirectoryRecursive($itemPath);
        } else {
            // Fayl uchun
            yield $itemPath => [
                'type' => 'file',
                'name' => $item->getFilename(),
                'size' => $item->getSize(),
                'extension' => $item->getExtension()
            ];
        }
    }
}

// Foydalanish
$currentDir = __DIR__; // Joriy katalog
echo "Katalog tuzilishini o'qish: $currentDir\n\n";

$items = readDirectoryRecursive($currentDir);

foreach ($items as $path => $info) {
    $indent = str_repeat('  ', substr_count($path, DIRECTORY_SEPARATOR) - substr_count($currentDir, DIRECTORY_SEPARATOR));
    $name = $info['name'];

    if ($info['type'] === 'directory') {
        echo "{$indent}📁 $name/\n";
    } else {
        $size = round($info['size'] / 1024, 2);
        echo "{$indent}📄 $name ($size KB)\n";
    }
}