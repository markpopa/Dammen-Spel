<?php

declare(strict_types=1);

class RegelSteenOpStartpositie implements RegelInterface
{
    public function check(Zet $zet, Bord $bord, string $huidigeSpeler): bool
    {
        $start = $zet->getVanPositie();
        $steen = $bord->getSteenOpPositie($start);

        unset($huidigeSpeler);

        if ($steen === null) {
            echo "Fout: Er staat geen steen op de startpositie." . PHP_EOL;
            return false;
        }

        return true;
    }
}
