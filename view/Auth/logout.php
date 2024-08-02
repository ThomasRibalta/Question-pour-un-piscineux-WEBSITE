<?php

require '../vendor/autoload.php';
use App\dbManager\DBManager;
use App\Auth;

session_start();

$pdo = DBManager::pdoConnexion();
$auth = new Auth($pdo);

if (!isset($_SESSION['user_details']['id']))
{
    header('Location: /');
    exit;
}

$auth->updateScore($auth->getUser()->id, -1);
$_SESSION['question'] = NULL;

header('Location: /');