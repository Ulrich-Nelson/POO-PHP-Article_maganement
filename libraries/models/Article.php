<?php

namespace Models;

//require_once("libraries/Database.php");
require_once("libraries/Models/ModelAll.php");


/**
 * Article: elle permet de définir la classe qui sera utiliser pour le traitement des
 * articles et elle hérite de la superbe classe "ModelAll".
 */
class Article extends ModelAll
{
    protected $table = "articles";
}
