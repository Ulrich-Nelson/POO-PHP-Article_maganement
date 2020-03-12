<?php



/**
 * Application:  cette classe va representer notre application, ou notre bloc. On va définir 
 * le controleur que l'on veut appéler mais aussi la tâche que l'on souhaite faire.
 */
class Application
{
    public static function process()
    {
        $controllerName = "Article";  //$controllerName = "Article"; On appelle le controlleur
        $task = "index";               // $task = "index";  On appelle le task en question

        //s'il n'est pas vide alors
        if (!empty($_GET['controller'])) {
            // ceci vet dire que si j'ai en GET => article, je veux que cela se transforme en Article
            $controllerName = ucfirst($_GET['controller']);
        }
        // on gère le contrôleur mais on n'a pas besoin de faire un traitement
        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }
        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
}
