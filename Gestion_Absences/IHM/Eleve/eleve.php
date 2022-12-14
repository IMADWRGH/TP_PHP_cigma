<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Gestion des eleves</title>
    <style>
        h1 {
            text-align: center;
            margin-top: 50px;
        }

        table {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 25px;
        }

        p {
            font-size: 20px;
            font-family: cursive;
        }

        span {
            color: red;
            font-size: 25px;
        }
    </style>
</head>
<?php
include_once("../../Acces_BD/Eleve.php");
$req = Select();
?>

<body>
    <h1>Gestion des Eleves</h1>
    <table border="1px">
        <tr>
            <th>CNE</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Groupe</th>
            <th colspan="3"><a href="form.php"><i class="fa-solid fa-person-circle-plus"></i></a></th>
        </tr>
        <?php
        while ($result = mysqli_fetch_array($req)) {
        ?>
            <tr>
                <td><?= $result[0] ?></td>
                <td><?= $result[1] ?></td>
                <td><?= $result[2] ?></td>
                <td><?= $result[3] ?></td>
                <td><a href="../../Traitement/Eleve.php?action=delete&cne=<?= $result[0] ?>"><i class="fa-solid fa-trash-can "></i></a></td>
                <td><a href="form.php?action=update&cne=<?= $result[0] ?>"><i class="fa-solid fa-file-pen"></i></a></td>
                <td><a href="../../Traitement/Absence.php?action=select&cne=<?= $result[0] ?>">Absence</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <center> <a href="../../index.php"><i class="fa-solid fa-house"></i> Reteur</a></center>
    <center>
        <form action="" method="post">
            <label for="snm">Semaine : </label>&nbsp;&nbsp;
            <input type="text" name="snm">&nbsp;&nbsp;
            <input type="submit" value="Valider" name="sub">&nbsp;&nbsp;
            <input type="reset" value="Annuler"><br><br>
        </form>
    </center>
    <?php
    if (isset($_POST["sub"])) {
        $req = nbr_elv($_POST["snm"]);
        while ($result = mysqli_fetch_row($req)) {
            echo "<center><p>Dans la semaine $result[0] l'eleve ayant le CNE $result[2]<span> a $result[1] absences.</span> </p></center> ";
            echo "<h1>Liste d'absences de l'eleve " . $result[2] . "</h1>";
            echo "<table border='2'>
            <tr>
                <th>Semaine</th>
                <th>Nobmre d'absences</th>
            </tr>";

            echo "  <tr>";
            echo "
                    <td>$result[0]</td>
                    <td>$result[1]</td>";
            echo "  </tr>";
        }
        echo "</table> ";
    }
    ?>
</body>

</html>