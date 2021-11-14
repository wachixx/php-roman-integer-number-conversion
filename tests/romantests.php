<?php declare(strict_types=1);

include(__DIR__ . '/../lib/roman/funcs.php');

use PHPUnit\Framework\TestCase;

final class RomanTests extends TestCase
{
    public function testGetInteger(): int
    {
        $an = get_integer('X');
        $this->assertSame(10, $an);
        $an += 0;
        return $an;
    }
}
