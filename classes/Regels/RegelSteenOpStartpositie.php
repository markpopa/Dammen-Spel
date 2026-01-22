<?php

declare(strict_types=1);

class RegelSteenOpStartpositie implements RegelInterface
{
    public function check(Zet $zet, Bord $bord, string $_huidigeSpeler): bool
    {
        $start = $zet->getVanPositie();
        $steen = $bord->getSteenOpPositie($start);

        if ($steen === null) {
            echo "Fout: Er staat geen steen op de startpositie." . PHP_EOL;
            return false;
        }

        return true;
    }
}
