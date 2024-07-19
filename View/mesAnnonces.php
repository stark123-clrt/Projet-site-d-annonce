<?php include 'include/element.php'; ?> <!-- élément php présent sur toutes les pages (vérification si session ouvert, connexion bdd etc...) -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mes annonces - Electro-Annonce</title>
    <?php include 'include/header.php'; ?>  <!-- header présent sur toutes les pages (connexion avec bootstrap) -->
    <style>
        /* Custom styles to handle table responsiveness */
        .table-responsive {
            overflow-x: auto;
        }
        .table th, .table td {
            white-space: nowrap;
        }
    </style>
</head>
<body style="background-color: #f2edf3">
<div class="container-scroller">

    <?php include 'include/navigation.php'; ?> <!-- barre de navigation présente sur toutes les pages -->
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h1>Mes annonces (<?= $nbAnnonces ?>)</h1>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Titre</th>
                                                <th>Catégorie</th>
                                                <th>Livraison</th>
                                                <th>Date</th>
                                                <th>Vues</th>
                                                <th>Prix</th>
                                                <th>Supprimer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $req = $pdo->prepare('SELECT * FROM annonce WHERE vendeur = ?'); //récupère toutes les annonces de l'utilisateur connecté 
                                            $req->execute(array($uid));
                                            $result = $req->fetchAll();
                                            foreach($result as $row){
                                                $req2 = $pdo->query("select * from categorie where idc=".$row['categorie']);
                                                $ligne2 = $req2->fetch();
                                                ?>
                                                <tr>
                                                    <td class='align-middle'><img src='../<?= $row["photo"]?>' width='60'></td>
                                                    <td class='align-middle'><?= $row["titre"] ?></td>
                                                    <td class='align-middle'><?= $ligne2["nomCat"] ?></td>
                                                    <?php
                                                    if ($row["livraison"]==1){
                                                        echo "<td class='align-middle'><i class='fas fa-check'></i></td>";
                                                    }else{
                                                        echo "<td class='align-middle'><i class='fas fa-times'></i></td>";
                                                    }
                                                    ?>
                                                    <td class='align-middle'><?= $row["date"] ?></td>
                                                    <td class='align-middle'><?= $row["vue"] ?></td>
                                                    <td class='align-middle'><?= $row["prix"] ?>€</td>
                                                    <td class='align-middle'>
                                                        <a class="btn btn-sm btn-info" href="editAnnonce.php?ida=<?= $row["ida"] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href='action_get.php?action=supAnnonce&ida=<?= $row["ida"] ?>' class="btn btn-sm btn-danger"><i class='fas fa-trash'></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'include/footer.php'; ?> <!-- footer présent sur toutes les pages -->
        </div>
    </div>
</div>
<?php include 'include/script.php'; ?> <!-- script présent sur toutes les pages (connexion avec bootstrap) -->
</body>
</html>
