<?php
include("Conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
$nume = htmlentities($_POST['nume'], ENT_QUOTES);
$prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
$password = htmlentities($_POST['password'], ENT_QUOTES);
$username = htmlentities($_POST['username'], ENT_QUOTES);
$telefon = htmlentities($_POST['telefon'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
// verificam daca sunt completate
if ($nume == '' || $prenume == ''||$password==''||$username==''||$telefon==''||$email=='')
{
// daca sunt goale se afiseaza un mesaj
$error = 'ERROR: Campuri goale!';
} else {
// insert
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);
if ($stmt = $mysqli->prepare("INSERT into utilizator (nume, prenume, password, username, telefon,
email) VALUES (?, ?, ?, ?, ?, ?)"))
{
$stmt->bind_param("ssssss", $nume, $prenume,$password,$username,$telefon,$email);
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
<strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>
<strong>Prenume: </strong> <input type="text" name="prenume" value=""/><br/>
<strong>Password: </strong> <input type="password" name="password" value=""/><br/>
<strong>Username: </strong> <input type="text" name="username" value=""/><br/>
<strong>Telefon: </strong> <input type="text" name="telefon" value=""/><br/>
<strong>Email: </strong> <input type="text" name="email" value=""/><br/>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="login.php">Index</a>
</div></form></body></html>  