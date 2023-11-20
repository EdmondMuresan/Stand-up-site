<?php
include("Conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
$nume = htmlentities($_POST['nume'], ENT_QUOTES);
$suma = htmlentities($_POST['suma'], ENT_QUOTES);
$CIF = htmlentities($_POST['CIF'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$idevenimente = htmlentities($_POST['idevenimente'], ENT_QUOTES);
// verificam daca sunt completate
if ($nume == '' || $suma == ''||$CIF==''||$email==''||$idevenimente=='')
{
// daca sunt goale se afiseaza un mesaj
$error = 'ERROR: Campuri goale!';
} else {
// insert
if ($stmt = $mysqli->prepare("INSERT into parteneri (nume, suma, CIF, email, idevenimente) VALUES (?, ?, ?, ?, ?)"))
{
$stmt->bind_param("sissi", $nume, $suma,$CIF,$email,$idevenimente);
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
            <li><a href="Acasa.html">Acasă</a></li>
            <li><a>Agendă</a></li>
            <li><a>Evenimente</a></li>
            <li><a>Artiști</a></li>
            <li><a>Bilete</a></li>
            <li><a href="sponsori.php">Sponsori</a></li>
    <li><a href="utilizatori.php">Login/Sign-up</a></li>
        </ul>
    </div>
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>
<strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>
<strong>Suma: </strong> <input type="text" name="suma" value=""/><br/>
<strong>CIF: </strong> <input type="text" name="CIF" value=""/><br/>
<strong>E-mail: </strong> <input type="text" name="email" value=""/><br/>
<strong>IDevenimente: </strong> <input type="text" name="idevenimente" value=""/><br/>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="sponsori.php">Index</a>
</div>
</form>
</body>
</html>