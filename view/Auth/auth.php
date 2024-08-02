<?php
require '../vendor/autoload.php';

use League\OAuth2\Client\Provider\GenericProvider;
use App\dbManager\DBManager;
use App\Auth;

session_start();

$uid = getenv('UUID_42');
$secret = getenv('SECRET_42');

$provider = new GenericProvider([
    'clientId'                => $uid,
    'clientSecret'            => $secret,
    'urlAuthorize'            => 'https://api.intra.42.fr/oauth/authorize',
    'urlAccessToken'          => 'https://api.intra.42.fr/oauth/token',
    'urlResourceOwnerDetails' => 'https://api.intra.42.fr/v2/me',
    'redirectUri'             => 'http://localhost:80'
]);

if (!isset($_GET['code'])) {
    $authorizationUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authorizationUrl);
    exit;
} elseif (!isset($_GET["state"]) || empty($_GET["state"]) || ($_GET["state"] !== $_SESSION["oauth2state"])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {
    try {
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        $resourceOwner = $provider->getResourceOwner($accessToken);
        $userDetails = $resourceOwner->toArray();

        $_SESSION['user_details']['id'] = $userDetails['id'];

        $request = $provider->getAuthenticatedRequest(
            'GET',
            'https://api.intra.42.fr/v2/users/'. $userDetails['id'] .'/coalitions/',
            $accessToken
        );
        
        $response = $provider->getResponse($request);
        $coalitionDetails = json_decode($response->getBody(), true);

        $pdo = DBManager::pdoConnexion();
        $auth = new Auth($pdo);
        $auth->registerUser($userDetails['id'], $userDetails['login'], $userDetails['image']['link'], $coalitionDetails[0]['name'], -1);

        header('Location: /start');
        exit;

    } catch (Exception $e) {
        exit($e->getMessage());
    }
}
