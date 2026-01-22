<?php

declare(strict_types=1);

class RegelDiagonaleZet implements RegelInterface
{
    public function check(Zet $zet, Bord $bord, string $huidigeSpeler): bool
    {
        $start = $zet->getVanPositie();
        $eind  = $zet->getNaarPositie();

        $dx = abs($eind->getX() - $start->getX());
        $dy = abs($eind->getY() - $start->getY());

        if ($dx !== $dy || $dx > 2) {
            echo "Fout: Een zet moet diagonaal en maximaal 2 stappen zijn." . PHP_EOL;
            return false;
        }

        return true;
    }
}
