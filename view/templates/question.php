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

if (!isset($_SESSION['question']) && (int)$params["id"] == 1 && $userDetails->score == -1)
{
  $_SESSION['question'] = 1;
  $auth->updateScore($userDetails->id, 1);
  $userDetails->score = 0;
  $_SESSION['timer'] = time() + (42 * 60);
}
else if ((int)$params["id"] != $_SESSION['question'] + 1 || ($userDetails->score != -1 && (int)$params["id"] == 1))
{
  header('Location: /start');
  exit;
} 
else if ((int)$params["id"] > $question->getCountQuestions())
{
    header('Location: /classement');
    exit;
}
else if (!isset($_SESSION['user_details']['id']))
{
    header('Location: /');
    exit;
}

$_SESSION['question'] = (int)$params["id"];

$questions = $question->getQuestionsSortedByValue();
if ((int) $params["id"] != 1)
{
  $reponses = $question->getResponseById($questions[((int)$params["id"]) - 2]->id);
  $nCorrect = $question->getCountCorrectResponse($questions[((int)$params["id"]) - 2]->id);
}

if (isset($_POST['reponse']) && CorrectionHelper::correct($_POST['reponse'], $reponses, $nCorrect) == TRUE)
{
    $auth->updateScore($auth->getUser()->id, $questions[((int)$params["id"]) - 1]->value);
    $userDetails->score += $questions[((int)$params["id"]) - 1]->value;
}
else
{
    if ((int)$params["id"] != 1)
    {
      $_SESSION['timer'] = $_SESSION['timer'] - 120;
      $erreur = "Réponse incorrecte, ne lache pas l'affaire ! (-2 minutes)";
      if ($_SESSION['timer'] <= time())
      {
            header('Location: /classement');
            exit;
      }
    }
}

$reponses = $question->getResponseById($questions[((int)$params["id"]) - 1]->id);
$nCorrect = $question->getCountCorrectResponse($questions[((int)$params["id"]) - 1]->id);

$formatQuestion = new QuestionFormat($reponses, $nCorrect);

$MaxScore = QuestionFormat::sumScore($questions);

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

<?php if (isset($erreur)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $erreur ?>
    </div>
<?php elseif (!isset($erreur) && (int) $params["id"] != 1): ?>
    <div class="alert alert-success" role="alert">
        Réponse correcte, tu as vraiment était bon !
    </div>
<?php endif ?>

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex justify-content-between">
        <span class="display-time"></span>
        <span class="navbar-brand mb-0 h1 mx-auto">Question pour un piscineux</span>
        <div class="score-box">
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

<script>
        let countdown;
        let timerDisplay;
        let timerDuration = <?php echo $_SESSION['timer'] - time() ?>;

        window.onload = function() {
            timerDisplay = document.querySelector('.display-time');
            startTimer(timerDuration);
        };

        function startTimer(seconds) {
            clearInterval(countdown);
            const now = Date.now();
            const then = now + seconds * 1000;
            displayTimeLeft(seconds);
            countdown = setInterval(() => {
                const secondsLeft = Math.round((then - Date.now()) / 1000);
                if (secondsLeft < 0) {
                    clearInterval(countdown);
                    window.location.href = "/classement";
                    return;
                }
                displayTimeLeft(secondsLeft);
            }, 1000);
        }

        function displayTimeLeft(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainderSeconds = seconds % 60;
            const display = `${minutes}:${remainderSeconds < 10 ? '0' : ''}${remainderSeconds}`;
            timerDisplay.textContent = display;
        }
</script>
