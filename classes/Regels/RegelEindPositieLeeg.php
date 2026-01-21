<?php
declare(strict_types=1);

class RegelEindPositieLeeg implements RegelInterface
{
    public function check(Zet $zet, Bord $bord, string $huidigeSpeler): bool
    {
        $eind = $zet->getNaarPositie();
        $steenOpEind = $bord->getSteenOpPositie($eind);

        if ($steenOpEind !== null) {
            echo "Fout: De eindpositie is niet leeg." . PHP_EOL;
            return false;
        }

        return true;
    }
}
