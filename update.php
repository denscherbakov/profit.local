<?php

require __DIR__ . '/autoload.php';

$article = new \App\Model\Article();

$article->id = (int)$_GET['id'];

if (count($_POST) > 0) {
    $article->title = trim($_POST['title']);
    $article->text = trim($_POST['text']);
    $article->author = trim($_POST['author']);

    if (false !== $article->save()) {
        header('Location: /index.php');
        exit;
    }
}

$view = new \App\View();
$view->assign('article', \App\Model\Article::findById($article->id));
$view->display(__DIR__ . '/templates/edit_form.php');