<?php 

// 42 min
// -2 min mauvais reponse
// add text input

require '../vendor/autoload.php';
use App\Auth;
use App\dbManager\DBManager;

session_start();

$pdo = DBManager::pdoConnexion();
$auth = new Auth($pdo);
$userDetails = $auth->getUser();

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
                    <p>Points: 100</p>
                </div>
                <table class="table table-light table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Joueur</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Joueur 1</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>Joueur 2</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>Joueur 3</td>
                            <td>50</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Team Yellow -->
            <div class="col-md-6 team-yellow">
                <div class="team-header">
                    <h2>Stack</h2>
                    <p>Points: 120</p>
                </div>
                <table class="table table-light table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Joueur</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Joueur A</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td>Joueur B</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>Joueur C</td>
                            <td>50</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>