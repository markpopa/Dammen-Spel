<?php

declare(strict_types=1);

class RegelController
{
    public function isZetGeldig(Zet $zet, Bord $bord, string $speler): bool
    {
        $start = $zet->getvanPositie();
        $eind = $zet->getnaarPositie();

        // Haal de vakken op uit het bord-array
        $startVak = $bord->getVakjes()[$start->getY()][$start->getX()];
        $eindVak = $bord->getVakjes()[$eind->getY()][$eind->getX()];

        // 1. Controleer of er een steen op de startpositie staat
        if ($startVak->steen === null) {
            echo "Fout: Er staat geen steen op de startpositie." . PHP_EOL;
            return false;
        }

        $steen = $startVak->steen;

        // 2. Controleer of de steen van de juiste speler is
        if ($steen->kleur !== $speler) {
            echo "Fout: Dit is niet jouw steen." . PHP_EOL;
            return false;
        }

        // 3. Controleer of de eindpositie leeg is
        if ($eindVak->steen !== null) {
            echo "Fout: De eindpositie is niet leeg." . PHP_EOL;
            return false;
        }

        // 4. Controleer of de zet diagonaal is
        $dx = abs($eind->getX() - $start->getX());
        $dy = abs($eind->getY() - $start->getY());

        if ($dx !== $dy || $dx > 2) {
            echo "Fout: Een zet moet diagonaal en maximaal 2 stappen zijn." . PHP_EOL;
            return false;
        }

        // 5. Controleer of de steen vooruit beweegt (voor niet-dammen)
        if ($speler === 'wit' && $eind->getY() >= $start->getY()) {
            echo "Fout: Witte stenen mogen alleen omhoog bewegen." . PHP_EOL;
            return false;
        }
        if ($speler === 'zwart' && $eind->getY() <= $start->getY()) {
            echo "Fout: Zwarte stenen mogen alleen omlaag bewegen." . PHP_EOL;
            return false;
        }

        // 6. Controleer of een vijandelijke steen geslagen wordt bij een sprong van 2
        if ($dx === 2) {
            $tussenX = ($start->getX() + $eind->getX()) / 2;
            $tussenY = ($start->getY() + $eind->getY()) / 2;
            $tussenVak = $bord->getVakjes()[$tussenY][$tussenX];

            if ($tussenVak->steen === null || $tussenVak->steen->kleur === $speler) {
                echo "Fout: Bij een sprong van 2 moet je een vijandelijke steen slaan." . PHP_EOL;
                return false;
            }
        }

        // Zet is geldig
        return true;
    }
}
