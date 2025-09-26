<?php

class Bord
{
    public array $vakjes = [];
    
    public function __construct()
    {

        // Bord initialiseren
        for ($rij = 0; $rij < 10; $rij++) {
            $this->vakjes[$rij] = [];
            
            for ($kolom = 0; $kolom < 10; $kolom++) {
                // Afwisselend zwart/wit vakje
                $kleur = ($rij + $kolom) % 2 == 0 ? "wit" : "zwart";

                // Beginposities van de stenen
                if ($rij < 4 && $kleur === "zwart") {
                    $steen = new Steen("zwart"); // Zwarte stenen bovenaan
                } elseif ($rij > 5 && $kleur === "zwart") {
                    $steen = new Steen("wit"); // Witte stenen onderaan
                } else {
                    $steen = null;
                }

                $this->vakjes[$rij][$kolom] = new Vak($kleur, $steen);
            }
        } 
    }

    public function printStatus(): void
    {
        echo PHP_EOL;

        echo "  Y↓\n";

        // Print bovenkant bord
        echo "    ╔═══╤═══╤═══╤═══╤═══╤═══╤═══╤═══╤═══╤═══╗\n";

        // Print elke rij van het bord
        foreach ($this->vakjes as $rijIndex => $rij) {
            // Rijnummer (Y-as coördinaat)
            echo "  $rijIndex ║";

            // Print de vakken in de rij
            foreach ($rij as $kolomIndex => $vak) {
                if ($vak->steen) {
                    // Toon steen (W voor wit, Z voor zwart)
                    echo " " . strtoupper($vak->steen->kleur[0]) . " ";
                } else {
                    // Leeg vak
                    echo "   ";
                }

            // Afsluiten met een separator
                if ($kolomIndex < 9) {
                    echo "│"; // Tussen  de vakken
                } else {
                    echo "║"; // Voor het laatste vak in de rij
                }
            }

            // Sluit de rij af
            echo PHP_EOL;

            if ($rijIndex < 9) {
                // Print tussenliggende randen
                echo "    ╟───┼───┼───┼───┼───┼───┼───┼───┼───┼───╢\n";
            } else {
                // Print onderkant
                echo "    ╚═══╧═══╧═══╧═══╧═══╧═══╧═══╧═══╧═══╧═══╝\n";
            }
        }

        // Print X-as coördinaten
        echo "  X→  0   1   2   3   4   5   6   7   8   9 \n";

        echo PHP_EOL;
    }

    public function voerZetUit(Zet $zet, string $speler, DamSpel $damspel): void
    {
        $start = $zet->vanPositie;
        $eind = $zet->naarPositie;

        // Verplaats de steen
        $this->vakjes[$eind->y][$eind->x]->steen = $this->vakjes[$start->y][$start->x]->steen;
        $this->vakjes[$start->y][$start->x]->steen = null;

        // Controleer of er een steen is geslagen
        $dx = abs($eind->x - $start->x);
        $dy = abs($eind->y - $start->y);

        if ($dx === 2 && $dy === 2) { // Bij een sprong van 2
            $tussenX = ($start->x + $eind->x) / 2;
            $tussenY = ($start->y + $eind->y) / 2;

            // Verwijder de geslagen steen
            $this->vakjes[$tussenY][$tussenX]->steen = null;
        }
    }
}
