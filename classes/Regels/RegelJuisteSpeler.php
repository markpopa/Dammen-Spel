<?php

declare(strict_types=1);

class RegelJuisteSpeler implements RegelInterface
{
    public function check(Zet $zet, Bord $bord, string $huidigeSpeler): bool
    {
        $start = $zet->getVanPositie();
        $steen = $bord->getSteenOpPositie($start);

        // If no stone, let RegelSteenOpStartpositie handle the message.
        if ($steen === null) {
            return false;
        }

        if ($steen->getKleur() !== $huidigeSpeler) {
            echo "Fout: Dit is niet jouw steen." . PHP_EOL;
            return false;
        }

        return true;
    }
}
