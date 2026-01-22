<?php

declare(strict_types=1);

class Bord
{
    public const BORD_BREEDTE = 10;
    public const BORD_HOOGTE  = 10;

    private array $vakjes = [];

    public function __construct()
    {
        for ($rij = 0; $rij < self::BORD_HOOGTE; $rij++) {
            $this->vakjes[$rij] = [];

            for ($kolom = 0; $kolom < self::BORD_BREEDTE; $kolom++) {
                $kleur = ($rij + $kolom) % 2 == 0 ? "wit" : "zwart";

                if ($rij < 4 && $kleur === "zwart") {
                    $steen = new Steen("zwart");
                } elseif ($rij > 5 && $kleur === "zwart") {
                    $steen = new Steen("wit");
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

    public function getVakje(int $x, int $y): Vak
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

    public function setSteenOpPositie(Positie $positie, ?AbstractSteen $steen): void
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
        echo "    ╔═══╤═══╤═══╤═══╤═══╤═══╤═══╤═══╤═══╤═══╗\n";

        foreach ($this->vakjes as $rijIndex => $rij) {
            echo "  $rijIndex ║";

            foreach ($rij as $kolomIndex => $vak) {
                $steen = $vak->getSteen();

                if ($steen !== null) {
                    echo " " . strtoupper($steen->getKleur()[0]) . " ";
                } else {
                    echo "   ";
                }

                echo ($kolomIndex < 9) ? "│" : "║";
            }

            echo PHP_EOL;

            if ($rijIndex < 9) {
                echo "    ╟───┼───┼───┼───┼───┼───┼───┼───┼───┼───╢\n";
            } else {
                echo "    ╚═══╧═══╧═══╧═══╧═══╧═══╧═══╧═══╧═══╧═══╝\n";
            }
        }

        echo "  X→  0   1   2   3   4   5   6   7   8   9 \n";
        echo PHP_EOL;
    }

    public function voerZetUit(Zet $zet, string $speler, DamSpel $damspel): void
    {
        $start = $zet->getVanPositie();
        $eind  = $zet->getNaarPositie();

        $steen = $this->getSteenOpPositie($start);
        if ($steen === null) {
            return;
        }

        $this->setSteenOpPositie($eind, $steen);
        $this->setSteenOpPositie($start, null);

        $dx = abs($eind->getX() - $start->getX());
        $dy = abs($eind->getY() - $start->getY());

        if ($dx === 2 && $dy === 2) {
            $tussenX = (int)(($start->getX() + $eind->getX()) / 2);
            $tussenY = (int)(($start->getY() + $eind->getY()) / 2);

            $this->setSteenOpPositie(new Positie($tussenX, $tussenY), null);
        }
    }
}
