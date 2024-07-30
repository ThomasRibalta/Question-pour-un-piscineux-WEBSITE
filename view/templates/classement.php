<?php 

require '../vendor/autoload.php';
use App\Auth;
use App\Helper\Classement;
use App\dbManager\DBManager;

session_start();

$pdo = DBManager::pdoConnexion();
$auth = new Auth($pdo);
$userDetails = $auth->getUser();

$classement = new Classement($pdo);
$laHeap = $classement->getLaHeap();
$laStack = $classement->getLaStack();
$laHeapScore = $classement->getLaHeapScore();
$laStackScore = $classement->getLaStackScore();

?>

<style>
        .team-orange {
            background-image: url("https://cdn.intra.42.fr/coalition/cover/376/Heap_background_3_low.jpg");
            background-size: cover;
            color: white;
            text-align: center;
        }
        .team-yellow {
            background-image: url("https://cdn.intra.42.fr/coalition/cover/377/stack_background_2.jpg");
            background-size: cover;
            color: white;
            text-align: center;
        }
        .team-header {
            padding: 20px;
        }
    </style>

<div class="container-fluid">
        <div class="row">
            <!-- Team Orange -->
            <div class="col-md-6 team-orange">
                <div class="team-header">
                    <h2>Heap</h2>
                    <p>Points: <?= $laHeapScore?></p>
                </div>
                <table class="table table-light table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Joueur</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($laHeap as $user): ?>
                        <tr>
                            <td><?= $user->pseudo ?></td>
                            <td><?= $user->score ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Team Yellow -->
            <div class="col-md-6 team-yellow">
                <div class="team-header">
                    <h2>Stack</h2>
                    <p>Points: <?= $laStackScore?></p>
                </div>
                <table class="table table-light table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Joueur</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($laStack as $user): ?>
                        <tr>
                            <td><?= $user->pseudo ?></td>
                            <td><?= $user->score == -1 ? 0 : $user->score ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>