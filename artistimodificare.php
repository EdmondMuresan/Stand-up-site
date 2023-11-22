<?php
include("Conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
            $telefon = htmlentities($_POST['telefon'], ENT_QUOTES);
            $email = htmlentities($_POST['email'], ENT_QUOTES);
            $salariul_orar = htmlentities($_POST['salariul_orar'], ENT_QUOTES);
            $idevenimente = htmlentities($_POST['idevenimente'], ENT_QUOTES);
            

            if ($nume == '' || $prenume == ''||$telefon==''||$email==''||$salariul_orar==''||$idevenimente=='') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE artisti SET nume=?, prenume=?, telefon=?, email=?, salariul_orar=?, idevenimente=? WHERE id='".$id."'")) {
                    $stmt->bind_param("ssssii", $nume, $prenume, $telefon, $email, $salariul_orar, $idevenimente);
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
                if ($result = $mysqli->query("SELECT * FROM artisti where id='".$_GET['id']."'")) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_object(); ?></p>
                        <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo $row->nume; ?>"/><br/>
                        <strong>Prenume: </strong> <input type="text" name="prenume" value="<?php echo $row->prenume; ?>"/><br/>
                        <strong>Telefon: </strong> <input type="text" name="telefon" value="<?php echo $row->telefon; ?>"/><br/>
                        <strong>Email: </strong> <input type="text" name="email" value="<?php echo $row->email; ?>"/><br/>
                        <strong>Salariul Orar: </strong> <input type="number" name="salariul_orar" value="<?php echo $row->salariul_orar; ?>"/><br/>
                        <strong>Id Evenimente: </strong> <input type="text" name="idevenimente" value="<?php echo $row->idevenimente; ?>"/><br/>

                        <br/>
                        <input type="submit" name="submit" value="Submit" />
                        <a href="artisti.php">Index</a>
                <?php }
                }
            }
        ?>
    </div>
</form>
</body>
</html>
