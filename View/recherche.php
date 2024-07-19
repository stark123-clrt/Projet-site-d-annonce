<?php 
include 'include/element.php';
if(isset($_SESSION["search"])){
    $result2=$_SESSION["search"];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Recherche - Great Deal</title>
    <?php include 'include/header.php'; ?>
    <style>
        .badge {
            margin-right: 5px;
        }
        .card-body h5, .card-body p {
            margin-bottom: 10px;
        }
        .product-variation {
            margin-top: 10px;
            text-align: center;
        }
        .product-variation span {
            display: inline-block;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .btn-voir-plus {
            display: block;
            width: 100%;
            margin-top: 15px;
        }
    </style>
</head>
<body style="background-color: #f2edf3">
<div class="container-scroller">
    <?php include 'include/navigation.php'; ?>
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-center">Recherche</h2>
                                <div class="row">
                                    <?php foreach($result2 as $ligne){ ?>
                                        <div class="col-md-4">
                                            <div class="card mb-4 shadow-sm">
                                                <img class="bd-placeholder-img card-img-top" style="height: 300px; width: 100%; display: block;" src="../<?= $ligne['photo'] ?>" alt="...">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title"><?= $ligne["titre"] ?></h5>
                                                    <p class="card-text"><strong><?= number_format($ligne['prix'], 0, ',', ' ')  ?> €</strong></p>
                                                    <div class="product-variation">
                                                        <span class="badge badge-pill badge-info"><?= $ligne['etat'] ?>&nbsp;<i class="fa-solid fa-thumbs-up"></i></span>
                                                        <span class="badge badge-pill badge-danger">Format standard&nbsp;<i class="fa-solid fa-pen-nib"></i></span>
                                                        <?php if ($ligne["livraison"] == 1): ?>
                                                            <span class="badge badge-pill badge-success">Livraison&nbsp;<i class="fa-solid fa-truck"></i></span>
                                                        <?php else: ?>
                                                            <span class="badge badge-pill badge-success">Main propre&nbsp;<i class="fa-solid fa-handshake"></i></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <a href="detail.php?ida=<?= $ligne["ida"] ?>" class="btn btn-success btn-voir-plus">Voir plus</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'include/footer.php'; ?>
        </div>
    </div>
</div>
<?php include 'include/script.php'; ?>
</body>
</html>
