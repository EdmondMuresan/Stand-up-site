<?php
include("Conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
$data = htmlentities($_POST['data'], ENT_QUOTES);

// verificam daca sunt completate
if ($data == '')
{
// daca sunt goale se afiseaza un mesaj
$error = 'ERROR: Campuri goale!';
} else {
// insert
if ($stmt = $mysqli->prepare("INSERT into agenda (data) VALUES (?)"))
{
$stmt->bind_param("s", $data);
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
            <li><a href="artisti.php">Artiști</a></li>
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
<strong>Data: </strong> <input type="date" name="data" value=""/><br/>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="agenda.php">Index</a>
</div>
</form>
</body>
</html>