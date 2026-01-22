<?php
declare(strict_types=1);

class RegelSteenBeweegtVooruit implements RegelInterface
{
    public function check(Zet $zet, Bord $bord, string $huidigeSpeler): bool
    {
        $start = $zet->getVanPositie();
        $eind  = $zet->getNaarPositie();

        $steen = $bord->getSteenOpPositie($start);
        if ($steen === null) {
            return false;
        }

        // If it's a Dam, allow direction (you can tighten later if needed)
        if ($steen->kanAchteruitSlaan()) {
            return true;
        }

        if ($huidigeSpeler === 'wit' && $eind->getY() >= $start->getY()) {
            echo "Fout: Witte stenen mogen alleen omhoog bewegen." . PHP_EOL;
            return false;
        }

        if ($huidigeSpeler === 'zwart' && $eind->getY() <= $start->getY()) {
            echo "Fout: Zwarte stenen mogen alleen omlaag bewegen." . PHP_EOL;
            return false;
        }

        return true;
    }
}
