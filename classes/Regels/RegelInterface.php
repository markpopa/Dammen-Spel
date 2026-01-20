<?php
declare(strict_types=1);

interface RegelInterface
{
    public function check(Zet $zet, Bord $bord, string $huidigeSpeler): bool;
}
