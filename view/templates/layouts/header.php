<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question pour un piscineux</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: rgb(41, 45, 57);
            padding: 10px 0;
            font-size: 20px;
        }
        .profile-picture {
            background-image: url('<?= $userDetails ? $userDetails->img_url : "https://t3.ftcdn.net/jpg/08/58/51/04/240_F_858510459_sF3Keim0gs3DKs6lA7beO1abE856CtRT.jpg" ?>');
            background-size: cover;
            background-position: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
        }
        .header .navbar-brand img {
            height: 70px;
            width: 70px;
        }
    </style>
</head>
    <nav class="navbar navbar-expand-lg navbar-dark header">
        <?php if (isset($_SESSION['user_details']['id'])) :?> 
        <a class="navbar-brand ml-5" href="https://profile.intra.42.fr/users/<?php echo $userDetails->pseudo?>">
            <div class="profile-picture"></div>
        </a>
        <?php endif ?>
        <a class="navbar-brand" href="#">
            <img src="assets/42logo.png" alt="Logo 42">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/start">Start</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/classement">Classement</a>
                </li>
            </ul>
        </div>
    </nav>
