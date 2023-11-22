<?php
include("Conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $titlu = htmlentities($_POST['titlu'], ENT_QUOTES);
            $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
            $ora = htmlentities($_POST['ora'], ENT_QUOTES);
            $idagenda = htmlentities($_POST['idagenda'], ENT_QUOTES);
            

            if ($titlu == '' || $descriere == '' || $ora == '' || $idagenda == '') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE evenimente SET titlu=?, descriere=?, ora=?, idagenda=? WHERE id='".$id."'")) {
                    $stmt->bind_param("sssi", $titlu, $descriere, $ora, $idagenda);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        } else {
            echo "id incorect!";
        }
    }
}
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

<h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>

<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
} ?>

<form action="" method="post">
    <div>
        <?php if ($_GET['id'] != '') { ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
            <p>ID: <?php echo $_GET['id'];
                if ($result = $mysqli->query("SELECT * FROM evenimente where id='".$_GET['id']."'")) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_object(); ?></p>
                        <strong>Titlu: </strong> <input type="text" name="titlu" value="<?php echo $row->titlu; ?>"/><br/>
                        <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo $row->descriere; ?>"/><br/>
                        <strong>Ora: </strong> <input type="time" name="ora" value="<?php echo $row->ora; ?>"/><br/>
                        <strong>Id Agenda: </strong> <input type="text" name="idagenda" value="<?php echo $row->idagenda; ?>"/><br/>
                        <br/>
                        <input type="submit" name="submit" value="Submit" />
                        <a href="evenimente.php">Index</a>
                <?php }
                }
            }
        ?>
    </div>
</form>
</body>
</html>
