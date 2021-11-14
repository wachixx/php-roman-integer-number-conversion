<?php declare(strict_types=1);

$errors = [
    "invalid_roman_number" => "Invalid roman number supplied.",
];

$roman_digits = [
    "E" => 0,
    "I" => 1,
    "V" => 5,
    "X" => 10,
    "L" => 50,
    "C" => 100,
    "D" => 500,
    "M" => 1000,
];

$searches = [
    'roman_digits'       => '/^[IVXLCDM]+$/',
    'roman_subtractives' => '/(?:IV|IX|XL|XC|CD|CM)/'
];
