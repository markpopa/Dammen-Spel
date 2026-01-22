<?php

declare(strict_types=1);

require_once __DIR__ . '/Regels/RegelInterface.php';
require_once __DIR__ . '/Regels/RegelSteenOpStartpositie.php';
require_once __DIR__ . '/Regels/RegelJuisteSpeler.php';
require_once __DIR__ . '/Regels/RegelEindPositieLeeg.php';
require_once __DIR__ . '/Regels/RegelDiagonaleZet.php';
require_once __DIR__ . '/Regels/RegelSteenBeweegtVooruit.php';
require_once __DIR__ . '/Regels/RegelSlaanBijSprong.php';

class RegelController
{
    /** @var RegelInterface[] */
    private array $regels;

    public function __construct()
    {
        $this->regels = [
            new RegelSteenOpStartpositie(),
            new RegelJuisteSpeler(),
            new RegelEindPositieLeeg(),
            new RegelDiagonaleZet(),
            new RegelSteenBeweegtVooruit(),
            new RegelSlaanBijSprong(),
        ];
    }

    public function isZetGeldig(Zet $zet, Bord $bord, string $speler): bool
    {
        foreach ($this->regels as $regel) {
            if (!$regel->check($zet, $bord, $speler)) {
                return false;
            }
        }
        return true;
    }
}
