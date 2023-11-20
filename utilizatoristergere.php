<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HaHaTickets</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div id="Menubar">
        <ul id="horizontalList">
            <li><a href="Acasa.html">Acasă</a></li>
            <li><a>Agendă</a></li>
            <li><a>Evenimente</a></li>
            <li><a>Artisti</a></li>
            <li><a>Bilete</a></li>
            <li><a href="sponsori.php">Sponsori</a></li>
            <li><a href="utilizatori.php">Login/Sign-up</a></li>
        </ul>
    </div>
<?php
// conectare la baza de date database
include("Conectare.php");
// se verifica daca id a fost primit
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// preluam variabila 'id' din URL
$id = $_GET['id'];
// stergem inregistrarea cu ib=$id
if ($stmt = $mysqli->prepare("DELETE FROM utilizator WHERE id = ? LIMIT 1"))
{
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: Nu se poate executa delete.";
}
$mysqli->close();
echo "<div>Inregistrarea a fost stearsa!!!!</div>";
}
echo "<p><a href=\"utilizatori.php\">Index</a></p>";
?>