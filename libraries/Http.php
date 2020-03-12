<?php



/**
 * Http:  ce fichier me permet de faire des requêtes http, travailler sur les sessions, 
 * les redirections  récupérer des paremètres en get ou en post
 */
class Http
{

    /**
     * redirect:  fonction pour rediriger à chaque fois l'utilisateur qui est sur la page.
     *
     * @param  mixed $url
     * @return void
     */
    public  static function redirect(String $url): void
    {
        header("location: $url");
        exit();
    }
}
