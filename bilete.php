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

    <?php
    // connectare bazadedate
    include("Conectare.php");

    // se preiau inregistrarile din baza de date
    if ($result = $mysqli->query("SELECT * FROM bilete ORDER BY id ")) {
        // Afisare inregistrari pe ecran
        if ($result->num_rows > 0) {
            // afisarea inregistrarilor intr-o tabela
            echo "<table border='1' cellpadding='10'>";
            // antetul tabelului
            echo "<tr><th>ID</th><th>Pret</th><th>Titlu</th><th>ID Utilizator</th><th>ID Evenimente</th></tr>";

            while ($row = $result->fetch_object()) {
                // definirea unei linii pentru fiecare inregistrare
                echo "<tr>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->pret . "</td>";
                echo "<td>" . $row->titlu . "</td>";
                echo "<td>" . $row->idutilizator . "</td>";
                echo "<td>" . $row->idevenimente . "</td>";
                echo "<td><a href='bileteModificare.php?id=" . $row->id . "'>Modificare</a></td>";
                echo "<td><a href='bileteStergere.php?id=" . $row->id . "'>Stergere</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            // daca nu sunt inregistrari se afiseaza un rezultat de eroare
            echo "Nu sunt inregistrari in tabela!";
        }
    } else {
        // eroare in caz de insucces in interogare
        echo "Error: " . $mysqli->error();
    }

    // se inchide conexiunea
    $mysqli->close();
    ?>

    <a href="bileteInserare.php">Adaugarea unei noi inregistrari</a>
</body>
</html>
