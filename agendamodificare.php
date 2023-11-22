<?php
include("Conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $data = $_POST['data'];

            if ($data == '') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE agenda SET data=? WHERE id='".$id."'")) {
                    $stmt->bind_param("s", $data);
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
        <li><a href="artisti.php">Artiști</a></li>
        <li><a href="bilete.php">Bilete</a></li>
        <li><a href="sponsori.php">Sponsori</a></li>
<li><a href="login.php">Login/Sign-up</a></li>
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
                if ($result = $mysqli->query("SELECT * FROM agenda where id='".$_GET['id']."'")) {
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_object(); ?></p>
                        <strong>Data: </strong> <input type="date" name="data" value="<?php echo $row->data; ?>"/><br/>
                        <br/>
                        <input type="submit" name="submit" value="Submit" />
                        <a href="agenda.php">Index</a>
                <?php }
                }
            }
        ?>
    </div>
</form>
</body>
</html>
