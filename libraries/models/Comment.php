<?php

//require_once("libraries/Database.php"); plus besoin de ce dernier car je n'utilise plus la fonction getpdo
namespace Models;

require_once('libraries/autoload.php');


/**
 * Comment: traite les informations liés aux commentaires sur un article.
 * elle hérite de la classe "ModelAll".
 */
class Comment extends ModelAll
{
    protected $table = "comments";


    /**
     * findAllComments: recupère les commentaires d'un article.
     *
     * @param   $id est l'identifiant de l'article dont on veut récupérer les commentaire
     * @return void
     */
    public function findAllComments(int $id)
    {

        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $id]);
        $commentaires = $query->fetchAll();

        return $commentaires;
    }

    /**
     * insertComment permet à un utilisateur d'insérer les commentaires.
     *
     * @param  mixed $author (exple: $author = nelson)
     * @param  mixed $content (exple: $content = ajouter les commentaires)
     * @param  mixed $article_id (exple: $article_id = l'identifiant de l'article)
     * @return void
     */
    public function insertComment(string $author, string $content, int $article_id): void
    {

        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}
