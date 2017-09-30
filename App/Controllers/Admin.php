<?php

namespace App\Controllers;

use App\Controller;
use App\Model\Article;
use App\MultiException;

class Admin extends Controller
{
    public function actionAll()
    {
        $news = Article::findAll();
        $this->view->news = $news;
        $this->view->display(__DIR__ . '/../../templates/admin.php');
    }

    public function actionUpdate($id)
    {
        $article = Article::findById((int)$id);
        if (count($_POST) > 0) {
            $article->fill($_POST);
            if (false !== $article->save()) {
                header('Location: /admin');
                exit;
            }
        }
        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../../templates/edit_form.php');
    }

    public function actionSave()
    {
        if (count($_POST) > 0) {
            $article = new Article();
            $article->title = trim($_POST['title']);
            $article->text = trim($_POST['text']);
            $article->author_id = (int)$_POST['author'];

            if (false !== $article->save()) {
                header('Location: /admin');
                exit;
            }
        }
        $this->view->display(__DIR__ . '/../../templates/edit_form.php');
    }

}