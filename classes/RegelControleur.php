<?php

declare(strict_types=1);

class RegelControleur
{
    public function isZetGeldig(Zet $zet, Bord $bord, string $speler): bool
    {
        $start = $zet->vanPositie;
        $eind = $zet->naarPositie;

        // Haal de vakken op uit het bord-array
        $startVak = $bord->vakjes[$start->y][$start->x];
        $eindVak = $bord->vakjes[$eind->y][$eind->x];

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
        $dx = abs($eind->x - $start->x);
        $dy = abs($eind->y - $start->y);

        if ($dx !== $dy || $dx > 2) {
            echo "Fout: Een zet moet diagonaal en maximaal 2 stappen zijn." . PHP_EOL;
            return false;
        }

        // 5. Controleer of de steen vooruit beweegt (voor niet-dammen)
        if ($speler === 'wit' && $eind->y >= $start->y) {
            echo "Fout: Witte stenen mogen alleen omhoog bewegen." . PHP_EOL;
            return false;
        }
        if ($speler === 'zwart' && $eind->y <= $start->y) {
            echo "Fout: Zwarte stenen mogen alleen omlaag bewegen." . PHP_EOL;
            return false;
        }

        // 6. Controleer of een vijandelijke steen geslagen wordt bij een sprong van 2
        if ($dx === 2) {
            $tussenX = ($start->x + $eind->x) / 2;
            $tussenY = ($start->y + $eind->y) / 2;
            $tussenVak = $bord->vakjes[$tussenY][$tussenX];

            if ($tussenVak->steen === null || $tussenVak->steen->kleur === $speler) {
                echo "Fout: Bij een sprong van 2 moet je een vijandelijke steen slaan." . PHP_EOL;
                return false;
            }
        }

        // Zet is geldig
        return true;
    }
}
