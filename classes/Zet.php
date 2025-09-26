<?php 

declare(strict_types=1);

class Zet
{
    public Positie $vanPositie;
    public Positie $naarPositie;

    public function __construct(Positie $vanPositie, Positie $naarPositie)
    {
        $this->vanPositie = $vanPositie;
        $this->naarPositie = $naarPositie;
    }
}
