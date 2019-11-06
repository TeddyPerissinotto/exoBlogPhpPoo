<?php

require_once ('libraries/models/Model.php');

class Article extends Model {

    //retourne la liste des articles par date de création.
    public function findAll() : array {
        // On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
        $resultats = $this->pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
// On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();

        return $articles;
    }

    public function find(int $id) : array {
        $query = $this->pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
// On exécute la requête en précisant le paramètre :article_id
        $query->execute(['article_id' => $id]);
// On fouille le résultat pour en extraire les données réelles de l'article
        $article = $query->fetch();

        return $article;
    }

    function delete(int $id) : void {
        $query = $this->pdo->prepare('DELETE FROM articles WHERE id = :id');
        $query->execute(['id' => $id]);
    }

}

?>