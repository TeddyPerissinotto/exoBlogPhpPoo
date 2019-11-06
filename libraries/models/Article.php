<?php

require_once ('libraries/database.php');

class Article {

    //retourne la liste des articles par date de création.
    public function findAllArticles() : array {
        $pdo = getPdo();
        // On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
        $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
// On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();

        return $articles;
    }

    public function findArticle(int $id) : array {
        $pdo = getPdo();
        $query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
// On exécute la requête en précisant le paramètre :article_id
        $query->execute(['article_id' => $id]);
// On fouille le résultat pour en extraire les données réelles de l'article
        $article = $query->fetch();

        return $article;
    }

    function deleteArticle(int $id) : void {
        $pdo = getPdo();
        $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
        $query->execute(['id' => $id]);
    }

}

?>