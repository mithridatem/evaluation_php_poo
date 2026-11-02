<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Console;
use App\Entity\Game;

class GameRepository
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
     * Méthode qui ajoute une jeu (Game) en BDD
     * @param Game $game objet Jeu
     * @return ?Game Objet Jeu ou null
     * @throws \Exception Erreurs SQL
     */
    public function saveGame(Game $game): ?Game 
    {
        try {
            //écrire la requête SQL
            $sql = "INSERT INTO video_game(title, `type`, publish_at, id_console) VALUE(?,?,?,?)";
            //préparer la requête
            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(1, $game->getTitle(), \PDO::PARAM_STR);
            $stmt->bindValue(2, $game->getType(), \PDO::PARAM_STR);
            $stmt->bindValue(3, $game->getPublishAt()->format("Y-m-d"), \PDO::PARAM_STR);
            $stmt->bindValue(4, $game->getConsole()->getId(), \PDO::PARAM_INT);
            //Exécuter la requête
            $stmt->execute();
            //récupérer l'ID
            $id = $this->connect->lastInsertId();
            //Setter l'ID
            $game->setId($id);
        } catch(\PDOException $e) {
            echo "Erreur SQL " . $e->getMessage();
            return null;
        }
        return $game ?? null;
    }
    
    /**
     * Méthode qui retourne la liste des jeux (Game)
     * @return array<Game> Retourne le tableau des jeux (Game)
     * @throws \Exception Erreurs SQL
     */
    public function findAllGames(): array 
    {
        try {
            //Ecrire la requête SQL
            $sql = "SELECT vg.id, vg.title, vg.`type`, vg.publish_at, c.id, c.`name`, c.manufacturer FROM video_game AS vg 
            INNER JOIN console AS c ON vg.id_console = c.id ORDER BY vg.id ASC";
            //Préparer la requête SQL
            $stmt = $this->connect->prepare($sql);
            //Exécuter la requête SQL
            $stmt->execute();
            //Récupération
            $games = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        return $games ?? [];
    }
}
