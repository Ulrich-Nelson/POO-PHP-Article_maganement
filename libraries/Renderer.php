<?php


/* dans cette classe nous avons la fonctions qui permet d'appeler une page lorsque le chemin est 
est passé en paramètre. donc pas besoin du page title. il faut aussi lui déclarer tableau qui doit prendre les 
variables que doit utiliser le fonction en question. ensuite il faut traiter ces variables avec extrat 
['var1'=> 2, 'var2' => 3]
var1 = 2
var2 = 3 */

/**
 * Renderer:  ce fichier me permet de faire du rendu des pages.
 */
class Renderer
{
    /**
     * render: fontion pour le rendu des pages.
     *
     * @param  mixed $path: le lien des pages
     * @param  mixed $variables: les variables associées à la page.
     * @return void
     */
    public  static function render(String $path, $variables  = [])

    {
        extract($variables);
        ob_start();
        require('templates/' . $path . '.html.php');
        $pageContent = ob_get_clean();

        require('templates/layout.html.php');
    }
}
