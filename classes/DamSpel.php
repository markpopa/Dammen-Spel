<?php

declare(strict_types=1);

class DamSpel
{
    private Bord $bord;
    private $userInterface;
    private $RegelController;
    private int $spelerAanDeBeurt; // Index van de speler
    private array $spelers = ['wit', 'zwart'];

    public function __construct()
    {
        $this->bord = new Bord();
        $this->userInterface = new UserInterface();
        $this->RegelController = new RegelController();
        $this->spelerAanDeBeurt = 0; // Wit begint
    }

    public function start(): void
    {
        echo "\nHet damspel is gestart!\n\n";
        echo "Geef je zetten op in het formaat: X,Y X,Y\n";
        echo "Bijvoorbeeld: 1,6 2,5\n\n";
        echo "Typ 'exit' om het spel te stoppen...\n\n";

        while (true) {
            // Print het dambord
            $this->bord->printStatus();

            // voor gemak:
            $huidigeSpeler = $this->spelers[$this->spelerAanDeBeurt];

            // Vraag om zet
            $zet = $this->userInterface->vraagSpelerOmZet($huidigeSpeler);

            if (!$this->RegelController->isZetGeldig($zet, $this->bord, $huidigeSpeler)) {
                echo "Deze zet is niet geldig! Probeer het opnieuw.\n";
                continue;
            }

            // Wis de terminal alleen als de zet geldig is. 
            // Doe je het eerder (voor het printen van het bord) dan zie je de foutmeldingen niet....
            echo "\033[2J\033[H";

            echo "De zet is geldig: ";
            echo strtoupper($huidigeSpeler) . " gaat";
            echo " van " . $zet->getvanPositie()->getX() . "," . $zet->getvanPositie()->getY();
            echo " naar " . $zet->getnaarPositie()->getX() . "," . $zet->getnaarPositie()->getY() . "\n\n";

            // voer de zet uit
            $this->bord->voerZetUit($zet, $huidigeSpeler, $this);

            // wissel de speler
            $this->spelerAanDeBeurt = 1 - $this->spelerAanDeBeurt; // Wisselt tussen 0 en 1
        }
    }
}
