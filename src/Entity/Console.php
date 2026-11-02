<?php

namespace App\Entity;

class Console
{
    //Attributs
    private int $id;
    private string $name;
    private string $manufacturer;

    //Constructeur
    public function __construct() {}
    
    //Getters et Setters
    public function getId(): int 
    {
        return $this->id;
    }

    public function setId(int $id): void 
    {
        $this->id = $id;
    }

    public function getName(): string 
    {
        return $this->name;
    }

    public function setName(int $name): void 
    {
        $this->name = $name;
    }

    public function getManufacturer(): string 
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): void 
    {
        $this->manufacturer = $manufacturer;
    }
}
