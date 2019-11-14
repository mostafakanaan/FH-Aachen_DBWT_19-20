<?php require __DIR__ . '/vendor/autoload.php'; ?>
<!DOCTYPE html>
<!--TODO: Tabelle: Tooltip(Text beim  hovern der Zutaten) Siehe Paket 3-->
<!--TODO: Tabelle: Checkbox bei Vegan, Vegetarisch,Glutenfrei (siehe Paket 3)-->
<!--TODO: Aussehen bisschen anpassen-->
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eMensa - Startseite</title>
    <meta name="description" content="Startseite der eMensa">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
          integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <!--Header bzw Nav include -->
    <?php
    include 'inc/navbar.php'
    ?>

    <!-- content area -->
    <main>

        <?php
        $query = 'SELECT ID,Name,Vegan,Vegetarisch,Glutenfrei,Bio FROM Zutaten ORDER BY Bio DESC,Name;'; //Query um an die Zutaten zu kommen
        //Connectiion string..
        $dotenv = Dotenv\Dotenv::create(__DIR__,'.env');
        $dotenv->load();
        $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS','DB_PORT']);
        $connection = mysqli_connect(
            getenv('DB_HOST'),
            getenv('DB_USER'),
            getenv('DB_PASS'),
            getenv('DB_NAME'),
            (int) getenv('DB_PORT')
        );

        //Erros abfangen...
        if(mysqli_connect_errno()){
            printf("Verbindung zur Datenbank konnte nicht hergestellt werden: %s\n", mysqli_connect_error());
        }
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);
        ?>
        <h3><?php echo 'Zutaten ' .'('.$count.')' ?></h3>
        <table class="table table-striped">
            <!--    Tabellen Kopf -->
            <thead>
            <tr>
                <th>Zutat</th>
                <th>Vegan?</th>
                <th>Vegetarisch?</th>
                <th>Glutenfrei?</th>
            </tr>
            </thead>
            <tbody>
            <!--  Zutaten Row  -->
            <?php if ($result) { // Query ausführen..
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr> <td> <a href="https://www.google.com/search?q=' .$row['Name'] .'"target="_blank">', $row['Name'];  if($row['Bio']){ echo '<img src="img/bio.png"  title="Bio" alt="Bioabzeichen"/>';}  echo '</td> <td>'. $row['Vegan'] . '</a> </td> <td>'. $row['Vegetarisch'] . '</td> <td>'. $row['Glutenfrei'] . '</td></tr>' ;
                }


            }
            mysqli_close($connection);
            ?>
            </tbody>
        </table>

    </main>
    <!-- Footer -->
    <?php
    include 'inc/footer.php'
    ?>
</div>
<?php
include 'inc/js.html'
?>
</body>
</html>