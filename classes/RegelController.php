<?php
declare(strict_types=1);

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
            // new RegelSlaanVerplicht(), // later (needs board scan)
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
