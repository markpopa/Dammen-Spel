<?php

declare(strict_types=1);

class Steen
{
    public string $kleur;

    public function __construct(string $kleur)
    {
        $this->kleur = $kleur;
    }
}
