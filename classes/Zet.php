<?php 

declare(strict_types=1);

class Zet
{
    private Positie $vanPositie;
    private Positie $naarPositie;

    private function __construct(Positie $vanPositie, Positie $naarPositie)
    {
        $this->vanPositie = $vanPositie;
        $this->naarPositie = $naarPositie;
    }

    public function getvanPositie()
    {
        return $this->vanPositie;
    }

    public function getnaarPositie()
    {
        return $this->naarPositie;
    }
}
