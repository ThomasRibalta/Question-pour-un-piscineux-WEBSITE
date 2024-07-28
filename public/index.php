<?php

$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($autoloadPath)) {
    die('Autoload file not found. Please run "composer install".');
}

require $autoloadPath;
use App\Router;

define("DEBUG_TIME", microtime(true));

$router = new Router(dirname(__DIR__) . '/view');
$router->get('/', '/Auth/auth.php', 'Auth')
        ->get('/start', '/templates/start.php', 'Start')
        ->post('/question-[i:id]', '/templates/question.php', 'Question')
        ->get('/classement', '/templates/classement.php', 'Classement')
        ->get('/logout', '/Auth/logout.php', 'Logout')
        ->start();
