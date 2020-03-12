<?php

/**
 * Database: permet d'établir la connexion à la base de données.
 */
class Database
{
    private static $instance = null;
    /**
     * getPdo:  fonction static pour la connexion à la base de données.
     *
     * @return PDO
     */
    public  static function getPdo(): PDO
    {
        if (self::$instance === null) {
            self::$instance = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        return self::$instance;
    }
}
/* dans cette fonction on déclare une instance qui au départ est null. Ensuite si ma propriété instance qui est 
dans ma classe est null alors je créais une nouvelle instance de PDO. Donc ici PDO ne sra instancier une
seule fois, et pour la suite il ne le sera plus. Donc on aura une seule connexion à la fois*/
