<?php
require '../vendor/autoload.php';
use App\Auth;
use App\dbManager\QuestionTable;
use App\dbManager\DBManager;
use App\Helper\CorrectionHelper;
use App\Helper\QuestionFormat;

session_start();

$pdo = DBManager::pdoConnexion();
$auth = new Auth($pdo);
$question = new QuestionTable($pdo);
$userDetails = $auth->getUser();

if (!isset($_SESSION['question']) && (int)$params["id"] == 1 && $userDetails->score == -1) {
  $_SESSION['question'] = 1;
  $auth->updateScore($userDetails->id, 1);
  $userDetails->score = 0;
}
else if ((int)$params["id"] != $_SESSION['question'] + 1 || ($userDetails->score != -1 && (int)$params["id"] == 1)) {
  header('Location: /start');
  exit;
}
else {
  $questions = $question->getQuestionsSortedByValue();
  $question->getResponseById($questions[((int)$params["id"]) - 2]->id);
  if (CorrectionHelper::correct($_POST['reponse'], $question->getResponseById($questions[((int)$params["id"]) - 2]->id), $question->getCountCorrectResponse($questions[((int)$params["id"]) - 2]->id)) == true) {
    $auth->updateScore($auth->getUser()->id, $questions[((int)$params["id"]) - 2]->value);
    $userDetails->score += $questions[((int)$params["id"]) - 2]->value;
  }
  if ((int)$params["id"] > $question->getCountQuestions()) {
    header('Location: /classement');
    exit;
  }
  $_SESSION['question'] = (int)$params["id"];
}


$questions = $question->getQuestionsSortedByValue();
$reponses = $question->getResponseById($questions[((int)$params["id"]) - 1]->id);
$nCorrect = $question->getCountCorrectResponse($questions[((int)$params["id"]) - 1]->id);

$formatQuestion = new QuestionFormat($reponses, $nCorrect);

$MaxScore = QuestionFormat::sumScore($questions);

if (!isset($_SESSION['user_details']['id'])) {
    echo "User not logged in.";
    exit;
}

?>
<style>
        .score-box {
            background-color: gray;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin: 10px;
        }
</style>

<nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Question pour un piscineu </span>
            <div class="ml-auto score-box">
                <?php echo $userDetails->score?>/<?php echo $MaxScore; ?>
            </div>
        </div>
</nav>
<div class="container mt-5">
        <h1 class="text-center">Question n°<?php echo $params["id"]?></h1>
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Voici la question (+<?= $questions[((int)$params["id"]) - 1]->value?> point(s)):</h5>
                        <p class="card-text"><?php echo $questions[((int)$params["id"]) - 1]->question ?></p>
                        <form method="post" action="question-<?php echo $params["id"] + 1?>">
                            <?php $formatQuestion->toHtml(); ?>
                            <button type="submit" class="btn btn-primary mt-3">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
