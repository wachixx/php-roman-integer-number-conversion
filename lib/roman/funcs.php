<?php declare(strict_types=1);

/**
 * Convert roman numerals to integers
 */
require_once(__DIR__ . '/data.php');

set_error_handler('show_error');

function re($search_key): string
{
    global $searches;
    if (array_key_exists($search_key, $searches))
        return $searches[$search_key];
    else
        return "Invalid key.";
}

function is_valid_roman_digits(string $roman): bool
{
    $r = null;
    $r = preg_match(re("roman_digits"), $roman);
    return $r === 1;
}

function is_valid_roman_subtractive(string $roman_pair): bool
{
    global $errors;
    $r = null;
    $r = preg_match(re("roman_subtractives"), $roman_pair);
    return $r === 1;
}

function get_integer(string $roman): int
{
    global $errors, $roman_digits;
    $roman_pieces = array_values(
        array_filter(
            preg_split('//', $roman),
            function ($v) {
                return strlen($v) > 0;
            }
        )
    );
    $roman_pieces_shifted = offset_left_by_one($roman_pieces);
    return array_reduce(
        array_map(
            function (string $v, int $k) use (
                &$roman_pieces_shifted,
                $roman_digits
            ) {
                $result = 0;
                if ($k == 0)
                    $result = get_decimal_digit(
                        $v,
                        $roman_pieces_shifted[$k]
                    );
                else if (
                    ! skip_digit($roman_pieces_shifted[$k-1])
                )
                    $result = get_decimal_digit(
                        $v,
                        $roman_pieces_shifted[$k]
                    );
                if (
                    $result !== 0 &&
                    $result <
                    $roman_digits[$roman_pieces_shifted[$k]]
                )
                    $roman_pieces_shifted[$k] = '#';
                return $result;
            },
            $roman_pieces,
            array_keys($roman_pieces)
        ),
        'calc_sum',
        0
    );
}

function skip_digit(string $char): bool
{
    return (
        strcmp(
            '#',
            $char
        ) === 0
    );
}

function get_decimal_digit(
    $current_roman_digit,
    $next_roman_digit
): int
{
    global $errors, $roman_digits;
    if (
        $roman_digits[$current_roman_digit] >=
        $roman_digits[$next_roman_digit]
    )
        return sum($current_roman_digit, "0");
    else {
        if(
            is_valid_roman_subtractive(
                $current_roman_digit
                . $next_roman_digit
            )
        )
            return diff($next_roman_digit, $current_roman_digit);
        else {
            trigger_error($errors['invalid_roman_number']);
            exit;
        }
    }
}

function sum(string $digit1, string $digit2): int
{
    global $roman_digits;
    $digit2 += 0;
    return $roman_digits[$digit1] + $digit2;
}

function diff(string $digit1, string $digit2): int
{
    global $roman_digits;
    return $roman_digits[$digit1] - $roman_digits[$digit2];
}

function offset_left_by_one(array $arr): array
{
     array_shift($arr);
     $arr[] = "E";
     return $arr;
}

function calc_sum(int $carry, int $v): int
{
    $carry += $v;
    return $carry;
}

function show_error($errno, $errstr, $errfile, $errline): void
{
    printf("%s\n", $errstr);
}

function get_input(): string
{
    global $input;
    do {
        $input = readline("Enter a roman number: ");
    } while (!is_valid_roman_digits($input));
    return $input;
}
