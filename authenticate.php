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
    <?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'stand_up';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno())
{
    exit('Esec conectare MySQL: ' . mysqli_connect_errno());
}

if(!isset($_POST['username'], $_POST['password']))
{
    exit ('Completati nume_utilizator si parola!');
}

if($stmt = $con->prepare('SELECT id, password FROM utilizatori WHERE username = ?'))
{
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0)
    {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        if(password_verify($_POST['password'], $password))
        {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            echo 'Bine ati venit' . $_SESSION['name'] . '!';
            header ('Location: Acasa.php');
        }
        else
        {
            echo 'Nume de utilizator incorect sau parola incorectaaaa!';
        }
    }
    else 
    {
        echo 'Nume de utilizator incorect sau parola incorecta!';
    }
    $stmt->close();
}
?>