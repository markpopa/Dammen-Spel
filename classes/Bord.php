<?php

class Bord
{
    private const BORD_BREEDTE = 10;
    private const BORD_HOOGTE  = 10;

    private array $vakjes = [];
    
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

    public function getVakjes(): array
    {
        return $this->vakjes;
    }

    public function getVakje(int $x, int $y): ?Vak
    {
        return $this->vakjes[$y][$x];
    }

    public function setVakje(int $x, int $y, Vak $vak): void
    {
        $this->vakjes[$y][$x] = $vak;
    }

    public function getSteenOpPositie(Positie $positie): ?AbstractSteen
    {
        return $this->getSteenOpCoordinaten($positie->getX(), $positie->getY());
    }

    public function setSteenOpPositie(Positie $positie, AbstractSteen $steen): void
    {
        $this->vakjes[$positie->getY()][$positie->getX()]->setSteen($steen);
    }

    public function getSteenOpCoordinaten(int $x, int $y): ?AbstractSteen
    {
        return $this->vakjes[$y][$x]->getSteen();
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
        $start = $zet->getnaarPositie();
        $eind = $zet->getnaarPositie();

        // Verplaats de steen
        $this->vakjes[$eind->getY()][$eind->getX()]->steen = $this->vakjes[$start->getY()][$start->getX()]->steen;
        $this->vakjes[$start->getY()][$start->getX()]->steen = null;

        // Controleer of er een steen is geslagen
        $dx = abs($eind->getX() - $start->getX());
        $dy = abs($eind->getY() - $start->getY());

        if ($dx === 2 && $dy === 2) { // Bij een sprong van 2
            $tussenX = ($start->getX() + $eind->getX()) / 2;
            $tussenY = ($start->getY() + $eind->getY()) / 2;

            // Verwijder de geslagen steen
            $this->vakjes[$tussenY][$tussenX]->steen = null;
        }
    }
}
