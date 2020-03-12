<?php

namespace Models;
/*
Ce fichie contient le B-A BA du model, donc la classe qui contient de tout ce que les models auront besoin
donc tout ce qui est commun*/


/**
 * ModelAll comme mon model est juste une répresentation pour être utilisé, je peux mettre le mot
 *  abstract pouqu'il ne soit pas instancier comme la classe Article ou la classe Comment.
 */
abstract class ModelAll
{
    protected $pdo;
    protected $table; // table à appeler

    /**
     * __construct perment d'instancier automatiquement la fonction "getPdo" de la classe Database
     * pour instancier la connexion à la base de données.
     * @return void
     */

    public function __construct()
    { //le slach à coté de mon Database précise que cette classe n'est pas dans ce fichier(namespace)
        $this->pdo = \Database::getPdo();
    }


    /**
     * find: cette fonction retrouve un article ou un commentaire en fonction de son id
     *
     * @param  mixed $id
     * @return void
     */
    public function find(int $id)
    {   // attention pour cette interpolation il faut des doubles guillemets.
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        $entity = $query->fetch();
        return $entity;
    }

    /**
     * delete supprime un article ou un commentaire à partir de son indetifiant.
     *
     * @param  mixed $id
     * @return void
     */
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    /**
     * findAll: recherche les articles ou les commentaires avec des précisons suppélementaires.
     *
     * @param  mixed $order
     * @return array les résultats sont retournés sous forme de tableau.
     */
    public function findAll(?string $order = ""): array
    {
        $sql = "SELECT * FROM {$this->table}";
        if ($order) {
            $sql .= " ORDER BY " . $order;
        }
        $resultats = $this->pdo->query($sql);
        $articles = $resultats->fetchAll();
        return $articles;
    }

    //Consolas, 'Courier New', monospace
}
