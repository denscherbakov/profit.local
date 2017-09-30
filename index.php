<?php

require_once __DIR__ . '/autoload.php';

$parts = explode('/', $_SERVER['REQUEST_URI']);

$ctrlRequest = !empty($parts[1]) ? $parts[1] : 'Index';
$ctrlClassName = '\App\Controllers\\' . $ctrlRequest;
$ctrl = new $ctrlClassName;

$actRequest = !empty($parts[2]) ? $parts[2] : 'All';

$idRequest = !empty($parts[3]) ? $parts[3] : null;

$actMethodName = $ctrl->action($actRequest);

try {
    $ctrl->$actMethodName($idRequest);
} catch (Exception $e){

    $loader = new \Twig_Loader_Filesystem(__DIR__ . '/templates/');
    $twig = new \Twig_Environment($loader);

    $template = $twig->loadTemplate('error.php');

    \App\Logger::add($e);
    $error = $e->getMessage();

    echo $template->render(['error' => $error]);
}

