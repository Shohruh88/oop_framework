<?php
// key_value_generator.php

// Kalitli qiymatlar generatori
function generateKeyValueData() {
    yield 'name' => 'John Doe';
    yield 'age' => 30;
    yield 'email' => 'john@example.com';
    yield 'city' => 'New York';
    yield 'country' => 'USA';
}

echo "Kalitli generator misolini ko'rish:\n";

foreach (generateKeyValueData() as $key => $value) {
    echo "$key: $value\n";
}

// Massivni kalitlari bilan birga qaytaruvchi generator
function arrayKeyGenerator($array) {
    foreach ($array as $key => $value) {
        yield $key => $value;
    }
}

$users = [
    'user1' => ['name' => 'Alice', 'age' => 25],
    'user2' => ['name' => 'Bob', 'age' => 30],
    'user3' => ['name' => 'Charlie', 'age' => 35]
];

echo "\nMassiv kalitlari bilan generator:\n";

foreach (arrayKeyGenerator($users) as $userId => $userData) {
    echo "$userId: {$userData['name']}, {$userData['age']} yosh\n";
}