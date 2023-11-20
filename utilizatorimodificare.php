<?php
include("Conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
            $password = htmlentities($_POST['password'], ENT_QUOTES);
            $username = htmlentities($_POST['username'], ENT_QUOTES);
            $telefon = htmlentities($_POST['telefon'], ENT_QUOTES);
            $email = htmlentities($_POST['email'], ENT_QUOTES);

            if ($nume == '' || $prenume == '' || $password == '' || $username == '' || $telefon == '' || $email == '') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE utilizator SET nume=?, prenume=?, password=?, username=?, telefon=?, email=? WHERE id='".$id."'")) {
                    $stmt->bind_param("ssssss", $nume, $prenume, $password, $username, $telefon, $email);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        } else {
            echo "id incorect!";
        }
categorie<?php
include("Conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
            $password = htmlentities($_POST['password'], ENT_QUOTES);
            $username = htmlentities($_POST['username'], ENT_QUOTES);
            $telefon = htmlentities($_POST['telefon'], ENT_QUOTES);
            $email = htmlentities($_POST['email'], ENT_QUOTES);

            if ($nume == '' || $prenume == '' || $password == '' || $username == '' || $telefon == '' || $email == '') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE utilizator SET nume=?, prenume=?, password=?, username=?, telefon=?, email=? WHERE id='".$id."'")) {
                    $stmt->bind_param("ssssss", $nume, $prenume, $password, $username, $telefon, $email);
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
        <li><a href="Acasa.html">Acasă</a></li>
        <li><a>Agendă</a></li>
        <li><a>Evenimente</a></li>
        <li><a>Artiști</a></li>
        <li><a>Bilete</a></li>
        <li><a href="sponsori.php">Sponsori</a></li>
        <li><a href="utilizatori.php">Login/Sign-up</a></li>
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
                if ($result = $mysqli->query("SELECT * FROM utilizator where id='".$_GET['id']."'")) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_object(); ?></p>
                        <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo $row->name; ?>"/><br/>
                        <strong>Prenume: </strong> <input type="text" name="prenume" value="<?php echo $row->prenume; ?>"/><br/>
                        <strong>Password: </strong> <input type="text" name="password" value="<?php echo $row->password; ?>"/><br/>
                        <strong>Username: </strong> <input type="text" name="username" value="<?php echo $row->username; ?>"/><br/>
                        <strong>Telefon: </strong> <input type="text" name="telefon" value="<?php echo $row->telefon; ?>"/><br/>
                        <strong>Email: </strong> <input type="text" name="email" value="<?php echo $row->email; ?>"/><br/>
                        <br/>
                        <input type="submit" name="submit" value="Submit" />
                        <a href="utilizator.php">Index</a>
                <?php }
                }
            }
        ?>
    </div>
</form>
</body>
</html>
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
        <li><a href="Acasa.html">Acasă</a></li>
        <li><a>Agendă</a></li>
        <li><a>Evenimente</a></li>
        <li><a>Artiști</a></li>
        <li><a>Bilete</a></li>
        <li><a href="sponsori.php">Sponsori</a></li>
        <li><a href="utilizatori.php">Login/Sign-up</a></li>
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
                if ($result = $mysqli->query("SELECT * FROM utilizator where id='".$_GET['id']."'")) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_object(); ?></p>
                        <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo $row->nume; ?>"/><br/>
                        <strong>Prenume: </strong> <input type="text" name="prenume" value="<?php echo $row->prenume; ?>"/><br/>
                        <strong>Password: </strong> <input type="text" name="password" value="<?php echo $row->password; ?>"/><br/>
                        <strong>Username: </strong> <input type="text" name="username" value="<?php echo $row->username; ?>"/><br/>
                        <strong>Telefon: </strong> <input type="text" name="telefon" value="<?php echo $row->telefon; ?>"/><br/>
                        <strong>Email: </strong> <input type="text" name="email" value="<?php echo $row->email; ?>"/><br/>
                        <br/>
                        <input type="submit" name="submit" value="Submit" />
                        <a href="utilizatori.php">Index</a>
                <?php }
                }
            }
        ?>
    </div>
</form>
</body>
</html>
