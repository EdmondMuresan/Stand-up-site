<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
header('Location: index.html');
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
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
            <li><a href="artisti.php">Artiști</a></li>
            <li><a href="bilete.php">Bilete</a></li>
            <li><a href="sponsori.php">Sponsori</a>
            <li><a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a><li>
            
        </ul>
    </div>
    <div>
        <h1>Despre noi</h1>
        <p>Bine ai venit pe HaHaTickets, locul unde râsul devine o monedă de schimb pentru cele mai tari evenimente de stand-up! Suntem puntea dintre tine și serile pline de haz, unde comediantul devine starul și hohotele de râs sunt moneda de schimb.</p>
        <p>Cu o colecție vastă de spectacole și turnee de stand-up, HaHaTickets te invită să-ți rezervi locul în primul rând al râsului. La noi, vei găsi de toate, de la tineri comedianti inspirați, până la veterani ai scenei care au experiența să facă fiecare glumă să sune ca un adevărat hit de comedie.</p>
        <p>Și pentru că suntem atât de entuziasmați de lumea stand-up-ului, iată câteva glume care să-ți încingă apetitul pentru umor:</p>
        <ul>
            <li>"Știi că ești la un spectacol de stand-up bun când râzi atât de tare, încât începi să simți efectul de antrenament fizic. Să fie asta noua modalitate de a face exerciții?"</li>
            <li>"Deși râsul este cel mai bun remediu, cred că ar trebui să-l punem pe eticheta de avertisment: «Prea mult râs poate duce la burtă dureroasă și fețe umflate»."</li>
            <li>"Când un comedian spune că va fi un spectacol 'fără perdea', de obicei mă aștept să văd perdelele ridicându-se, dar în schimb, primesc povești picante și glume fără reținere. Mai bine de atât!"</li>
        </ul>
        <p>Fie că ești fan înrăit al comediei sau doar cauți o seară de neuitat, HaHaTickets este destinația ta pentru cele mai tari evenimente de stand-up din oraș. Haide să transformăm râsul în monedă de schimb și să îți oferim cele mai amuzante seri din viața ta!</p>
    
</body>
</html>