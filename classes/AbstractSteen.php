<?php

declare(strict_types=1);

abstract class AbstractSteen
{
    private string $kleur;

    private function __construct(string $kleur)
    {
        $this->kleur = $kleur;
    }

    public function getKleur(): string
    {
        return $this->kleur;
    }

    abstract public function kanAchteruitSlaan(): bool;

}
