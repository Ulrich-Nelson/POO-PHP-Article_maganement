<?php
// avec l'autoload je n'ai plus besoin de faire des requires car l'autoload va s'en charger.
namespace Controllers;


/**
 * Comment :  classe qui traite les informations liées aux Commentaires.
 */
class Comment extends Controller
{
    protected $modelName = \Models\Comment::class; //ou  "\Models\Comment()"

    /**
     * insert: permet à l'utilisateur d'ajouter des commentaires.
     *
     * @return void
     */
    public function insert()
    {
        $articleModel = new  \Models\Article();

        // On commence par l'author
        $author = null;
        if (!empty($_POST['author'])) {
            $author = $_POST['author'];
        }

        // Ensuite le contenu
        $content = null;
        if (!empty($_POST['content'])) {
            // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
            $content = htmlspecialchars($_POST['content']);
        }

        // Enfin l'id de l'article
        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }
        if (!$author || !$article_id || !$content) {
            die("Votre formulaire a été mal rempli !");
        }
        $article = $articleModel->find($article_id);
        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas boloss !");
        }
        $this->model->insertComment($author, $content, $article_id);

        \Http::redirect("index.php?controller=article&task=show&id=" . $article_id);
    }


    /**
     * delete : Permet de supprimer un commentaire lié à un article.
     *
     * @return void
     */
    public function delete()
    {
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ! Fallait préciser le paramètre id en GET !");
        }

        $id = $_GET['id'];

        /**
         * 3. Vérification de l'existence du commentaire
         */
        $commentaire = $this->model->find($id);
        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }
        /**
         * 4. Suppression réelle du commentaire
         * On récupère l'identifiant de l'article avant de supprimer le commentaire
         */
        $article_id = $commentaire['article_id'];
        $this->model->delete($id);
        \Http::redirect("index.php?controller=article&task=show?id=" . $article_id);
    }
}
