<?php

declare(strict_types=1);

class Vak
{
    private string $kleur;
    private ?AbstractSteen $steen;

    public function __construct(string $kleur, ?AbstractSteen $steen = null)
    {
        $this->kleur = $kleur;
        $this->steen = $steen;
    }

    public function getKleur(): string 
    {
        return $this->kleur;
    }

    public function getSteen(): ?AbstractSteen 
    {
        return $this->steen;
    }

    public function setSteen(?AbstractSteen $steen): void
    {
        $this->steen = $steen;
    }

    public function isLeeg(): bool
    {
        return $this->steen === null;
    }
}
