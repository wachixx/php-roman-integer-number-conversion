<?php declare(strict_types=1);

/**
 * Convert roman numerals to integer numbers
 */
require_once(__DIR__ . '/lib/roman/funcs.php');

# main
printf("-> %d\n", get_integer(get_input()));
