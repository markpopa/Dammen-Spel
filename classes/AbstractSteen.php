<?php

declare(strict_types=1);

abstract class AbstractSteen
{
    protected string $kleur;

    public function __construct(string $kleur)
    {
        $this->kleur = $kleur;
    }

    public function getKleur(): string
    {
        return $this->kleur;
    }

    abstract public function kanAchteruitSlaan(): bool;
}
