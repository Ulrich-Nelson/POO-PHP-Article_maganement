<?php

namespace Controllers;


/**
 * Article : classe qui traite les informations liées aux articles.
 */
class Article extends Controller
{
    protected $modelName = \Models\Article::class;

    /**
     * index :elle permet d'afficher la liste des articles.
     *
     * @return void
     */
    public function index()
    {
        $articles = $this->model->findAll("created_at DESC");
        $pageTitle = "Accueil";
        \Renderer::render('articles/index', compact('pageTitle', 'articles'));
    }

    /**
     * show : affiche un article et les commentaires associés.
     *
     * @return void
     */
    public function show()
    {
        $commentModel = new \Models\Comment();

        $article_id = null;
        // Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        // On peut désormais décider : erreur ou pas ?!
        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }

        $article = $this->model->find($article_id);

        $commentaires = $commentModel->findAllComments($article_id);

        $pageTitle = $article['title'];

        \Renderer::render('articles/show', compact('pageTitle', 'article', 'commentaires', 'article_id'));
    }


    /**
     * delete : supprime un article et redirige l'utilisateur sur la liste des articles.
     *
     * @return void
     */
    public function delete()
    {
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ?! Tu n'as pas précisé l'id de l'article !");
        }

        $id = $_GET['id'];

        $article = $this->model->find($id);
        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }
        $this->model->delete($id);
        \Http::redirect("Location: index.php");
    }
}
