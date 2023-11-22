<?php
// connectare bazadedate
include("Conectare.php");

// Modificare datelor
// se preia id din pagina vizualizare
$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        // verificam daca id-ul din URL este unul valid
        if (isset($_POST['id']) && is_numeric($_POST['id'])) {
            // preluam variabilele din URL/form
            $id = $_POST['id'];
            $pret = htmlentities($_POST['pret'], ENT_QUOTES);
            $titlu = htmlentities($_POST['titlu'], ENT_QUOTES);
            $idutilizator = htmlentities($_POST['idutilizator'], ENT_QUOTES);
            $idevenimente = htmlentities($_POST['idevenimente'], ENT_QUOTES);

            // verificam daca numele, prenumele, an si grupa nu sunt goale
            if ($pret == '' || $titlu == '' || $idutilizator == '' || $idevenimente == '') {
                // daca sunt goale afisam mesaj de eroare
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                // daca nu sunt erori se face update name, code, image, price, descriere, categorie
                if ($stmt = $mysqli->prepare("UPDATE bilete SET pret=?,titlu=?,idutilizator=?,idevenimente=? WHERE id='".$id."'")) {
                    $stmt->bind_param("isii", $pret, $titlu, $idutilizator, $idevenimente);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    // mesaj de eroare in caz ca nu se poate face update
                    echo "ERROR: nu se poate executa update.";
                }
            }
        } else {
            // daca variabila 'id' nu este valida, afisam mesaj de eroare
            echo "id incorect!";
        }
    }
}

?>

<html>

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
    <h1><?php if (isset($_GET['id']) && $_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>

    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>

    <form action="" method="post">
        <div>
            <?php if (isset($_GET['id']) && $_GET['id'] != '') { ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
                <p>ID: <?php echo $_GET['id'];
                    if ($result = $mysqli->query("SELECT * FROM bilete where id='".$_GET['id']."'")) {
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_object();
                        ?>
                        </p>
                        <strong>Pret: </strong> <input type="text" name="pret" value="<?php echo$row->pret; ?>" /><br />
                        <strong>Titlu: </strong> <input type="text" name="titlu" value="<?php echo$row->titlu; ?>" /><br />
                        <strong>ID Utilizator: </strong> <input type="text" name="idutilizator" value="<?php echo$row->idutilizator; ?>" /><br />
                        <strong>ID Evenimente: </strong> <input type="text" name="idevenimente" value="<?php echo$row->idevenimente; ?>" /><br />
            <?php
                        }
                    }
                } ?>
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="bileteVizualizare.php">Index</a>
        </div>
    </form>
</body>

</html>
