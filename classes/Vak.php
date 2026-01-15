<?php

declare(strict_types=1);

class Vak
{
    private string $kleur;  // "wit" of "zwart"
    private ?AbstractSteen $steen;  // Bevat een steen of is leeg

    private function __construct(string $kleur, ?Steen $steen = null)
    {
        $this->kleur = $kleur;
        $this->steen = $steen;
    }

    public function
}
