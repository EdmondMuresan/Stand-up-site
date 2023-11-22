<?php
include("Conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $suma = htmlentities($_POST['suma'], ENT_QUOTES);
            $CIF = htmlentities($_POST['CIF'], ENT_QUOTES);
            $email = htmlentities($_POST['email'], ENT_QUOTES);
            $idevenimente = htmlentities($_POST['idevenimente'], ENT_QUOTES);

            if ($nume == '' || $suma == '' || $CIF == '' || $email == '' || $idevenimente == '') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE parteneri SET nume=?, suma=?, email=?, CIF=?, idevenimente=? WHERE id='".$id."'")) {
                    $stmt->bind_param("sissi", $nume, $suma, $email, $CIF, $idevenimente);
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
        <li><a>Agendă</a></li>
        <li><a>Evenimente</a></li>
        <li><a>Artiști</a></li>
        <li><a>Bilete</a></li>
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
                if ($result = $mysqli->query("SELECT * FROM parteneri where id='".$_GET['id']."'")) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_object(); ?></p>
                        <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo $row->nume; ?>"/><br/>
                        <strong>Suma: </strong> <input type="text" name="suma" value="<?php echo $row->suma; ?>"/><br/>
                        <strong>CIF: </strong> <input type="text" name="CIF" value="<?php echo $row->CIF; ?>"/><br/>
                        <strong>E-mail: </strong> <input type="text" name="email" value="<?php echo $row->email; ?>"/><br/>
                        <strong>IDevenimente: </strong> <input type="text" name="idevenimente" value="<?php echo $row->idevenimente; ?>"/><br/>
                        <br/>
                        <input type="submit" name="submit" value="Submit" />
                        <a href="sponsori.php">Index</a>
                <?php }
                }
            }
        ?>
    </div>
</form>
</body>
</html>
