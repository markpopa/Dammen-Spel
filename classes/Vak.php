<?php

declare(strict_types=1);

class Vak
{
    public string $kleur;  // "wit" of "zwart"
    public ?Steen $steen;  // Bevat een steen of is leeg

    public function __construct(string $kleur, ?Steen $steen = null)
    {
        $this->kleur = $kleur;
        $this->steen = $steen;
    }
}
