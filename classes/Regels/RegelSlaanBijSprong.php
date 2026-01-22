<?php

declare(strict_types=1);

class RegelSlaanBijSprong implements RegelInterface
{
    public function check(Zet $zet, Bord $bord, string $huidigeSpeler): bool
    {
        $start = $zet->getVanPositie();
        $eind  = $zet->getNaarPositie();

        $dx = abs($eind->getX() - $start->getX());
        $dy = abs($eind->getY() - $start->getY());

        if ($dx === 2 && $dy === 2) {
            $tussenX = (int)(($start->getX() + $eind->getX()) / 2);
            $tussenY = (int)(($start->getY() + $eind->getY()) / 2);

            $tussenVak = $bord->getVakje($tussenX, $tussenY);
            $tussenSteen = $tussenVak->getSteen();

            if ($tussenSteen === null || $tussenSteen->getKleur() === $huidigeSpeler) {
                echo "Fout: Bij een sprong van 2 moet je een vijandelijke steen slaan." . PHP_EOL;
                return false;
            }
        }

        return true;
    }
}
