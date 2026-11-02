<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Repository\ConsoleRepository;
use App\Repository\GameRepository;
use App\Entity\Console;
use App\Entity\Game;
use App\Utils\Tools;


class GameController extends AbstractController
{
    //Attributs
    private ConsoleRepository $consoleRepository;
    private GameRepository $gameRepository;

    //Constructeur
    public function __construct()
    {
        //Injection des dependances
        $this->consoleRepository = new ConsoleRepository();
        $this->gameRepository = new GameRepository();
    }

    //Méthodes

    /**
     * Méthode pour ajouter un Jeu (Game)
     * @return mixed Retourne le template
     */
    public function addGame(): mixed
    {
        //Initialiser un tableau associatif $data vide.
        $data = [];
        //Récupérer la liste des consoles dans $consoles grâce à ConsoleRepository::findAllConsoles().
        $consoles = $this->consoleRepository->findAllConsoles();
        //Placer cette liste dans $data['consoles'].
        $data["consoles"] = $consoles;

        //Vérifier que le formulaire a été soumis.
        if (isset($_POST["submit"])) {
            //Vérifier que les champs attendus sont tous renseignés : title, type, publish_at et l’identifiant de console.
            if (
                empty($_POST["title"]) ||
                empty($_POST["type"]) ||
                empty($_POST["publish_at"]) ||
                empty($_POST["console"])
            ) {
                //Renseigner $data['error'] pour afficher un message si des champs obligatoires sont absents.
                $data["error"] = "Veuillez remplir les champs du formulaire";
            }

            // si il y à des erreurs
            if (empty($data["error"])) {

                //Nettoyer les entrées avec la méthode statique Tools::sanitize().
                $_POST["title"] = Tools::sanitize($_POST["title"]);
                $_POST["type"] = Tools::sanitize($_POST["type"]);
                $_POST["publish_at"] = Tools::sanitize($_POST["publish_at"]);
                $_POST["console"] = Tools::sanitize($_POST["console"]);
                //Créer un objet Game
                $game = new Game();
                //Instancier un objet Game et renseigner ses propriétés conformément au constructeur et aux setters du
                //modèle.
                $game->setTitle($_POST["title"]);
                $game->setType($_POST["type"]);
                $game->setPublishAt(new \DateTimeImmutable($_POST["publish_at"]));
                //setter d'une console
                $console = new Console();
                $console->setId($_POST["console"]);
                $game->setConsole($console);
                //Vérification : contrôler qu’un jeu ajouté via le formulaire est bien enregistré en base de données
                //Appeler la méthode saveGame() de GameRepository.
                if (null != $this->gameRepository->saveGame($game)) {
                    //Renseigner $data['valid'] pour afficher un message de succès lorsque l’enregistrement a réussi
                    $data["valid"] = "Le jeu " . $_POST["title"] . " a été ajouté avec succés";
                } else {
                    //Retourner une erreur enregsitrement impossible
                    $data["error"] = "Enregistrement impossible";
                }
            }
        }

        //Afficher le template template_add_game.php avec render(), son titre et $data
        return $this->render('add_game', 'Ajouter un jeu', $data ?? []);
    }

    /**
     * Méthode pour afficher la liste des Jeux (Game)
     * @return mixed Retourne le template
     */
    public function showAllGames(): mixed
    {
        //Initialiser un tableau associatif $data vide.
        $data = [];
        //Récupérer les jeux dans $games grâce à GameRepository::findAllGames().
        $games = $this->gameRepository->findAllGames();
        //Ajouter la liste des jeux à $data['games'].
        $data["games"] = $games;
        //Afficher le template template_show_all_games.php avec render(), son titre et $data.
        return $this->render("show_all_games", "Liste des jeux", $data);
    }
}
