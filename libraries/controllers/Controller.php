<?php

namespace Controllers;

/**
 * Controller : permet d'instancier automatiquement le model à utiliser pour les classes.
 * chaque entité peut hériter de cette classe abstraite.
 */
abstract class Controller
{
    protected $model;
    protected $modelName;

    public function __construct()
    {
        $this->model = new $this->modelName();
    }
}
