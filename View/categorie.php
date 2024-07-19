<?php 
include 'include/element.php'; 
include 'include/navigation.php'; //bar de navigation présent sur toute les pages
$idcategorie = $_GET["idcategorie"];
$statement = $pdo ->prepare ("SELECT * from categorie where idc = :idcategorie");
//le 'prepare' prepare la requete 
$statement -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
//bindValue donne la valeur :idcategorie au parametre idc 
$statement->execute();   
$result = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_GET["filtre"])){
    $filtre=$_GET["filtre"];
    if($filtre=="croissant"){
        $statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie order by prix asc');
        $statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
        $statement2 -> execute();
        $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);

    }
    if($filtre=="decroissant"){
        $statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie order by prix desc');
        $statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
        $statement2 -> execute();
        $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
    }
    if($filtre=="livraison"){
        $statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie and livraison = 1');
        $statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
        $statement2 -> execute();
        $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
    }
    if($filtre=="mainPropre"){
        $statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie and livraison = 0');
        $statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
        $statement2 -> execute();
        $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
    }
}elseif(isset($_GET["recherche"])){
    $recherche=$_GET["recherche"];
    $statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie and titre like :recherche');
    $statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
    $statement2 -> bindValue(':recherche', '%'.$recherche.'%', PDO::PARAM_STR);
    $statement2 -> execute();
    $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
}else{
$statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie');
$statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
$statement2 -> execute();
$result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
}
?> <!-- élément php présent sur tout les pages (vérification si session ouvert, connexion bdd etc...) -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Electro-Annonce</title>
    <?php include 'include/header.php'; ?>
    <style>
        .card {
            border: 1px solid #ddd;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
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
        .carousel {
            position: relative;
            width: 100%;
            max-height: 300px;
            overflow: hidden;
        }
        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-item {
            min-width: 100%;
            transition: opacity 1s ease-in-out;
            display: none; /* hide all slides by default */
        }
        .carousel-item.active {
            display: block; /* show the active slide */
        }
        .carousel-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .carousel-caption {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .carousel-caption h5 {
            color: white;
            font-size: 2em;
            font-weight: bold;
            margin: 0;
        }
        .carousel-control-prev, .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: white;
            padding: 10px;
            cursor: pointer;
            font-size: 2em;
        }
        .carousel-control-prev {
            left: 10px;
        }
        .carousel-control-next {
            right: 10px;
        }
    </style>
</head>
<body style="background-color: #f2edf3">
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <!-- Carrousel -->
                <div id="carouselExampleIndicators" class="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($result2 as $index => $ligne): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <img src="../<?= $ligne['photo'] ?>" class="d-block w-100" alt="...">
                                <div class="carousel-caption">
                                    <h5><?= $ligne['titre'] ?></h5>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" onclick="prevSlide()">
                        <span aria-hidden="true">&lsaquo;</span>
                    </button>
                    <button class="carousel-control-next" onclick="nextSlide()">
                        <span aria-hidden="true">&rsaquo;</span>
                    </button>
                </div>

                <div class="row mt-4">
                    <div class="grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body text-center">
                                <h2 class="card-title text-center">Filtrez mes recherches :</h2>
                                <a class="btn btn-success" href="categorie.php?idcategorie=<?= $result["idc"] ?>&filtre=croissant">Croissant</a>
                                <a class="btn btn-success" href="categorie.php?idcategorie=<?= $result["idc"] ?>&filtre=decroissant">Décroissant</a>
                                <a class="btn btn-success" href="categorie.php?idcategorie=<?= $result["idc"] ?>&filtre=livraison">Livraison</a>
                                <a class="btn btn-success" href="categorie.php?idcategorie=<?= $result["idc"] ?>&filtre=mainPropre">Main propre</a>
                            </div>
                        </div>
                    </div>

                    <div class="grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($result2 as $ligne) { ?>
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <img src="../<?= $ligne['photo'] ?>" class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title"><?= $ligne["titre"] ?></h5>
                                                    <p class="card-text"><strong><?= number_format($ligne['prix'], 0, ',', ' ') ?> €</strong></p>
                                                    <div class="product-variation">
                                                        <span class="badge badge-pill badge-info"><?= $ligne['etat'] ?> <i class="fa-solid fa-thumbs-up"></i></span>
                                                        <span class="badge badge-pill badge-danger">Format standard <i class="fa-solid fa-pen-nib"></i></span>
                                                        <?php if ($ligne["livraison"] == 1): ?>
                                                            <span class="badge badge-pill badge-success">Livraison <i class="fa-solid fa-truck"></i></span>
                                                        <?php else: ?>
                                                            <span class="badge badge-pill badge-success">Main propre <i class="fa-solid fa-handshake"></i></span>
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
        </div>
    </div>
</div>
<?php
include 'include/footer.php'; // on inclus notre footer à chaque bas de page
include 'include/script.php'; 
?> 
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-item');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides[currentSlide].classList.remove('active');
        currentSlide = (index + totalSlides) % totalSlides;
        slides[currentSlide].classList.add('active');
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    setInterval(nextSlide, 3000); // Change image every 3 seconds
</script>
</body>
</html>
