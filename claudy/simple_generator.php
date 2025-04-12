<?php
// simple_generator.php

function simpleGenerator() {
    echo "Generator boshlandi\n";
    yield 1;
    echo "1 dan so'ng\n";
    yield 2;
    echo "2 dan so'ng\n";
    yield 3;
    echo "Generator tugadi\n";
}

// Generatorni ishlatamiz
foreach (simpleGenerator() as $value) {
    echo "Qiymat: $value\n";
}