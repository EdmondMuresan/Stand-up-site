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
    <h1>Inregistrarile din tabela datepers</h1>
<p><b>Toate inregistrarile din datepers</b</p>
<?php
// connectare bazadedate
include("Conectare.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM utilizator ORDER BY id "))
{ // Afisare inregistrari pe ecran
if ($result->num_rows > 0)
{
// afisarea inregistrarilor intr-o table
echo "<table border='1' cellpadding='10'>";
// antetul tabelului
echo "<tr><th>ID</th><th>Nume</th><th>Prenume</th><th>Parola</th><th>Username</th><th>Telefon</th><th>Email</th><th></th><th></th></tr>";
while ($row = $result->fetch_object())
{
// definirea unei linii pt fiecare inregistrare
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->nume . "</td>";
echo "<td>" . $row->prenume . "</td>";
echo "<td>" . $row->password . "</td>";
echo "<td>" . $row->username . "</td>";
echo "<td>" . $row->telefon . "</td>";
echo "<td>" . $row->email . "</td>";
echo "<td><a href='loginmodificare.php?id=" . $row->id . "'>Modificare</a></td>";
echo "<td><a href='loginstergere.php?id=" .$row->id . "'>Stergere</a></td>";
echo "</tr>";
}
echo "</table>";
}
// daca nu sunt inregistrari se afiseaza un rezultat de eroare
else
{
echo "Nu sunt inregistrari in tabela!";
}
}
// eroare in caz de insucces in interogare
else
{ echo "Error: " . $mysqli->error(); }
// se inchide
$mysqli->close();
?>
<a href="logininserare.php">Adaugarea unei noi inregistrari</a>
</body>
</html>