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
    <div class="login">
        <h1>Login</h1>
        <form action="authenticate.php" method="post">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="Login">
        </form>
        <div><a href="registration.html">Utilizator nou</a></div>
    </div>
</body>
</html>
