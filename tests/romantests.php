<?php declare(strict_types=1);

include(__DIR__ . '/../lib/roman/funcs.php');

use PHPUnit\Framework\TestCase;

final class RomanTests extends TestCase
{
    public function testGetArabic(): int
    {
        $tdata = [
            'X' => 10,
            'XIX' => 19,
            'XCIX' => 99,
            'DXCIX' => 599,
            'DCXCIX' => 699,
            'CCCLVI' => 356,
            'MCMXCIX' => 1999,
            'DCCCLXXXVIII' => 888,
        ];
        // for($a=0; $a<count($tdata); $a++){
        foreach ($tdata as $roman => $dec) {
            $an = get_integer($roman);
            $this->assertSame($dec, $an);
        }
        return 1;
    }
}
