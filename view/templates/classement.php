<?php 
require '../vendor/autoload.php';
use App\Auth;
use App\dbManager\DBManager;

session_start();

$pdo = DBManager::pdoConnexion();
$auth = new Auth($pdo);
$userDetails = $auth->getUser();
