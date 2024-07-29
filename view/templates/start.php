<?php
require '../vendor/autoload.php';
use App\dbManager\DBManager;
use App\Auth;

session_start();

if (!isset($_SESSION['user_details']['id']))
{
    echo "User not logged in.";
    exit;
}

$pdo = DBManager::pdoConnexion();
$auth = new Auth($pdo);
$userDetails = $auth->getUser();

?>

<div class="container mt-5">
        <h1 class="text-center">Bonjour <?php echo htmlspecialchars($userDetails->pseudo); ?>, tu peux commencer en cliquant sur le bouton</h1>
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Prêt à commencer?</h5>
                        <form method="post" action="question-1">
                            <button type="submit" class="btn btn-primary">Commencer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
