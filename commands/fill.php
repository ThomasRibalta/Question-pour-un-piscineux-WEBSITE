<?php

// Informations de connexion à la base de données
$servername = "127.0.0.1";
$username = "root";
$password = "root";

// Création de la connexion
$conn = new mysqli($servername, $username, $password);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Création de la base de données "test"
$sql = "CREATE DATABASE IF NOT EXISTS 42Quizz";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

// Sélection de la base de données "test"
$conn->select_db("42Quizz");



// Création de la table "table1"
$sql = "CREATE TABLE IF NOT EXISTS users (
    id  VARCHAR(255),
    pseudo VARCHAR(8) NOT NULL,
    img_url VARCHAR(255) NOT NULL,
    coalition VARCHAR(255) NOT NULL,
    score INT(11) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'table1' created successfully\n";
} else {
    echo "Error creating table 'table1': " . $conn->error . "\n";
}



// Création de la table "table2"
$sql = "CREATE TABLE IF NOT EXISTS questions (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    value int(11) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'table2' created successfully\n";
} else {
    echo "Error creating table 'table2': " . $conn->error . "\n";
}



// Création de la table "table3"
$sql = "CREATE TABLE IF NOT EXISTS reponse (
    id_question INT(11) NOT NULL,
    reponse VARCHAR(255) NOT NULL,
    correcte BOOLEAN NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'table3' created successfully\n";
} else {
    echo "Error creating table 'table3': " . $conn->error . "\n";
}



// fill questions table
$nomFichier = 'questionnaire_formated.txt';

// Ouvrir le fichier en mode lecture
$fichier = fopen($nomFichier, 'r');

$id = 0;

if ($fichier) {

    while (($ligne = fgets($fichier)) !== false) {

        echo "ligne :" . $ligne . " strpos " . strpos($ligne, '-') . "\n";
        if (strpos($ligne, '-') === 1) {
            echo "question :" . $ligne . "\n";
            $question = $conn->real_escape_string(substr($ligne, 2));
            $value = 1;
            $sql = "INSERT INTO questions (question, value) VALUES ('$question', '$value')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully\n";
                $id = $conn->insert_id;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $reponse = $conn->real_escape_string(substr($ligne, 1));
            $correcte = $ligne[0];
            echo "reponse :" . $reponse . " " . $correcte . "\n";
            $sql = "INSERT INTO reponse (id_question, reponse, correcte) VALUES ($id, '$reponse', $correcte)";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully\n";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    fclose($fichier);
} else {
    echo "Impossible d'ouvrir le fichier.";
}

// Fermeture de la connexion
$conn->close();
?>
