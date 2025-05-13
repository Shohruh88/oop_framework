<?php
$kun = 2;

$return_value = match ($kun){
    1 => 'Dushanba',
    2 => 'Seshanba',
    3 => 'Chorshanba',
    4 => 'Payshanba',
    5 => 'Juma',
    6 => 'Shanba',
    7 => 'Yakshanba'
};
var_dump($return_value);