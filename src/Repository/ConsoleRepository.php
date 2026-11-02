<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Console;

class ConsoleRepository
{
    //Attribut
    private \PDO $connect;

    //Constructeur
    public function __construct()
    {
        //Injection des dependances
        $this->connect = (new Mysql)->connectBDD();
    }

    //Méthodes
    /**
     * Méthode qui retourne la liste des consoles (Console)
     * @return array<Console> Retourne le tableau des consoles (Console)
     * @throws \Exception Erreurs SQL
     */
    public function findAllConsoles(): array 
    {
        try {
            //Ecrire la requête SQL pour récupérer toutes les consoles
            $sql = "SELECT c.id, c.`name`, c.manufacturer FROM console AS c ";
            //Préparer la requête
            $stmt = $this->connect->prepare($sql);
            //Exécuter la requête
            $stmt->execute();
            //Récuperer les données (enregistrements)
            $consoles = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            echo "Erreur SQL : " . $e->getMessage();
        }
        return $consoles ?? [];
    }
}
