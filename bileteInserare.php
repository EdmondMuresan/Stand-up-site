<?php
include("Conectare.php");
$error = '';

if (isset($_POST['submit'])) {
    // preluam datele de pe formular
    $pret = htmlentities($_POST['pret'], ENT_QUOTES);
    $titlu = htmlentities($_POST['titlu'], ENT_QUOTES);
    $idutilizator = htmlentities($_POST['idutilizator'], ENT_QUOTES);
    $idevenimente = htmlentities($_POST['idevenimente'], ENT_QUOTES);

    // verificam daca sunt completate
    if ($pret == '' || $titlu == '' || $idutilizator == '' || $idevenimente == '') {
        // daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
        // insert
        if ($stmt = $mysqli->prepare("INSERT INTO bilete (pret, titlu, idutilizator, idevenimente) VALUES (?, ?, ?, ?)")) {
            $stmt->bind_param("isii", $pret, $titlu, $idutilizator, $idevenimente);
            $stmt->execute();
            $stmt->close();
        } else {
            // eroare la inserare
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}

// se inchide conexiune mysqli
$mysqli->close();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
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
            <li><a href="bileteVizualizare.php">Bilete</a></li>
            <li><a href="sponsori.php">Sponsori</a></li>
            <li><a href="utilizatori.php">Login/Sign-up</a></li>
        </ul>
    </div>
    <h1><?php echo "Inserare inregistrare"; ?></h1>

    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>

    <form action="" method="post">
        <div>
            <strong>Pret: </strong> <input type="text" name="pret" value=""/><br/>
            <strong>Titlu: </strong> <input type="text" name="titlu" value=""/><br/>
            <strong>ID Utilizator: </strong> <input type="text" name="idutilizator" value=""/><br/>
            <strong>ID Evenimente: </strong> <input type="text" name="idevenimente" value=""/><br/>
            <br/>
            <input type="submit" name="submit" value="Submit" />
            <a href="bileteVizualizare.php">Index</a>
        </div>
    </form>
</body>
</html>
