<?php
/* cette fonction permet de charger nos classes et prend en paramètre une classe
dans la suite il faut remplacer les slaches par un autre*/

spl_autoload_register(function ($className) {
    //className = Controllers\Article
    //require = libraries/controllers/Article.php;
    $className = str_replace("\\", "/", $className);
    require_once("libraries/$className.php");
});
