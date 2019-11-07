<?php

require_once ('libraries/database.php');

class Model {

    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = getPdo();
    }

    //retourne la liste des articles par date de création.
    public function findAll(string $order = "") : array
    {
        $sql = "SELECT * FROM {$this->table}";
        // On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
        $resultats = $this->pdo->query();
// On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();

        return $articles;
    }

    public function find(int $id) : array {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
// On exécute la requête en précisant le paramètre :article_id
        $query->execute(['id' => $id]);
// On fouille le résultat pour en extraire les données réelles de l'article
        $item = $query->fetch();

        return $item;

    }

    function delete(int $id) : void {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

}

?>