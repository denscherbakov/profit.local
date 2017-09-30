<?php

namespace App\Controllers;

use App\Controller;
use App\Error404;
use App\Model\Article;

class Index extends Controller
{
    protected $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates/');
        $this->twig = new \Twig_Environment($loader);
    }

    public function actionAll()
    {
        $template = $this->twig->loadTemplate('index.php');

        $news = Article::findAll();
        $title = 'Twig work';

        echo $template->render(['title' => $title, 'news' => $news]);
    }

    public function actionOne($id)
    {
        $template = $this->twig->loadTemplate('article.php');

        $article = Article::findById($id);

        if (false === $article){
            throw new Error404('Ошибка 404 - не найдено');
        }

        $title = 'Twig work';

        echo $template->render(['title' => $title, 'article' => $article]);
    }
}