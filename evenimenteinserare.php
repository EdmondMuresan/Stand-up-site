<?php
include("Conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
$titlu = htmlentities($_POST['titlu'], ENT_QUOTES);
$descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
$ora = htmlentities($_POST['ora'], ENT_QUOTES);
$idagenda = htmlentities($_POST['idagenda'], ENT_QUOTES);
// verificam daca sunt completate
if ($titlu == '' || $descriere == ''||$ora==''||$idagenda=='')
{
// daca sunt goale se afiseaza un mesaj
$error = 'ERROR: Campuri goale!';
} else {
// insert
if ($stmt = $mysqli->prepare("INSERT into evenimente (titlu, descriere, ora, idagenda) VALUES (?, ?, ?, ?)"))
{
$stmt->bind_param("sssi", $titlu, $descriere, $ora, $idagenda);
$stmt->execute();
$stmt->close();
}
// eroare le inserare
else
{
echo "ERROR: Nu se poate executa insert.";
}
}
}
// se inchide conexiune mysqli
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HaHaTickets</title>
    <link rel="stylesheet" href="index.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <div id="Menubar">
        <ul id="horizontalList">
            <li><a href="Acasa.php">Acasă</a></li>
            <li><a href="agenda.php">Agendă</a></li>
            <li><a href="evenimente.php">Evenimente</a></li>
            <li><a href="artisti.php">Artisti</a></li>
            <li><a href="bilete.php">Bilete</a></li>
            <li><a href="sponsori.php">Sponsori</a>
            <li><a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a><li></li>
            
        </ul>
    </div>
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>
<strong>Titlu: </strong> <input type="text" name="titlu" value=""/><br/>
<strong>Descriere: </strong> <input type="text" name="descriere" value=""/><br/>
<strong>Ora: </strong> <input type="time" name="ora" value=""/><br/>
<strong>Id Agenda: </strong> <input type="text" name="idagenda" value=""/><br/>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="evenimente.php">Index</a>
</div>
</form>
</body>
</html>